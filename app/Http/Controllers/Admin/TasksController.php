<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TasksController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Task::with(['createduser', 'assigneduser'])->select(sprintf('%s.*', (new Task())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'task_show';
                $editGate = 'task_edit';
                $deleteGate = 'task_delete';
                $crudRoutePart = 'tasks';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('createduser_firstname', function ($row) {
                return $row->createduser ? $row->createduser->firstname : '';
            });

            $table->editColumn('createduser.name', function ($row) {
                return $row->createduser ? (is_string($row->createduser) ? $row->createduser : $row->createduser->name) : '';
            });
            $table->editColumn('createduser.email', function ($row) {
                return $row->createduser ? (is_string($row->createduser) ? $row->createduser : $row->createduser->email) : '';
            });
            $table->addColumn('assigneduser_firstname', function ($row) {
                return $row->assigneduser ? $row->assigneduser->firstname : '';
            });

            $table->editColumn('assigneduser.name', function ($row) {
                return $row->assigneduser ? (is_string($row->assigneduser) ? $row->assigneduser : $row->assigneduser->name) : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('completed', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->completed ? 'checked' : null) . '>';
            });
            $table->editColumn('relationtype', function ($row) {
                return $row->relationtype ? $row->relationtype : '';
            });
            $table->editColumn('relationid', function ($row) {
                return $row->relationid ? $row->relationid : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'createduser', 'assigneduser', 'completed']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.tasks.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('task_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $createdusers = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignedusers = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tasks.create', compact('assignedusers', 'createdusers'));
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->all());

        return redirect()->route('admin.tasks.index');
    }

    public function edit(Task $task)
    {
        abort_if(Gate::denies('task_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $createdusers = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assignedusers = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $task->load('createduser', 'assigneduser');

        return view('admin.tasks.edit', compact('assignedusers', 'createdusers', 'task'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->all());

        return redirect()->route('admin.tasks.index');
    }

    public function show(Task $task)
    {
        abort_if(Gate::denies('task_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->load('createduser', 'assigneduser');

        return view('admin.tasks.show', compact('task'));
    }

    public function destroy(Task $task)
    {
        abort_if(Gate::denies('task_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $task->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
        Task::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
