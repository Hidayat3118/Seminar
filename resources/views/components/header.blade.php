<nav class="bg-white shadow-md dark:bg-gray-900 border fixed top-0 left-0 right-0 z-10">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <div class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('img/icon.jpg') }}" class="h-8" alt="Flowbite Logo" />
            {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span> --}}
        </div>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">

                <li>
                    <a href="#"
                        class=" py-2 text-sm md:text-base  px-3 text-gray-900 rounded-sm hidden hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
                </li>
                <li>
                    <a href="/"
                        class="block py-2 text-sm md:text-base  px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent   {{ Request::is('/') ? 'underline decoration-2 underline-offset-8 decoration-blue-500 text-blue-400 text-lg' : '' }}">Home</a>
                </li>
                <li>
                    <a href="/seminar"
                        class="block py-2 text-sm md:text-base  px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ Request::is('seminar') ? 'underline decoration-2 underline-offset-8 decoration-blue-500 text-blue-400 text-lg' : '' }}">Seminar</a>
                </li>
                <li>
                    <a href="/pembicara"
                        class="block py-2 text-sm md:text-base  px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ Request::is('pembicara') ? 'underline decoration-2 underline-offset-8 decoration-blue-500 text-blue-400 text-lg' : '' }}">Pembicara</a>
                </li>
                <li>
                    <a href="/moderator"
                        class="block py-2 text-sm md:text-base px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ Request::is('moderator') ? 'underline decoration-2 underline-offset-8 decoration-blue-500 text-blue-40 text-lg' : '' }}">Moderator</a>
                </li>
               
                {{-- button --}}
                @if (Route::has('login'))
                    <div class="md:flex grid gap-4 md:gap-8">
                        @auth
                            @php
                                $user = Auth::user();
                            @endphp

                            @if ($user->hasRole('panitia'))
                                {{-- Sqan Kehadiran --}}
                                <a href="/sqan"
                                    class="block py-2  text-sm md:text-base px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent {{ Request::is('sqan') ? 'underline decoration-2 underline-offset-8 decoration-blue-500 text-blue-40 text-lg' : '' }}">Sqan Kehadiran</a>
                                {{-- dashboard --}}
                                <a href="{{ route('filament.panitia.pages.dashboard') }}"
                                    class="group relative inline-block text-sm font-medium text-white focus:ring-3 focus:outline-hidden">
                                    <span
                                        class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-full"></span>
                                    <span
                                        class="relative block border border-current bg-blue-500 px-8 py-3 rounded-full">Dashboard
                                        Panitia</span>
                                </a>
                            @elseif ($user->hasRole('keuangan'))
                                <a href="{{ route('filament.keuangan.pages.dashboard') }}"
                                    class="group relative inline-block text-sm font-medium text-white focus:ring-3 focus:outline-hidden">
                                    <span
                                        class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-full"></span>
                                    <span
                                        class="relative block border border-current bg-blue-500 px-8 py-3 rounded-full">Dashboard
                                        Keuangan</span>
                                </a>
                            @else
                                {{-- dashboard  --}}
                                <a href="{{ url('/dashboard') }}"
                                    class="group relative inline-block text-sm font-medium text-white focus:ring-3 focus:outline-hidden">
                                    <span
                                        class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-full"></span>
                                    <span
                                        class="relative block border border-current bg-blue-500 px-8 py-3 rounded-full">Dashboard</span>
                                </a>
                            @endif
                        @else
                            <a class="group relative inline-block text-sm font-medium text-blue-400 focus:ring-3 focus:outline-hidden"
                                href="{{ route('login') }}">
                                <span
                                    class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-full"></span>
                                <span
                                    class="relative block border border-current bg-white px-6 md:px-7 py-2 md:py-3 rounded-full">Login</span>
                            </a>

                            @if (Route::has('register'))
                                <a class="group relative inline-block text-sm font-medium text-white focus:ring-3 focus:outline-hidden"
                                    href="{{ route('register') }}">
                                    <span
                                        class="absolute inset-0 translate-x-0.5 translate-y-0.5 bg-blue-500 transition-transform group-hover:translate-x-0 group-hover:translate-y-0 rounded-full"></span>
                                    <span
                                        class="relative block border border-current bg-blue-500 px-6 md:px-7 py-2 md:py-3 rounded-full">Registrasi</span>
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif

            </ul>
        </div>
    </div>
</nav>
