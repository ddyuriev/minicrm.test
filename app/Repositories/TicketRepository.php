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
}
