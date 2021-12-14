@extends('layouts.master')

@section('content')
    <div class="container-fluid mt-5">
        @if (\Session::has('msg'))
            <div class="alert alert-success">
                {!! \Session::get('msg') !!}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <ul class="nav nav-tabs bg-light" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="ticket-tab" href="{{ route('reserved') }}">Mano rezervuoti bilietai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="ticket1-tab" href="{{ route('paid') }}">Mano apmokėti bilietai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="prifle-tab" href="{{ route('profile') }}">Profilio redagavimas</a>
            </li>
        </ul>
        <div class="card p-3" id="ticket1">
            @if ($ticketsPaid)
                <table class="table table-hover bg-light">
                    <thead>
                        <tr>
                            <th scope="col">Skrydis</th>
                            <th scope="col">Išvykimo data</th>
                            <th scope="col">Iš oro uosto</th>
                            <th scope="col">Į oro uosto</th>
                            <th scope="col">Statusas</th>
                            <th scope="col">Kaina</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ticketsPaid as $ticket)
                            <tr>
                                <td>{{ $ticket->flight->id }}</td>
                                <td>{{ $ticket->flight->departure_time }}</td>
                                <td>{{ $ticket->flight->airport_from->name }}</td>
                                <td>{{ $ticket->flight->airport_to->name }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>{{ $ticket->flight->tickets_price }} €</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $ticketsPaid->links('vendor.pagination.bootstrap-4') }}
            @else
                Nėra apmokėtų bilietų
            @endif
        </div>
    </div>
@endsection
