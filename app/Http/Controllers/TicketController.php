<?php

namespace App\Http\Controllers;
use App\Services\TicketService;
use App\Http\Requests\Admin\TicketFilterRequest;

class TicketController extends Controller
{
    public function __construct(private TicketService $ticketService)
    {
    }

    public function index(TicketFilterRequest $request)
    {
        $filters = $request->validated();

        $tickets = $this->ticketService->getList($filters);
        return view('admin.tickets.index', compact('tickets'));

    }

    public function show()
    {

    }
}
