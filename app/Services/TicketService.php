<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TicketService
{
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function getList(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        return $this->ticketRepository->list($filters, $perPage);
    }
}
