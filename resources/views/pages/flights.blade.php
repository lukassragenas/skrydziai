@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        @if (\Session::has('msg'))
            <div class="alert alert-success">
                {!! \Session::get('msg') !!}
            </div>
        @endif
        <table class="table bg-light">
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
                                    <button type="submit" class="btn btn-success">Rezervuoti</button>
                                </td>
                            </form>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
