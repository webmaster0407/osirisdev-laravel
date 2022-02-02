<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrevregistrationRequest;
use App\Http\Requests\UpdatePrevregistrationRequest;
use App\Http\Resources\Admin\PrevregistrationResource;
use App\Models\Prevregistration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrevregistrationsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prevregistration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrevregistrationResource(Prevregistration::with(['user', 'prev'])->get());
    }

    public function store(StorePrevregistrationRequest $request)
    {
        $prevregistration = Prevregistration::create($request->all());

        return (new PrevregistrationResource($prevregistration))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Prevregistration $prevregistration)
    {
        abort_if(Gate::denies('prevregistration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrevregistrationResource($prevregistration->load(['user', 'prev']));
    }

    public function update(UpdatePrevregistrationRequest $request, Prevregistration $prevregistration)
    {
        $prevregistration->update($request->all());

        return (new PrevregistrationResource($prevregistration))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Prevregistration $prevregistration)
    {
        abort_if(Gate::denies('prevregistration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prevregistration->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
