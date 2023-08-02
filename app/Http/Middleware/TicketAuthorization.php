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

        // Check if the authenticated user is an operator and the ticket is owned by the operator
        if (strtolower(authUser()->roles->first()->name) == 'operator' && $ticket->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized to edit this ticket.');
        }

        return $next($request);
    }
}
