<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TicketStoreRequest;
use App\Http\Resources\Api\TicketResource;
use App\Services\TicketCreateService;
use Illuminate\Http\JsonResponse;

class TicketController extends Controller
{
    public function __construct(private TicketCreateService $ticketCreateService)
    {
    }

    public function store(TicketStoreRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $ticket = $this->ticketCreateService->create($validated);

        return (new TicketResource($ticket))
            ->additional([
                'message' => 'Заявка успешно создана',
            ])
            ->response()
            ->setStatusCode(201);
    }
}
