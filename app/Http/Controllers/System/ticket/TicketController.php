<?php

namespace App\Http\Controllers\System\ticket;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\TicketService as SystemTicketService;



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

}
