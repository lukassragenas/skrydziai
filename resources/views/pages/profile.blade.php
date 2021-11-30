@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        @if (\Session::has('msg'))
            <div class="alert alert-success">
                {!! \Session::get('msg') !!}
            </div>
        @endif
        <ul class="nav nav-tabs bg-light" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ticket-tab" data-toggle="tab" href="#ticket" role="tab" aria-controls="ticket"
                    aria-selected="true">Mano bilietai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="prifle-tab" data-toggle="tab" href="#prifle" role="tab"
                    aria-controls="prifle" aria-selected="false">Profilio redagavimas</a>
            </li>
        </ul>
        <div class="tab-content bg-light" id="myTabContent">
            <div class="tab-pane fade show active" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                <table class="table bg-light">
            <thead>
                <tr>
                    <th scope="col">Nr.</th>
                    <th scope="col">Seat class</th>
                    <th scope="col">Status</th>
                    <th scope="col">Statusas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        {{ $ticket->flight->id }}
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        {{-- <td>{{ $ticket->DepartureTime }}</td>
                        <td>{{ $ticket->ArrivalTime }}</td>
                        <td>{{ $ticket->Status }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
            </div>
            <div class="tab-pane fade" id="prifle" role="tabpanel" aria-labelledby="prifle-tab">

            </div>
        </div>
    </div>
@endsection
