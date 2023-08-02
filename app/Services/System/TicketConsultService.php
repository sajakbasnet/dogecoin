<?php

namespace App\Services\System;


use App\Repositories\System\TicketConsultRepository;
use App\Services\Service;


class TicketConsultService extends Service
{
   
    public function __construct(TicketConsultRepository $ticketConsultRepository)
    {
        $this->ticketConsultRepository = $ticketConsultRepository;
     
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        return $this->ticketConsultRepository->getAllData($data);
    }
    public function indexPageData($request)
    {       
        return [
            'items' => $this->getAllData($request),
            'messages' =>  $this->ticketConsultRepository->message($request),
        ];
    }
    public function store($request)
    {
        \DB::transaction(function () use ($request) {
            $data = $request->except('_token');
            $data['user_id'] = (int) auth()->user()->id;
            $data['ticket_id'] = (int) $request->id;
            return $this->ticketConsultRepository->create($data);
        });
    }
}
