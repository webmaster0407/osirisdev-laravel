<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompetenceRequest;
use App\Http\Requests\StoreCompetenceRequest;
use App\Http\Requests\UpdateCompetenceRequest;
use App\Models\Competence;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompetencesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('competence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Competence::query()->select(sprintf('%s.*', (new Competence())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'competence_show';
                $editGate = 'competence_edit';
                $deleteGate = 'competence_delete';
                $crudRoutePart = 'competences';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? Competence::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('color', function ($row) {
                return $row->color ? $row->color : '';
            });
            $table->editColumn('expirable', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->expirable ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'expirable']);

            return $table->make(true);
        }

        return view('admin.competences.index');
    }

    public function create()
    {
        abort_if(Gate::denies('competence_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.competences.create');
    }

    public function store(StoreCompetenceRequest $request)
    {
        $competence = Competence::create($request->all());

        return redirect()->route('admin.competences.index');
    }

    public function edit(Competence $competence)
    {
        abort_if(Gate::denies('competence_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.competences.edit', compact('competence'));
    }

    public function update(UpdateCompetenceRequest $request, Competence $competence)
    {
        $competence->update($request->all());

        return redirect()->route('admin.competences.index');
    }

    public function show(Competence $competence)
    {
        abort_if(Gate::denies('competence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.competences.show', compact('competence'));
    }

    public function destroy(Competence $competence)
    {
        abort_if(Gate::denies('competence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competence->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompetenceRequest $request)
    {
        Competence::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
