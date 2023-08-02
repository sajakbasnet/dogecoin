<?php

namespace App\Http\Controllers\System\ticket;

use App\Http\Controllers\System\ResourceController;
use App\Model\Ticket;
use App\Services\System\TicketService as SystemTicketService;
use Illuminate\Http\Request;

class TicketController extends ResourceController
{
    //
    public function __construct(SystemTicketService $ticketService)
    {
        parent::__construct($ticketService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\system\ticketRequest';
    }

    public function moduleName()
    {
        return 'ticket';
    }

    public function viewFolder()
    {
        return 'system.ticket';
    }
    public function updateStatus(Request $request, $id)
    {
        $item = Ticket::find($id);
        $item->status = $request->input('status');
        $item->save();
        $response = [
            'status' => strtoupper(str_replace('-', ' ', $item->status)),
            'badgeClass' => $this->getBadgeClass($item->status) // Helper function to get the badge class based on status
        ];
        return response()->json($response);
    }

    private function getBadgeClass($status)
    {
        switch ($status) {
            case 'completed':
                return 'btn-success';
            case 'under-review':
                return 'btn-primary';
            case 'in-process-of-resolution':
                return 'btn-danger';
            default:
                return 'btn-warning';
        }
    }
}
