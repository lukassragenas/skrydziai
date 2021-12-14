<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\Notifications\ContactFormMessage;
use App\Models\Recipient;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $airports = Airport::all();

        return view('index', compact('airports'));
    }
    public function support()
    {
        return view('pages.support');
    }
    public function findFlight(Request $request)
    {
        $from = $request->input('fromAirPort');
        $to = $request->input('toAirPort');
        $date = $request->input('departureDate');

        $flights = Flight::where('from_airport_id', $from)
            ->where('to_airport_id', $to)
            ->get();
        return view('pages.flights', compact('flights'));
    }

    public function reserveFlight(Request $request)
    {
        Ticket::create([
            'flight_id' => $request->input('flight_id'),
            'status' => 'Rezervuotas',
            'passeger_id' => auth()->user()->id,
            'seat_class' => $request->input('seat_class')
        ]);

        // Flight::find($request->input('flight_id'))->decrement('visitors');

        return redirect()->back()->with('msg', 'Bilietas rezervuotas, pamatyti rezervuotus bilietus galite savo profilyje');
    }

    public function getProfile()
    {
        $tickets = Ticket::where('passeger_id', auth()->user()->id)->get();
        return view('pages.profile', compact('tickets'));
    }

    public function updateEmail(Request $request)
    {
        $input = $request->validate([
            'email' => 'unique:users|required|email'
        ]);

        $user =Auth::user();
        $user->email = $input['email'];
        $user->save();

        return redirect()->back()->with('msg', 'El. pašto adresas atnaujintas');
    }

    public function passwordUpdate(Request $request)
    {
        $input = $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        $user =Auth::user();
        $user->password = bcrypt($input['password']);
        $user->save();

        return redirect()->back()->with('msg', 'Slaptažodis atnaujintas');
    }

    public function sendMail(ContactFormRequest $message, Recipient $recipient)
    {
        $recipient->notify(new ContactFormMessage($message));

        return back()->with(['message' => 'Email successfully sent!']);
    }

    public function deleteFlight($id)
    {
        $ticket = Ticket::find($id);

        $ticket->delete();

        return redirect()->back()->with('msg', 'Rezervacija atšaukta');
    }
}
