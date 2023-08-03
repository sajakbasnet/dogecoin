<?php

namespace App\Repositories\System;

use App\Interfaces\OpenInterface;
use App\Interfaces\System\TicketInterface;
use App\Model\Ticket;
use App\Repositories\Repository;
use App\User;

class TicketRepository extends Repository implements TicketInterface
{
  protected $user;
  protected $role;

  public function __construct(Ticket $ticket, User $user)
  {
    parent::__construct($ticket);
    $this->user = $user;
  }

  public function getAllData($data, $selectedColumns = [], $pagination = true)
  {

    $query = $this->query();

    if (strtolower(authUser()->roles->first()->name) == 'operator') {
      $query->where('assigned_id', authUser()->id);
    }
    if (strtolower(authUser()->roles->first()->name) == 'user') {
      $query->where('user_id', authUser()->id);
    }
    if (isset($data->keyword) && $data->keyword !== null) {
      $query->whereRaw('LOWER(subject) LIKE ?', ['%' . strtolower($data->keyword) . '%']);
    }
    if (isset($data->status) && $data->status !== null) {
      $query->where('status',  $data->status);
    }

    if (count($selectedColumns) > 0) {
      $query->select($selectedColumns);
    }
    if ($pagination) {
      return $query->orderBy('id', 'DESC')->with('user')->paginate(10);
    }

    return $query->orderBy('id', 'DESC')->with('user')->get();
  }
  public function getUser()
  {
    return $this->user->with('roles')->whereHas('roles', function ($query) {
      $query->whereRaw('LOWER(name) = ?', ['operator']);
    })->pluck('name', 'id')->toArray();
  }
  public function create($data)
  {
    return $this->model->create($data);
  }

  public function update($user, $data)
  {
    return $user->update($data);
  }

  public function delete($request, $id)
  {
    $user = $this->itemByIdentifier($id);
    return $user->delete();
  }
  public function generateCode()
  {
    $ticketNumber = random_int(100000, 999999);
    $check = $this->model->where('ticket_id', $ticketNumber)->exists();
    if ($check) {
      $ticketNumber = $this->generateCode();
    }

    return $ticketNumber;
  }
}
