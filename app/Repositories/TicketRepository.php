<?php

namespace App\Repositories;

use App\Filters\TicketFilters;
use App\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TicketRepository
{
    public function list(array $filters, int $perPage = 20): LengthAwarePaginator
    {
        $query = Ticket::with('customer')->orderByDesc('created_at');

        TicketFilters::apply($query, $filters);

        return $query->paginate($perPage)->withQueryString();
    }

    public function showTicket(int $id): Ticket
    {
        $ticket = Ticket::with([
            'customer',
            'media'
        ])->find($id);

        return $ticket;
    }


    public function updateStatus(int $id, int $status): Ticket
    {
        $ticket = Ticket::find($id);

        $ticket->status = $status;
        $ticket->save();

        return $ticket->fresh();
    }

    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }
}
