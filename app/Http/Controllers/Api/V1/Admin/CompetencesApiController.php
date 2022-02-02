<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompetenceRequest;
use App\Http\Requests\UpdateCompetenceRequest;
use App\Http\Resources\Admin\CompetenceResource;
use App\Models\Competence;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompetencesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('competence_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompetenceResource(Competence::all());
    }

    public function store(StoreCompetenceRequest $request)
    {
        $competence = Competence::create($request->all());

        return (new CompetenceResource($competence))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Competence $competence)
    {
        abort_if(Gate::denies('competence_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CompetenceResource($competence);
    }

    public function update(UpdateCompetenceRequest $request, Competence $competence)
    {
        $competence->update($request->all());

        return (new CompetenceResource($competence))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Competence $competence)
    {
        abort_if(Gate::denies('competence_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competence->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
