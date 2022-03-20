<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Session;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripePost(Request $request)
    {
        $ticket = Ticket::find($request->input('ticket_id'));
        $price = $request->input('price');

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $price * 100,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Test payment"
        ]);

        $ticket->status = 'Apmokėtas';
        $ticket->save();

        return redirect()->back()->with('msg', 'Mokėjimas atliktas');
    }
}
