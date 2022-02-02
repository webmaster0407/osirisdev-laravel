<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPrevRequest;
use App\Http\Requests\StorePrevRequest;
use App\Http\Requests\UpdatePrevRequest;
use App\Models\Location;
use App\Models\Prev;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PrevsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('prev_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Prev::with(['location', 'created_by', 'prevresponsible'])->select(sprintf('%s.*', (new Prev())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'prev_show';
                $editGate = 'prev_edit';
                $deleteGate = 'prev_delete';
                $crudRoutePart = 'prevs';

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
            $table->editColumn('prevtype', function ($row) {
                return $row->prevtype ? Prev::PREVTYPE_SELECT[$row->prevtype] : '';
            });

            $table->editColumn('starttime', function ($row) {
                return $row->starttime ? $row->starttime : '';
            });
            $table->editColumn('endtime', function ($row) {
                return $row->endtime ? $row->endtime : '';
            });
            $table->addColumn('location_name', function ($row) {
                return $row->location ? $row->location->name : '';
            });

            $table->editColumn('location.city', function ($row) {
                return $row->location ? (is_string($row->location) ? $row->location : $row->location->city) : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? Prev::STATUS_SELECT[$row->status] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'location']);

            return $table->make(true);
        }

        $locations = Location::get();
        $users     = User::get();

        return view('admin.prevs.index', compact('locations', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('prev_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prevresponsibles = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.prevs.create', compact('created_bies', 'locations', 'prevresponsibles'));
    }

    public function store(StorePrevRequest $request)
    {
        $prev = Prev::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $prev->id]);
        }

        return redirect()->route('admin.prevs.index');
    }

    public function edit(Prev $prev)
    {
        abort_if(Gate::denies('prev_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $locations = Location::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $created_bies = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prevresponsibles = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $prev->load('location', 'created_by', 'prevresponsible');

        return view('admin.prevs.edit', compact('created_bies', 'locations', 'prev', 'prevresponsibles'));
    }

    public function update(UpdatePrevRequest $request, Prev $prev)
    {
        $prev->update($request->all());

        return redirect()->route('admin.prevs.index');
    }

    public function show(Prev $prev)
    {
        abort_if(Gate::denies('prev_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prev->load('location', 'created_by', 'prevresponsible', 'prevPrevregistrations');

        return view('admin.prevs.show', compact('prev'));
    }

    public function destroy(Prev $prev)
    {
        abort_if(Gate::denies('prev_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prev->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrevRequest $request)
    {
        Prev::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('prev_create') && Gate::denies('prev_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Prev();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
