{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

@extends('layouts.master')
@section('content')
    <section class="home-section d-flex align-items-center">
        <div class="container">
            <div class="row py-5">
                <div class="col-md-12 mx-auto my-5 text-white text-uppercase row justify-content-center">
                    <div class="login-form register-add fade-right">
                        <div class="header">Registracija</div>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-6 col-left">
                                    <div>
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <x-label for="name" :value="__('Vardas')" />
                                    </div>
                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name')" required autofocus />
                                </div>
                                <div class="col-6 col-right">
                                    <div>
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <x-label for="email" :value="__('El. paštas')" />
                                    </div>
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" required autofocus />
                                </div>
                            </div>
                            <div>
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <x-label for="password" :value="__('Slaptažodis')" />
                            </div>
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                                autocomplete="current-password" />
                            <div>
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <x-label for="password_confirmation" :value="__('Slaptažodžio patvirtinimas')" />
                            </div>
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required />
                            <x-button class="primary-btn mt-4">
                                {{ __('Registruotis') }}
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
