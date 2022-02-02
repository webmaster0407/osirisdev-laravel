<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompetenceregistrationRequest;
use App\Http\Requests\UpdateCompetenceregistrationRequest;
use App\Http\Resources\Admin\CompetenceregistrationResource;
use App\Models\Competenceregistration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompetenceregistrationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('competenceregistration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompetenceregistrationResource(Competenceregistration::with(['user', 'competence'])->get());
    }

    public function store(StoreCompetenceregistrationRequest $request)
    {
        $competenceregistration = Competenceregistration::create($request->all());

        return (new CompetenceregistrationResource($competenceregistration))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Competenceregistration $competenceregistration)
    {
        abort_if(Gate::denies('competenceregistration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompetenceregistrationResource($competenceregistration->load(['user', 'competence']));
    }

    public function update(UpdateCompetenceregistrationRequest $request, Competenceregistration $competenceregistration)
    {
        $competenceregistration->update($request->all());

        return (new CompetenceregistrationResource($competenceregistration))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Competenceregistration $competenceregistration)
    {
        abort_if(Gate::denies('competenceregistration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competenceregistration->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
