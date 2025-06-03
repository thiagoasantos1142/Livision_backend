<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Application\UseCases\Events\ListEventsUseCase;

use App\Http\Resources\EventResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;

class ListEventsController extends Controller
{
    public function __construct(private ListEventsUseCase $listEventsUseCase)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = (int) $request->query('per_page', 15);

        $events = $this->listEventsUseCase->execute($perPage);

        return EventResource::collection($events);
    }


}
