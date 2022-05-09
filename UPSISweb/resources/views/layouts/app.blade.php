<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UPSIS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#accordionSidebar li a").click(function() {
                var id = $(this).attr("id");
                $('#' + id).parent().siblings().removeClass("active");
                $('#' + id).parent().addClass("active");
                localStorage.setItem("selectedolditem", id);
               
            });
            var selectedolditem = localStorage.getItem('selectedolditem');
            // $("p").text(selectedolditem);
            if (selectedolditem != null) {
                $('#' + selectedolditem).siblings().find(".active").removeClass("active");
                $('#' + selectedolditem).parent().addClass("active");
            }

        });
        
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ url('css/icon.png') }}">
    <style>
        html {
            height: 100%
        }

        table.table-bordered {
            border: 1px solid #4e73df;
            margin-top: 10px;
        }

        table.table-bordered>thead>tr>th {
            border: 1px solid bg-gray-900;
        }

        table.table-bordered>tbody>tr>td {
            border: 1px solid #4e73df;
        }

        th:first-of-type {
            border-top-left-radius: 9px;
        }

        th:last-of-type {
            border-top-right-radius: 9px;
        }

        /* tr:last-of-type td:first-of-type {
            border-bottom-left-radius: 10px;
        }

        tr:last-of-type td:last-of-type {
            border-bottom-right-radius: 10px;
        } */
        


        /* Style the buttons */
        .btn {
            border: none;
            outline: none;
            padding: 12px 16px;
           
            cursor: pointer;
        }

        .btn.active {
            background-color: #666;
            color: white;
        }
    </style>
    

</head>
{{-- <body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body> --}}

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" style="height: 100%">
        {{-- @if (Auth::check()) --}}
        @auth
            @include('inc.navbar')
        @endauth
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('inc.whitenavbar')
                @yield('messages')
                @yield('content')
            </div>
            @include('inc.footer')
        </div>

        {{-- @else
            @include('auth.login')
        @endif --}}
</body>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
<script>
    
    function testDisplay(tableId, test) {
      if(test=='all')
      {                  
        var table = document.getElementById(tableId);
            for (var i = 0, row; row = table.rows[i]; i++) {                
                    row.style.removeProperty("display");                
            }
      }
        else {
            first=false;
            var table = document.getElementById(tableId);
            for (var i = 1, row; row = table.rows[i]; i++) {
                if (row.className != test) {
                    row.style.display = "none";
                }
                else {
                    row.style.removeProperty("display");
                }
            }
        }         
    }    

    // Add active class to the current button (highlight it)
    var btnContainer = document.getElementById("buttons");
    var btns = btnContainer.getElementsByClassName("btn");
    btns.siblings().removeClass('active');
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            
            current.addClass('active').siblings().removeClass('active');
            // current[0].className = current[0].className.replace(" active", "");
            // this.className += " active";
        });
    }
</script>

</html>
