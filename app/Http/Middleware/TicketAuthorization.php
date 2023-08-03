<?php

namespace App\Http\Middleware;

use App\Model\Ticket;
use Closure;
use Illuminate\Http\Request;

class TicketAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ticketId = $request->route('ticket');  
        $ticket = Ticket::findOrFail($ticketId);

     
        if (strtolower(authUser()->roles->first()->name) == 'operator' &&  (int) $ticket->assigned_id !== $request->user()->id) {
            abort(403, 'Unauthorized to edit this ticket.');
        }
        if (strtolower(authUser()->roles->first()->name) == 'user' &&  (int) $ticket->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized to edit this ticket.');
        }

        return $next($request);
    }
}
