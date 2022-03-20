@extends('layouts.master')

@section('content')
    <section class="home-section d-flex align-items-top">
        <div class="container">
            <div class="row py-5 fade-right">
                <div class="col-md-12 mx-auto my-5 text-white text-uppercase">
                    <div class="my-profile pt-5">
                        <div class="container mt-5">
                            @if (\Session::has('msg'))
                                <div class="alert alert-success">
                                    {!! \Session::get('msg') !!}
                                </div>
                            @endif
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nr.</th>
                                        <th scope="col">Išvykimo data</th>
                                        <th scope="col">Atvykimo data</th>
                                        <th scope="col">Statusas</th>
                                        @auth
                                            <th scope="col">Klasė</th>
                                            <th scope="col">Rezervuotis</th>
                                        @endauth
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($flights as $flight)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ $flight->departure_time }}</td>
                                            <td>{{ $flight->arrival_time }}</td>
                                            <td>{{ $flight->status }}</td>
                                            @auth
                                                <form action="{{ route('reserve') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                                                    <td>
                                                        <div class="form-group">
                                                            <select name="seat_class" class="form-control">
                                                                <option value="ekonomine">Ekonominė</option>
                                                                <option value="pirma">Pirma</option>
                                                                <option value="verslo">Verslo</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="primary-btn">Rezervuoti</button>
                                                    </td>
                                                </form>
                                            @endauth
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
