<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyComlogRequest;
use App\Http\Requests\StoreComlogRequest;
use App\Http\Requests\UpdateComlogRequest;
use App\Models\Comlog;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ComlogController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('comlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Comlog::with(['user'])->select(sprintf('%s.*', (new Comlog())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'comlog_show';
                $editGate = 'comlog_edit';
                $deleteGate = 'comlog_delete';
                $crudRoutePart = 'comlogs';

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
            $table->editColumn('from', function ($row) {
                return $row->from ? $row->from : '';
            });
            $table->editColumn('to', function ($row) {
                return $row->to ? $row->to : '';
            });
            $table->editColumn('subject', function ($row) {
                return $row->subject ? $row->subject : '';
            });
            $table->editColumn('message', function ($row) {
                return $row->message ? $row->message : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Comlog::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('extrainfo', function ($row) {
                return $row->extrainfo ? $row->extrainfo : '';
            });
            $table->addColumn('user_firstname', function ($row) {
                return $row->user ? $row->user->firstname : '';
            });

            $table->editColumn('user.name', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->name) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.comlogs.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('comlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.comlogs.create', compact('users'));
    }

    public function store(StoreComlogRequest $request)
    {
        $comlog = Comlog::create($request->all());

        return redirect()->route('admin.comlogs.index');
    }

    public function edit(Comlog $comlog)
    {
        abort_if(Gate::denies('comlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $comlog->load('user');

        return view('admin.comlogs.edit', compact('comlog', 'users'));
    }

    public function update(UpdateComlogRequest $request, Comlog $comlog)
    {
        $comlog->update($request->all());

        return redirect()->route('admin.comlogs.index');
    }

    public function show(Comlog $comlog)
    {
        abort_if(Gate::denies('comlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comlog->load('user');

        return view('admin.comlogs.show', compact('comlog'));
    }

    public function destroy(Comlog $comlog)
    {
        abort_if(Gate::denies('comlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comlog->delete();

        return back();
    }

    public function massDestroy(MassDestroyComlogRequest $request)
    {
        Comlog::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
