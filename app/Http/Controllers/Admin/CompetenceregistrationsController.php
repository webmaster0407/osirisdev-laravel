<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompetenceregistrationRequest;
use App\Http\Requests\StoreCompetenceregistrationRequest;
use App\Http\Requests\UpdateCompetenceregistrationRequest;
use App\Models\Competence;
use App\Models\Competenceregistration;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompetenceregistrationsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('competenceregistration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Competenceregistration::with(['user', 'competence'])->select(sprintf('%s.*', (new Competenceregistration())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'competenceregistration_show';
                $editGate = 'competenceregistration_edit';
                $deleteGate = 'competenceregistration_delete';
                $crudRoutePart = 'competenceregistrations';

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
            $table->addColumn('competence_name', function ($row) {
                return $row->competence ? $row->competence->name : '';
            });

            $table->editColumn('competence.key', function ($row) {
                return $row->competence ? (is_string($row->competence) ? $row->competence : $row->competence->key) : '';
            });
            $table->editColumn('competence.type', function ($row) {
                return $row->competence ? (is_string($row->competence) ? $row->competence : $row->competence->type) : '';
            });
            $table->editColumn('competence.color', function ($row) {
                return $row->competence ? (is_string($row->competence) ? $row->competence : $row->competence->color) : '';
            });

            $table->editColumn('regnotes', function ($row) {
                return $row->regnotes ? $row->regnotes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'competence']);

            return $table->make(true);
        }

        return view('admin.competenceregistrations.index');
    }

    public function create()
    {
        abort_if(Gate::denies('competenceregistration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $competences = Competence::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.competenceregistrations.create', compact('users', 'competences'));
    }

    public function store(StoreCompetenceregistrationRequest $request)
    {
        $competenceregistration = Competenceregistration::create($request->all());

        return redirect()->route('admin.competenceregistrations.index');
    }

    public function edit(Competenceregistration $competenceregistration)
    {
        abort_if(Gate::denies('competenceregistration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('firstname', 'id')->prepend(trans('global.pleaseSelect'), '');

        $competences = Competence::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $competenceregistration->load('user', 'competence');

        return view('admin.competenceregistrations.edit', compact('users', 'competences', 'competenceregistration'));
    }

    public function update(UpdateCompetenceregistrationRequest $request, Competenceregistration $competenceregistration)
    {
        $competenceregistration->update($request->all());

        return redirect()->route('admin.competenceregistrations.index');
    }

    public function show(Competenceregistration $competenceregistration)
    {
        abort_if(Gate::denies('competenceregistration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competenceregistration->load('user', 'competence');

        return view('admin.competenceregistrations.show', compact('competenceregistration'));
    }

    public function destroy(Competenceregistration $competenceregistration)
    {
        abort_if(Gate::denies('competenceregistration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competenceregistration->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompetenceregistrationRequest $request)
    {
        Competenceregistration::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
