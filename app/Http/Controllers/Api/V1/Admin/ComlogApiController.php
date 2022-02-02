<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComlogRequest;
use App\Http\Requests\UpdateComlogRequest;
use App\Http\Resources\Admin\ComlogResource;
use App\Models\Comlog;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ComlogApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('comlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComlogResource(Comlog::with(['user'])->get());
    }

    public function store(StoreComlogRequest $request)
    {
        $comlog = Comlog::create($request->all());

        return (new ComlogResource($comlog))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Comlog $comlog)
    {
        abort_if(Gate::denies('comlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ComlogResource($comlog->load(['user']));
    }

    public function update(UpdateComlogRequest $request, Comlog $comlog)
    {
        $comlog->update($request->all());

        return (new ComlogResource($comlog))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Comlog $comlog)
    {
        abort_if(Gate::denies('comlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comlog->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
