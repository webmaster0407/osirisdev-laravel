<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyNoteRequest;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class NotesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('note_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Note::with(['userid'])->select(sprintf('%s.*', (new Note())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'note_show';
                $editGate = 'note_edit';
                $deleteGate = 'note_delete';
                $crudRoutePart = 'notes';

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
            $table->addColumn('userid_firstname', function ($row) {
                return $row->userid ? $row->userid->firstname : '';
            });

            $table->editColumn('userid.name', function ($row) {
                return $row->userid ? (is_string($row->userid) ? $row->userid : $row->userid->name) : '';
            });
            $table->editColumn('userid.email', function ($row) {
                return $row->userid ? (is_string($row->userid) ? $row->userid : $row->userid->email) : '';
            });
            $table->editColumn('note', function ($row) {
                return $row->note ? $row->note : '';
            });
            $table->editColumn('relationtype', function ($row) {
                return $row->relationtype ? $row->relationtype : '';
            });
            $table->editColumn('relationid', function ($row) {
                return $row->relationid ? $row->relationid : '';
            });
            $table->editColumn('visability', function ($row) {
                return $row->visability ? Note::VISABILITY_SELECT[$row->visability] : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'userid']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.notes.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('note_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userids = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.notes.create', compact('userids'));
    }

    public function store(StoreNoteRequest $request)
    {
        $note = Note::create($request->all());

        return redirect()->route('admin.notes.index');
    }

    public function edit(Note $note)
    {
        abort_if(Gate::denies('note_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userids = User::pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $note->load('userid');

        return view('admin.notes.edit', compact('note', 'userids'));
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->update($request->all());

        return redirect()->route('admin.notes.index');
    }

    public function show(Note $note)
    {
        abort_if(Gate::denies('note_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $note->load('userid');

        return view('admin.notes.show', compact('note'));
    }

    public function destroy(Note $note)
    {
        abort_if(Gate::denies('note_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $note->delete();

        return back();
    }

    public function massDestroy(MassDestroyNoteRequest $request)
    {
        Note::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
