@extends('layouts.master')

@section('content')
    <div class="container mt-5">
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
                <a class="nav-link active" id="ticket-tab" data-toggle="tab" href="#ticket" role="tab" aria-controls="ticket"
                    aria-selected="true">Mano rezervuoti bilietai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="ticket1-tab" data-toggle="tab" href="#ticket1" role="tab"
                    aria-controls="ticket1" aria-selected="true">Mano apmokėti bilietai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="prifle-tab" data-toggle="tab" href="#prifle" role="tab" aria-controls="prifle"
                    aria-selected="false">Profilio redagavimas</a>
            </li>
        </ul>
        <div class="tab-content bg-light p-3" id="myTabContent">
            <div class="tab-pane fade show active" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                <table class="table table-hover bg-light">
                    <thead>
                        <tr>
                            <th scope="col">Skrydis</th>
                            <th scope="col">Išvykimo data</th>
                            <th scope="col">Iš oro uosto</th>
                            <th scope="col">Į oro uosto</th>
                            <th scope="col">Statusas</th>
                            <th scope="col">Kaina</th>
                            <th scope="col">Pirkti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->flight->id }}</td>
                                <td>{{ $ticket->flight->departure_time }}</td>
                                <td>{{ $ticket->flight->airport_from->name }}</td>
                                <td>{{ $ticket->flight->airport_to->name }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>{{ $ticket->flight->tickets_price }} €</td>
                                <td>
                                    @if ($ticket->status == 'Rezervuotas')
                                        <form action="" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary">Pirkti bilietą</button>
                                        </form>
                                    @else
                                        <label for="">Bilietas nupirktas</label>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="ticket1" role="tabpanel" aria-labelledby="ticket1-tab">
                Nėra apmokėtų bilietų
            </div>
            <div class="tab-pane fade" id="prifle" role="tabpanel" aria-labelledby="prifle-tab">
                <div class="container p-3">
                    <form action="{{ route('email') }}" method="POST">
                        @csrf
                        <h2>El. pašto keitimas</h2>
                        <div class="form-group row align-items-center">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Esamas el. pašto adresas</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                    value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Naujas el pašto adresas</label>
                            <input type="email" class="form-control" id="formGroupExampleInput" name="email">
                        </div>
                        <button type="submit" class="btn btn-secondary">Atnaujinti</button>
                    </form>
                    <form action="{{ route('password') }}" method="POST" class="mt-4">
                        @csrf
                        <h2>Slaptažodžio keitimas</h2>
                        <div class="form-group">
                            <label for="formGroupExampleInput1">Naujas slaptažodis</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput2">Pakartokite naują slaptažodį</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-secondary">Atnaujinti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
