<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketStatisticsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'day' => $this['day'],
            'week' => $this['week'],
            'month' => $this['month'],
        ];
    }
}
