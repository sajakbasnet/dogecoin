<?php

namespace App\Http\Controllers\System\ticketConsult;


use App\Http\Controllers\System\ResourceController;
use App\Services\System\TicketConsultService as SystemTicketConsultService;


class TicketConsultController extends ResourceController
{
    public function __construct(SystemTicketConsultService $ticketService)
    {
        parent::__construct($ticketService);
    }


    public function moduleName()
    {
        return 'ticket';
    }
    
    public function subModuleName()
    {
        return 'consult';
    }
    public function isSubModule()
    {
        return true;
    }
    public function subModuleToTitle()
    {
        return 'Ticket Details';
    }   

    public function viewFolder()
    {
        return 'system.ticketConsult';
    }
}
