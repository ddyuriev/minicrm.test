<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\TicketFilterRequest;
use App\Http\Requests\Admin\TicketUpdateStatusRequest;
use App\Services\TicketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Ticket;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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

    public function show(int $id): View
    {
        $ticket = $this->ticketService->getTicket($id);
        $allStatuses = Ticket::getStatuses();
        return view('admin.tickets.show', compact('ticket', 'allStatuses'));
    }


    public function updateStatus(TicketUpdateStatusRequest $request, int $id): RedirectResponse
    {
        $status = $request->validated()['status'];
        $ticket = $this->ticketService->updateTicketStatus($id, $status);

        return redirect()
            ->route('tickets.show', $ticket);

    }

    public function downloadFile(int $ticketId, int $fileId)
    {
        $media = Media::findOrFail($fileId);
        if ($media->model_type !== Ticket::class || $media->model_id !== $ticketId) {
            abort(403);
        }
        return response()->download($media->getPath(), $media->name);
    }
}
