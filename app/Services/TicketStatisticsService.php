<?php

namespace App\Services;

use App\Models\Ticket;

class TicketStatisticsService
{
    public function getStatistics(): array
    {
        return [
            'day' => Ticket::createdToday()->count(),
            'week' => Ticket::createdThisWeek()->count(),
            'month' => Ticket::createdThisMonth()->count(),
        ];
    }
}
