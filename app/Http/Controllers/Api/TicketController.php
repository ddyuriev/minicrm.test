<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TicketStoreRequest;
use App\Http\Resources\Api\TicketResource;
use App\Services\TicketCreateService;
use App\Services\TicketStatisticsService;
use Illuminate\Http\Request;
use App\Http\Resources\Api\TicketStatisticsResource;

class TicketController extends Controller
{
    public function __construct(private TicketCreateService $ticketCreateService, private TicketStatisticsService $ticketStatisticsService)
    {
    }

    public function store(TicketStoreRequest $request)
    {
        $validated = $request->validated();
        $ticket = $this->ticketCreateService->create($validated);

        return (new TicketResource($ticket))
            ->additional([
                'message' => 'Заявка успешно создана',
            ]);
    }

    public function statistics(Request $request)
    {
        $stats = $this->ticketStatisticsService->getStatistics();

        return new TicketStatisticsResource($stats);
    }
}
