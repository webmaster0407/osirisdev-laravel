<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyIncidentRequest;
use App\Http\Requests\StoreIncidentRequest;
use App\Http\Requests\UpdateIncidentRequest;
use App\Models\Incident;
use App\Models\Resource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class IncidentsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('incident_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Incident::with(['created_by', 'resources', 'users'])->select(sprintf('%s.*', (new Incident())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'incident_show';
                $editGate = 'incident_edit';
                $deleteGate = 'incident_delete';
                $crudRoutePart = 'incidents';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Incident::TYPE_SELECT[$row->type] : '';
            });

            $table->editColumn('starttime', function ($row) {
                return $row->starttime ? $row->starttime : '';
            });
            $table->editColumn('endtime', function ($row) {
                return $row->endtime ? $row->endtime : '';
            });
            $table->editColumn('resources', function ($row) {
                $labels = [];
                foreach ($row->resources as $resource) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $resource->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('users', function ($row) {
                $labels = [];
                foreach ($row->users as $user) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $user->firstname);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'resources', 'users']);

            return $table->make(true);
        }

        $users     = User::get();
        $resources = Resource::get();

        return view('admin.incidents.index', compact('users', 'resources'));
    }

    public function create()
    {
        abort_if(Gate::denies('incident_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $created_bies = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resources = Resource::pluck('name', 'id');

        $users = User::pluck('firstname', 'id');

        return view('admin.incidents.create', compact('created_bies', 'resources', 'users'));
    }

    public function store(StoreIncidentRequest $request)
    {
        $incident = Incident::create($request->all());
        $incident->resources()->sync($request->input('resources', []));
        $incident->users()->sync($request->input('users', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $incident->id]);
        }

        return redirect()->route('admin.incidents.index');
    }

    public function edit(Incident $incident)
    {
        abort_if(Gate::denies('incident_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $created_bies = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $resources = Resource::pluck('name', 'id');

        $users = User::pluck('firstname', 'id');

        $incident->load('created_by', 'resources', 'users');

        return view('admin.incidents.edit', compact('created_bies', 'incident', 'resources', 'users'));
    }

    public function update(UpdateIncidentRequest $request, Incident $incident)
    {
        $incident->update($request->all());
        $incident->resources()->sync($request->input('resources', []));
        $incident->users()->sync($request->input('users', []));

        return redirect()->route('admin.incidents.index');
    }

    public function show(Incident $incident)
    {
        abort_if(Gate::denies('incident_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incident->load('created_by', 'resources', 'users');

        return view('admin.incidents.show', compact('incident'));
    }

    public function destroy(Incident $incident)
    {
        abort_if(Gate::denies('incident_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incident->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncidentRequest $request)
    {
        Incident::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('incident_create') && Gate::denies('incident_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Incident();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
