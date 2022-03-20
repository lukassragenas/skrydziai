@extends('layouts.master')

@section('content')
    <section class="home-section d-flex align-items-top">
        <div class="container">
            <div class="row py-5 fade-right">
                <div class="col-md-12 mx-auto my-5 text-white text-uppercase">
                    <div class="my-profile pt-5">
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
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" id="ticket-tab" href="{{ route('reserved') }}">Mano
                                        rezervuoti bilietai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ticket1-tab" href="{{ route('paid') }}">Mano apmokėti
                                        bilietai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" id="prifle-tab" href="{{ route('profile') }}">Profilio
                                        redagavimas</a>
                                </li>
                            </ul>
                            <div class="card p-3" id="myTabContent">
                                <div class="row container p-3">
                                    <form action="{{ route('email') }}" method="POST" class="col-6">
                                        @csrf
                                        <h2>El. pašto keitimas</h2>
                                        <div class="form-group row align-items-center">
                                            <label for="staticEmail" class="col-form-label">Esamas el. pašto
                                                adresas</label>
                                            <div class="col-sm-10 m-0 p-0">
                                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                                    value="{{ auth()->user()->email }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput">Naujas el pašto adresas</label>
                                            <input type="email" class="form-control" id="formGroupExampleInput"
                                                name="email">
                                        </div>
                                        <button type="submit" class="primary-btn">Atnaujinti</button>
                                    </form>
                                    <form action="{{ route('password') }}" method="POST" class="col-6">
                                        @csrf
                                        <h2>Slaptažodžio keitimas</h2>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput1">Naujas slaptažodis</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="formGroupExampleInput2">Pakartokite naują slaptažodį</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                required>
                                        </div>
                                        <button type="submit" class="primary-btn">Atnaujinti</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
