<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPrevregistrationRequest;
use App\Http\Requests\StorePrevregistrationRequest;
use App\Http\Requests\UpdatePrevregistrationRequest;
use App\Models\Prev;
use App\Models\Prevregistration;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PrevregistrationsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('prevregistration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Prevregistration::with(['user', 'prev'])->select(sprintf('%s.*', (new Prevregistration())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'prevregistration_show';
                $editGate = 'prevregistration_edit';
                $deleteGate = 'prevregistration_delete';
                $crudRoutePart = 'prevregistrations';

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
            $table->addColumn('user_firstname', function ($row) {
                return $row->user ? $row->user->firstname : '';
            });

            $table->editColumn('user.name', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->name) : '';
            });
            $table->addColumn('prev_name', function ($row) {
                return $row->prev ? $row->prev->name : '';
            });

            $table->editColumn('prev.date', function ($row) {
                return $row->prev ? (is_string($row->prev) ? $row->prev : $row->prev->date) : '';
            });
            $table->editColumn('regnotes', function ($row) {
                return $row->regnotes ? $row->regnotes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'prev']);

            return $table->make(true);
        }

        return view('admin.prevregistrations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('prevregistration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prevs = Prev::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.prevregistrations.create', compact('prevs', 'users'));
    }

    public function store(StorePrevregistrationRequest $request)
    {
        $prevregistration = Prevregistration::create($request->all());

        return redirect()->route('admin.prevregistrations.index');
    }

    public function edit(Prevregistration $prevregistration)
    {
        abort_if(Gate::denies('prevregistration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prevs = Prev::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prevregistration->load('user', 'prev');

        return view('admin.prevregistrations.edit', compact('prevregistration', 'prevs', 'users'));
    }

    public function update(UpdatePrevregistrationRequest $request, Prevregistration $prevregistration)
    {
        $prevregistration->update($request->all());

        return redirect()->route('admin.prevregistrations.index');
    }

    public function show(Prevregistration $prevregistration)
    {
        abort_if(Gate::denies('prevregistration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prevregistration->load('user', 'prev');

        return view('admin.prevregistrations.show', compact('prevregistration'));
    }

    public function destroy(Prevregistration $prevregistration)
    {
        abort_if(Gate::denies('prevregistration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prevregistration->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrevregistrationRequest $request)
    {
        Prevregistration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
