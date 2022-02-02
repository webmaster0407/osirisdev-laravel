<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePrevRequest;
use App\Http\Requests\UpdatePrevRequest;
use App\Http\Resources\Admin\PrevResource;
use App\Models\Prev;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrevsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('prev_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrevResource(Prev::with(['location', 'created_by', 'prevresponsible'])->get());
    }

    public function store(StorePrevRequest $request)
    {
        $prev = Prev::create($request->all());

        return (new PrevResource($prev))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Prev $prev)
    {
        abort_if(Gate::denies('prev_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PrevResource($prev->load(['location', 'created_by', 'prevresponsible']));
    }

    public function update(UpdatePrevRequest $request, Prev $prev)
    {
        $prev->update($request->all());

        return (new PrevResource($prev))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Prev $prev)
    {
        abort_if(Gate::denies('prev_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prev->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
