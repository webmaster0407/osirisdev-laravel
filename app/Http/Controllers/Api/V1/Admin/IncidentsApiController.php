<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreIncidentRequest;
use App\Http\Requests\UpdateIncidentRequest;
use App\Http\Resources\Admin\IncidentResource;
use App\Models\Incident;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncidentsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('incident_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidentResource(Incident::with(['created_by', 'resources', 'users'])->get());
    }

    public function store(StoreIncidentRequest $request)
    {
        $incident = Incident::create($request->all());
        $incident->resources()->sync($request->input('resources', []));
        $incident->users()->sync($request->input('users', []));

        return (new IncidentResource($incident))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Incident $incident)
    {
        abort_if(Gate::denies('incident_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidentResource($incident->load(['created_by', 'resources', 'users']));
    }

    public function update(UpdateIncidentRequest $request, Incident $incident)
    {
        $incident->update($request->all());
        $incident->resources()->sync($request->input('resources', []));
        $incident->users()->sync($request->input('users', []));

        return (new IncidentResource($incident))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Incident $incident)
    {
        abort_if(Gate::denies('incident_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incident->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
