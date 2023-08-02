<?php

namespace App\Services\System;;

use App\Exceptions\CustomGenericException;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\System\TicketRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;

class TicketService extends Service
{   
    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
     
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        return $this->ticketRepository->getAllData($data);
    }
    public function getUser()
    {
        return $this->ticketRepository->getUser();
        
    }
    public function status()
    {
        return ['awaiting-services' => 'Awaiting Service', 'under-review' => 'Under Review', 'in-process-of-resolution' => 'In Process of Resolution', 'completed' => 'Completed'];
    }
    public function priority()
    {
        return ['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'];
    }

    public function indexPageData($request)
    {
        return [
            'items' => $this->getAllData($request),
            'status' => $this->status(),
            'priority' => $this->priority(),
        ];
    }
    function createPageData($request)
    {
        return [
            'users' => $this->getUser(),
            'status' => $this->status(),
            'priority' => $this->priority(),
        ];
    }


    public function store($request)
    {
        \DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            $data['ticket_id'] = $this->ticketRepository->generateCode();
            return $this->ticketRepository->create($data);
        });
    }
  

    public function editPageData($request, $id)
    {
        $ticket = $this->ticketRepository->itemByIdentifier($id);

        return [
            'item' => $ticket,
            'users' => $this->getUser(),
            'status' => $this->status(),
            'priority' => $this->priority(),
        ];
    }

    public function update($request, $id)
    {
        try {
            $data = $request->except('_token');
            $ticket = $this->ticketRepository->itemByIdentifier($id);
            if ($ticket->ticket_id == null) {
                $data['ticket_id'] = $this->ticketRepository->generateCode();
            }
            
            return $ticket->ticketRepository->update($ticket,$data);
        } catch (\Exception $e) {            
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function delete($request, $id)
    {
        $user = $this->ticketRepository->itemByIdentifier($id);
        return $user->ticketRepository->delete($request,$id);
    }
}
