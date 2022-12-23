<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kebab Ayu</title>
    <link rel="icon" href="/img/logo.png" type="logo">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style type="text/css">
        /* ============ desktop view ============ */
        @media all and (min-width: 992px) {

            .dropdown-menu li {
                position: relative;
            }

            .dropdown-menu .submenu {
                display: none;
                position: absolute;
                left: 100%;
                top: -7px;
            }

            .dropdown-menu .submenu-left {
                right: 100%;
                left: auto;
            }

            .dropdown-menu>li:hover {
                background-color: #f1f1f1
            }

            .dropdown-menu>li:hover>.submenu {
                display: block;
            }
        }

        /* ============ desktop view .end// ============ */

        /* ============ small devices ============ */
        @media (max-width: 991px) {

            .dropdown-menu .dropdown-menu {
                margin-left: 0.7rem;
                margin-right: 0.7rem;
                margin-bottom: .5rem;
            }

        }

        /* ============ small devices .end// ============ */
    </style>
    <script type="text/javascript">
        //	window.addEventListener("resize", function() {
        //		"use strict"; window.location.reload();
        //	});


        document.addEventListener("DOMContentLoaded", function() {


            /////// Prevent closing from click inside dropdown
            document.querySelectorAll('.dropdown-menu').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            })



            // make it as accordion for smaller screens
            if (window.innerWidth < 992) {

                // close all inner dropdowns when parent is closed
                document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
                    everydropdown.addEventListener('hidden.bs.dropdown', function() {
                        // after dropdown is hidden, then find all submenus
                        this.querySelectorAll('.submenu').forEach(function(everysubmenu) {
                            // hide every submenu as well
                            everysubmenu.style.display = 'none';
                        });
                    })
                });

                document.querySelectorAll('.dropdown-menu a').forEach(function(element) {
                    element.addEventListener('click', function(e) {

                        let nextEl = this.nextElementSibling;
                        if (nextEl && nextEl.classList.contains('submenu')) {
                            // prevent opening link if link needs to open dropdown
                            e.preventDefault();
                            console.log(nextEl);
                            if (nextEl.style.display == 'block') {
                                nextEl.style.display = 'none';
                            } else {
                                nextEl.style.display = 'block';
                            }

                        }
                    });
                })
            }
            // end if innerWidth

        });
        // DOMContentLoaded  end
    </script>
</head>
@include('header')

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="main_nav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }} </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item" href={{ url('berandaPusat') }}>Dashboard</a></li>
                                <li><a class="dropdown-item" href={{ url('adminPusatKaryawan') }}>Karyawan</a></li>
                                <li><a class="dropdown-item" href={{ url('adminMenu') }}>Daftar Menu</a></li>
                                <li><a class="dropdown-item" href={{ url('adminPusatMenu') }}>Stok Menu</a></li>
                                <li><a class="dropdown-item" href="#"> Cabang 1 &raquo; </a>
                                    <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item" href={{ url('adminPusat') }}>Permintaan Bahan</a></li>
                                        <li><a class="dropdown-item" href="adminPusatPesan">Transaksi</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="#"> Cabang 2 &raquo; </a>
                                    <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item" href={{ url('adminPusat2') }}>Permintaan Bahan</a></li>
                                        <li><a class="dropdown-item" href={{ url('adminPusatPesan22') }}>Transaksi</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="#"> Cabang 3 &raquo; </a>
                                    <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item" href={{ url('adminPusat3') }}>Permintaan Bahan</a></li>
                                        <li><a class="dropdown-item" href={{ url('adminPusatPesan33') }}>Transaksi</a></li>
                                    </ul>
                                </li>
                                <li><a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Keluar </a></li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div> <!-- navbar-collapse.// -->
            </div> <!-- container-fluid.// -->
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweet::alert')
</body>

</html>