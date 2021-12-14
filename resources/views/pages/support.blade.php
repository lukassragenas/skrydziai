@extends('layouts.master')

@section('content')
    <div class="forma">
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
            <input type="email" name="email" placeholder="El. paštas">
            <input type="text" name="subject" placeholder="Tema">
            <textarea name="content" placeholder="Jūsų pranešimas"></textarea>
            <input type="submit" value="Siųsti">
        </form>
    </div>
@endsection
