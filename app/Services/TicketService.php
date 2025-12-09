<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\Ticket;

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

    public function getTicket(int $id): Ticket
    {
        return $this->ticketRepository->showTicket($id);
    }

    public function updateTicketStatus(int $id, string $status): Ticket
    {
        return $this->ticketRepository->updateStatus($id, $status);
    }
}
