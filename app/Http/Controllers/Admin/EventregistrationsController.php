<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventregistrationRequest;
use App\Http\Requests\StoreEventregistrationRequest;
use App\Http\Requests\UpdateEventregistrationRequest;
use App\Models\Event;
use App\Models\Eventregistration;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventregistrationsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('eventregistration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Eventregistration::with(['user', 'event'])->select(sprintf('%s.*', (new Eventregistration())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'eventregistration_show';
                $editGate = 'eventregistration_edit';
                $deleteGate = 'eventregistration_delete';
                $crudRoutePart = 'eventregistrations';

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
            $table->addColumn('event_name', function ($row) {
                return $row->event ? $row->event->name : '';
            });

            $table->editColumn('event.type', function ($row) {
                return $row->event ? (is_string($row->event) ? $row->event : $row->event->type) : '';
            });
            $table->editColumn('regnotes', function ($row) {
                return $row->regnotes ? $row->regnotes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'event']);

            return $table->make(true);
        }

        return view('admin.eventregistrations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('eventregistration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.eventregistrations.create', compact('events', 'users'));
    }

    public function store(StoreEventregistrationRequest $request)
    {
        $eventregistration = Eventregistration::create($request->all());

        return redirect()->route('admin.eventregistrations.index');
    }

    public function edit(Eventregistration $eventregistration)
    {
        abort_if(Gate::denies('eventregistration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $eventregistration->load('user', 'event');

        return view('admin.eventregistrations.edit', compact('eventregistration', 'events', 'users'));
    }

    public function update(UpdateEventregistrationRequest $request, Eventregistration $eventregistration)
    {
        $eventregistration->update($request->all());

        return redirect()->route('admin.eventregistrations.index');
    }

    public function show(Eventregistration $eventregistration)
    {
        abort_if(Gate::denies('eventregistration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventregistration->load('user', 'event');

        return view('admin.eventregistrations.show', compact('eventregistration'));
    }

    public function destroy(Eventregistration $eventregistration)
    {
        abort_if(Gate::denies('eventregistration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventregistration->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventregistrationRequest $request)
    {
        Eventregistration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
