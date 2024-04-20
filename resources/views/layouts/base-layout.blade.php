<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Zen+Antique&display=swap" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            overflow-x: hidden;
        }

        .menubar {
            transition: transform 0.3s ease-in-out;
            /* Add smooth transition for animation */
            transform: translateX(200px);
            /* Initially hide the menu off-screen */
            z-index: 99;
        }

        .show-menu {
            transform: translateX(0);
            /* Move menu into view when active */
        }
    </style>


</head>

<body class="text-gray-900 bg-gray-100 w-screen" style=" font-family: 'Zen Antique', serif;">

    <nav
        class="absolute top-0 left-0 px-[14vw] h-[48px] w-screen flex flex-wrap flex-row justify-between items-center shadow-sm">
        <div class="h-[34px]"><a href="{{ url('/') }}"><img src="{{ asset('img/header_logo.svg') }}" alt="logo"
                    class="h-full w-auto bg-cover"></a></div>
        <div class="w-1/2 flex flex-wrap flex-row justify-end items-center ">
            <div class="w-1/2 flex flex-row flex-wrap justify-evenly items-center">
                <a class="hover:text-black" href="{{ route('search') }}">Search & Discover</a>
                <a class="hover:text-black" href="{{ route('books') }}">Books</a>
            </div>
            <div class="w-1/3 flex justify-between items-center">
                <a @auth
href="{{ route('myOrders') }}" @endauth><img class="h-[24px] cursor-pointer"
                        src="{{ asset('img/icons/shopping_bag.png') }}" alt="cart"></a>
                <a @auth
href="{{ route('reservation') }}" @endauth><img class="h-[24px] cursor-pointer"
                        src="{{ asset('img/icons/catalog.png') }}" alt="catalog">
                </a> <button onclick="menuToggle()" class="menu-toggle"><img class="h-[24px] cursor-pointer"
                        src="{{ asset('img/icons/menu.png') }}" alt="menu"></button>
            </div>
        </div>
        <div class="menubar fixed h-screen w-[200px] bg-white top-0 right-0 border-left overflow-hidden">
            @auth
                <h4 class="w-full py-3 pl-3 text-xl">{{ auth()->user()->name }}</h4>

                <p class="text-sm pl-3">{{ auth()->user()->email }}</p>
            @else
                <h4 class="w-full py-3 pl-3 text-xl">{{ _('Guest') }}</h4>
            @endauth
            <hr>

            <ul class="list-none flex flex-wrap flex-column justify-center space-y-4 pt-4 text-zinc-600">
                <li class="nav-link "><a class="hover:text-black" href="{{ url('/') }}"><i
                            class="fas fa-home"></i>
                        <span>Home</span></a></li>
                @auth

                    <li class="nav-link"><a class="hover:text-black" href="{{ route('profile.edit') }}"><i
                                class="fas fa-user"></i>
                            <span>Edit Profile</span></a>
                    </li>
                @endauth
                <li class="nav-link"><a class="hover:text-black" href="{{ route('aboutUs') }}"><i
                            class="fas fa-info-circle"></i>
                        <span>About
                            Us</span></a></li>
                @auth
                    <li class="nav-link"><a class="hover:text-black"class="hover:text-black"
                            href="{{ route('myOrders') }}"><i class="fas fa-truck-loading"></i>
                            <span>Orders</span></a></li>
                @endauth
                <li class="nav-link"><a class="hover:text-black" href="{{ route('reservation') }}"><i
                            class="fas fa-file-alt"></i>
                        <span>Reservation & Hold</span></a></li>
                <li class="nav-link"><a class="hover:text-black" href="{{ route('tnc') }}"><i
                            class="fas fa-file-alt"></i>
                        <span>Terms &
                            Conditions</span></a></li>
                <li class="nav-link"><a class="hover:text-black" href="{{ route('policy') }}"><i
                            class="fas fa-file-contract"></i>
                        <span>Privacy Policy</span></a></li>
                <hr>
                @role('admin')
                    <li class="nav-link"><a class="hover:text-black" href="{{ route('admin.index') }}"><i
                                class="fas fa-user-tie"></i>
                            <span>Admin Panel</span></a></li>
                @endrole
                @role('staff')
                    <li class="nav-link"><a class="hover:text-black" href="{{ route('staff.index') }}"><i
                                class="fas fa-user-nurse"></i>
                            <span>Staff Panel</span></a></li>
                @endrole
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li class="nav-link">
                            <button type="submit">
                                <a class="hover:text-red-500">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Log Out</span>
                                </a>
                            </button>
                        </li>
                    </form>
                @else
                    <li class="nav-link"><a class="hover:text-black" href="{{ route('login') }}">
                            <span>Log In</span></a>

                    <li class="nav-link"><a class="hover:text-black" href="{{ route('register') }}">
                            <span>Create account</span></a></li>
                    </li>


                @endauth

            </ul>



        </div>
    </nav>
    <div class="py-[24px]"></div>

    {{ $slot }}

    <footer class="relative bg-blueGray-200 pt-8 pb-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap text-left lg:text-left">
                <div class="w-full lg:w-6/12 px-4">
                    <h4 class="text-3xl fonat-semibold text-blueGray-700">Let's keep in touch!</h4>
                    <h5 class="text-lg mt-0 mb-2 text-blueGray-600">
                        Find us on any of these platforms, we respond 1-2 business days.
                    </h5>
                    <div class="mt-6 lg:mb-0 mb-6">
                        <button
                            class="bg-white text-lightBlue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                            <i class="fab fa-twitter"></i></button><button
                            class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                            <i class="fab fa-facebook-square"></i></button><button
                            class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                            <i class="fab fa-dribbble"></i></button><button
                            class="bg-white text-blueGray-800 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                            <i class="fab fa-github"></i>
                        </button>
                    </div>
                </div>
                <div class="w-full lg:w-6/12 px-4">
                    <div class="flex flex-wrap items-top mb-6">
                        <div class="w-full lg:w-4/12 px-4 ml-auto">
                            <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Useful
                                Links</span>
                            <ul class="list-unstyled">
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                        href="https://www.creative-tim.com/presentation?ref=njs-profile">About
                                        Us</a>
                                </li>
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                        href="https://blog.creative-tim.com?ref=njs-profile">Blog</a>
                                </li>
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                        href="https://www.github.com/creativetimofficial?ref=njs-profile">Github</a>
                                </li>
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                        href="https://www.creative-tim.com/bootstrap-themes/free?ref=njs-profile">Free
                                        Products</a>
                                </li>
                            </ul>
                        </div>
                        <div class="w-full lg:w-4/12 px-4">
                            <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Other
                                Resources</span>
                            <ul class="list-unstyled">
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                        href="https://github.com/creativetimofficial/notus-js/blob/main/LICENSE.md?ref=njs-profile">MIT
                                        License</a>
                                </li>
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                        href="https://creative-tim.com/terms?ref=njs-profile">Terms &amp;
                                        Conditions</a>
                                </li>
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                        href="https://creative-tim.com/privacy?ref=njs-profile">Privacy
                                        Policy</a>
                                </li>
                                <li>
                                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                        href="https://creative-tim.com/contact-us?ref=njs-profile">Contact
                                        Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-6 border-blueGray-300">
            <div class="flex flex-wrap items-center md:justify-between justify-center">
                <div class="w-full md:w-4/12 px-4 mx-auto text-center">
                    <div class="text-sm text-blueGray-500 font-semibold py-1">
                        Copyright © <span id="get-current-year">2021</span><a
                            href="https://www.creative-tim.com/product/notus-js"
                            class="text-blueGray-500 hover:text-gray-800" target="_blank"> Notus JS by
                            <a href="https://www.creative-tim.com?ref=njs-profile"
                                class="text-blueGray-500 hover:text-blueGray-800">Creative Tim</a>.
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
<script src="{{ asset('js/main.js') }}"></script>

</html>
