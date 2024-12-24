<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TigerDen</title>
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Inter::wght@100;200;300;400;500;600;700&display=swap" rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>
    <!--Navbar-->
    <nav
        id="navbar"
        data-route="{{ Route::currentRouteName() }}"
        class="fixed w-full z-50 top-0 start-0 
        {{ request()->routeIs('offers') || request()->routeIs('room') ? 'bg-jungle-green text-black' : 'bg-transparent text-white' }} 
        transition-colors duration-300">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('home') }}" class="text-white self-center text-4xl font-semibold whitespace-nowrap dark:text-white font-caveat">
                TigerDen Luxury Hotel
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 bg-transparent">
                    <li>
                        <a href="{{ route('offers') }}" class="font-inter block py-2 px-3 rounded md:bg-transparent md:text-white md:p-0 md:hover:text-jungle-brown md:dark:text-blue-500" aria-current="page">
                            OFFERS
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('room') }}" class="font-inter block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-jungle-brown md:p-0">
                            ROOM
                        </a>
                    </li>
                    <li>
                        <a href="{{ route ('dine') }}" class="font-inter block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-jungle-brown md:p-0">
                            DINING
                        </a>
                    </li>
                    <li>
                        <a href="{{ route ('amenities') }}" class="font-inter block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-jungle-brown md:p-0">
                            AMENITIES
                        </a>
                    </li>
                    <li>
                        <a href="#" class="font-inter block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-jungle-brown md:p-0">
                            OUR HOTEL
                        </a>
                    </li>
                    @guest
                    <!-- Show Login if user is not authenticated -->
                    <li>
                        <a href="{{ route ('login')}}" class="font-inter block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-jungle-brown md:p-0">
                            LOGIN
                        </a>
                    </li>
                    @endguest
                    @auth
                    <!-- Show More Dropdown if user is logged In -->
                    <li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex items-center justify-between font-inter py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-jungle-brown md:p-0">MORE <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" 
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{route ('myreservation')}}" class="block px-4 py-2 font-inter hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My Reservations</a>
                                </li>
                                <li>
                                    <a href="{{route ('book')}}" class="block px-4 py-2 font-inter hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reserve Now</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Show Logout if user is authenticated -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="font-inter block py-2 px-3 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-jungle-brown md:p-0">
                                LOGOUT
                            </button>
                        </form>
                    </li>
                    @endauth
            </div>
    </nav>
    @yield('content')
    @if(!request()->is('reservation/success'))
    <footer class="bg-jungle-dark-brown py-8 font-inter">
        <div class="container mx-auto px-10">
            <div class="flex flex-col md:flex-row justify-between items-center md:space-x-8 border-b border-white pb-4">
                <div class="flex flex-col md:flex-row items-center md:space-x-8">
                    <a href="#" class="text-white hover:underline">CONTACT & LOCATION</a>
                    <a href="#" class="text-white hover:underline">NOTICE OF ACCESSIBILITY</a>
                    <a href="#" class="text-white hover:underline">PRIVACY POLICY</a>
                    <a href="#" class="text-white hover:underline">HOTEL POLICIES</a>
                </div>
                <div class="flex space-x-4 mt-4 mr-4 md:mt-0">
                    <a href="#" class="text-white text-2xl"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white text-2xl"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-start mt-4">
                <div class="text-center md:text-left">
                    <h2 class="logo-font text-3xl text-white font-caveat">TigerDen Luxury Hotel</h2>
                    <p class="text-white mt-2">España Blvd, Sampaloc, Manila, 1008</p>
                    <p class="text-white mt-2">Reservations & Inquiries: +63-995-123-4567</p>
                    <p class="text-white mt-2">Email: reservations@tigerdenhotel.com</p>
                </div>
            </div>
        </div>
    </footer>
    @endif
</body>

</html>