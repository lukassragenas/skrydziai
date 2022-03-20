    <nav class="navbar">
        <div class="left-col">
            <a href="{{ route('home') }}"> <img class="logo" src="/storage/images/logo-white.png">
            </a>
        </div>
        <div class="right-col">
            <ul>
                <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Bilietų
                        paieška</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li><a class="{{ request()->is('mano-profilis') ? 'active' : '' }}"
                                href="{{ route('profile') }}">Mano profilis</a></li>
                    @else
                        <li><a class="{{ request()->is('login') ? 'active' : '' }}"
                                href="{{ route('login') }}">Prisijungimas</a>
                        </li>

                        @if (Route::has('register'))
                            <li><a class="{{ request()->is('register') ? 'active' : '' }}"
                                    href="{{ route('register') }}">Registracija</a></li>
                        @endif
                    @endauth
                @endif
                <li><a class="{{ request()->is('pagalba') ? 'active' : '' }}"
                        href="{{ route('support') }}">Pagalba</a>
                </li>
                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                                                                    this.closest('form').submit();">
                                {{ __('Atsijungti') }}
                            </x-responsive-nav-link>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>

    </nav>
