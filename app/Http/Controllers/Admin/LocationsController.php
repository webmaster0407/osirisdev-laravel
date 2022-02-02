<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLocationRequest;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LocationsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('location_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Location::with(['created_by'])->select(sprintf('%s.*', (new Location())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'location_show';
                $editGate = 'location_edit';
                $deleteGate = 'location_delete';
                $crudRoutePart = 'locations';

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
            $table->editColumn('street', function ($row) {
                return $row->street ? $row->street : '';
            });
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });
            $table->editColumn('zip', function ($row) {
                return $row->zip ? $row->zip : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->addColumn('created_by_firstname', function ($row) {
                return $row->created_by ? $row->created_by->firstname : '';
            });

            $table->editColumn('created_by.name', function ($row) {
                return $row->created_by ? (is_string($row->created_by) ? $row->created_by : $row->created_by->name) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'created_by']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.locations.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('location_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $created_bies = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.locations.create', compact('created_bies'));
    }

    public function store(StoreLocationRequest $request)
    {
        $location = Location::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $location->id]);
        }

        return redirect()->route('admin.locations.index');
    }

    public function edit(Location $location)
    {
        abort_if(Gate::denies('location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $created_bies = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $location->load('created_by');

        return view('admin.locations.edit', compact('created_bies', 'location'));
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->all());

        return redirect()->route('admin.locations.index');
    }

    public function show(Location $location)
    {
        abort_if(Gate::denies('location_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $location->load('created_by', 'locationPrevs', 'locationEvents');

        return view('admin.locations.show', compact('location'));
    }

    public function destroy(Location $location)
    {
        abort_if(Gate::denies('location_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $location->delete();

        return back();
    }

    public function massDestroy(MassDestroyLocationRequest $request)
    {
        Location::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('location_create') && Gate::denies('location_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Location();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
