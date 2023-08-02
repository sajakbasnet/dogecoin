<?php

namespace App\Repositories\System;

use App\Interfaces\OpenInterface;
use App\Interfaces\System\TicketConsultInterface;
use App\Model\Ticket;
use App\Model\TicketConsult;
use App\Repositories\Repository;

class TicketConsultRepository extends Repository implements TicketConsultInterface
{
  public function __construct(Ticket $ticket, TicketConsult $ticketConsult)
  {
    parent::__construct($ticket);
    $this->ticketConsult = $ticketConsult;
  }

  public function getAllData($data, $selectedColumns = [], $pagination = true)
  {

    $query = $this->query()->whereId($data['id']);

    if (isset($data->keyword) && $data->keyword !== null) {
      $query->where('subject', 'LIKE', '%' . $data->keyword . '%');
    }

    if (count($selectedColumns) > 0) {
      $query->select($selectedColumns);
    }
    if ($pagination) {
      return $query->orderBy('id', 'DESC')->first();
    }
    return $query->orderBy('id', 'DESC')->first();
  }
  public function message($request)
  {
    return $this->ticketConsult->with('users')->where('ticket_id', $request->id)->orderBy('id', 'DESC')->get();
  }
  public function create($data)
  {
    return $this->ticketConsult->create($data);
  }

}
