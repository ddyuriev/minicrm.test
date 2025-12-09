<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\CustomerRepository;
use App\Repositories\TicketRepository;
use Carbon\Carbon;

class TicketCreateService
{
    public function __construct(private TicketRepository $ticketRepository, private CustomerRepository $customerRepository)
    {
    }

    public function create(array $data): Ticket
    {
        $customerData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ];

        $customer = $this->customerRepository->firstOrCreate($customerData);

        $ticket = $this->ticketRepository->create([
            'customer_id' => $customer->id,
            'topic' => $data['topic'],
            'text' => $data['text'],
            'status' => Ticket::STATUS_NEW,
            'date_of_response' => Carbon::now()->addDays(7)
        ]);

        return $ticket;

    }
}
