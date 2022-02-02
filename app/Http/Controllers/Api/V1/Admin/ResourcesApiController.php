<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Http\Resources\Admin\ResourceResource;
use App\Models\Resource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResourcesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('resource_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ResourceResource(Resource::all());
    }

    public function store(StoreResourceRequest $request)
    {
        $resource = Resource::create($request->all());

        return (new ResourceResource($resource))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Resource $resource)
    {
        abort_if(Gate::denies('resource_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ResourceResource($resource);
    }

    public function update(UpdateResourceRequest $request, Resource $resource)
    {
        $resource->update($request->all());

        return (new ResourceResource($resource))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Resource $resource)
    {
        abort_if(Gate::denies('resource_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $resource->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
