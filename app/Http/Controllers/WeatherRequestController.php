<?php

namespace App\Http\Controllers;

use App\Domain\Comment\Contracts\CommentRepositoryContract;
use App\Domain\Weather\Actions\CreateWeatherRequestAction;
use App\Domain\Weather\Models\WeatherRequest;
use App\Http\Requests\CreateWeatherRequestRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\WeatherRequestResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class WeatherRequestController
{
    use AuthorizesRequests;

    public function __construct(private CommentRepositoryContract $comments)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $this->authorize('index', WeatherRequest::class);

        return WeatherRequestResource::collection($request->user()->weatherRequests()->paginate());
    }

    public function show(WeatherRequest $weatherRequest): WeatherRequestResource
    {
        $this->authorize('show', $weatherRequest);

        return new WeatherRequestResource($weatherRequest);
    }

    public function create(
        CreateWeatherRequestRequest $request,
        CreateWeatherRequestAction $action
    ): WeatherRequestResource {
        $this->authorize('create', WeatherRequest::class);

        return new WeatherRequestResource($action->execute($request->toData(), $request->user()));
    }

    public function delete(
        WeatherRequest $weatherRequest
    ): Response {
        $this->authorize('delete', $weatherRequest);

        $weatherRequest->delete();

        return response()->noContent();
    }

    public function comments(WeatherRequest $weatherRequest): AnonymousResourceCollection {
        $this->authorize('show', $weatherRequest);

        return CommentResource::collection($this->comments->index($weatherRequest));
    }
}
