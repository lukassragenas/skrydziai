@extends('layouts.master')

@section('content')

    <section class="home-section d-flex align-items-center">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-12 mx-auto my-5 text-white text-uppercase row justify-content-center">
                    <div class="login-form register-add fade-right">

                        <div class="header">Pagalbos centras</div>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
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
                        <form action="{{ route('send.email') }}" method="POST">
                            @csrf
                            Sveiki, susisiekite su mumis, atsakymą gausite per 24 valandas!</br></br>
                            <input class="mb-5" type="email" name="email" placeholder="El. paštas">
                            <input class="mb-5" type="text" name="subject" placeholder="Tema">
                            <textarea class="mb-5 p-3" name="content" placeholder="Jūsų pranešimas"></textarea>
                            <input class="mt-4 w-100" type="submit" value="Siųsti">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
