<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventregistrationRequest;
use App\Http\Requests\UpdateEventregistrationRequest;
use App\Http\Resources\Admin\EventregistrationResource;
use App\Models\Eventregistration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventregistrationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('eventregistration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventregistrationResource(Eventregistration::with(['user', 'event'])->get());
    }

    public function store(StoreEventregistrationRequest $request)
    {
        $eventregistration = Eventregistration::create($request->all());

        return (new EventregistrationResource($eventregistration))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Eventregistration $eventregistration)
    {
        abort_if(Gate::denies('eventregistration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventregistrationResource($eventregistration->load(['user', 'event']));
    }

    public function update(UpdateEventregistrationRequest $request, Eventregistration $eventregistration)
    {
        $eventregistration->update($request->all());

        return (new EventregistrationResource($eventregistration))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Eventregistration $eventregistration)
    {
        abort_if(Gate::denies('eventregistration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventregistration->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
