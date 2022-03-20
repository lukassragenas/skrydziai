@extends('layouts.master')

@section('content')
    <section class="home-section d-flex align-items-center">
        <div class="container">
            <div class="row py-5 fade-right">
                <div class="col-md-12 mx-auto my-5 text-white text-uppercase">
                    <h2 class="btn-shine subtitle">Elektroninių Bilietų Platforma</h2>
                    {{-- <h2 class="subtitle">Elektroninių Bilietų Platforma</h2> --}}
                    <h1 class="title">Išsirink kelionės<br> bilietą pas mus!</h1><br />
                </div>

                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('findFlight') }}" method="GET">
                            <div class="row align-items-center">
                                <div class="form-group col-3">
                                    <select class="form-control" name="fromAirPort">
                                        <option selected>Keliauju iš...</option>
                                        @foreach ($airports as $airport)
                                            <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <select class="form-control" name="toAirPort">
                                        <option selected>Keliauju į...</option>
                                        @foreach ($airports as $airport)
                                            <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-3">
                                    <input id="datepicker" name="departureDate" placeholder="Data" />
                                </div>
                                <div class="col-3">
                                    <input class="text-uppercase primary-btn pulse" type="submit"
                                        value="Ieškoti bilieto"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="banner-section">
        <div class="grid">
            <!--Left side-->
            <div id="col-1" class="column effect-hover">
                <div class="content">
                    <a href="{{ route('home') }}">
                        <h2>Paieška</h2>
                        <h3>Suraskite norimą<br> bilietą</h3>
                    </a>
                </div>
            </div>
            <!--Right side-->
            <div id="col-2" class="column effect-hover">
                <div class="content">
                    <a href="{{ route('support') }}">
                        <h2>Pagalba</h2>
                        <h3>Užduokite<br> klausimą</h3>
                    </a>
                </div>
            </div>
        </div>

        @guest
            <div class="grid">
                <!--Left side-->
                <div id="col-3" class="column effect-hover">
                    <div class="content">
                        <a href="{{ route('login') }}">
                            <h2>Prisijungimas</h2>
                            <h3>Prisijunkite<br>prie sistemos</h3>
                        </a>
                    </div>
                </div>
                <!--Right side-->
                <div id="col-4" class="column effect-hover">
                    <div class="content">
                        <a href="{{ route('register') }}">
                            <h2>Registracija</h2>
                            <h3>Užsiregistruokite<br> sistemoje</h3>
                        </a>
                    </div>
                </div>
            </div>

        @endguest

    </section>
@endsection
@section('scripts')
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endsection
