@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <table class="table bg-light">
            <thead>
                <tr>
                    <th scope="col">Nr.</th>
                    <th scope="col">Išvykimo data</th>
                    <th scope="col">Atvykimo data</th>
                    <th scope="col">Statusas</th>
                    @auth
                        <th scope="col">Rezervuotis</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($flights as $flight)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{$flight->DepartureTime}}</td>
                        <td>{{$flight->ArrivalTime}}</td>
                        <td>{{$flight->Status}}</td>
                        @auth
                            <form action="" method="post">
                                <button type="submit" class="btn btn-primary-outline"></button>
                            </form>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
