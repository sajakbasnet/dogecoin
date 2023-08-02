<?php

namespace App\Http\Middleware;

use App\Model\Ticket as ModelTicket;
use App\Models\Ticket;
use Closure;
use Illuminate\Http\Request;

class CheckTicketAuthorization
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
       
        $ticketId = $request->route('id');   
        $ticket = ModelTicket::findOrFail($ticketId);        
        // Check if the authenticated user is the owner of the ticket or an authorized operator
       
        if (strtolower(authUser()->roles->first()->name) == 'operator' && authUser()->id !== $ticket->user_id) {
            abort(403, 'Unauthorized to access this ticket.');
        }

        return $next($request);
    }
}
