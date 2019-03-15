<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inward-Outward Management</title>
    <meta name="author" content="Stark Technologies"/>
    <meta name="description" content="Inward Outward Management Software">
    <meta name="author" content="Satyadeep Basugade"/>
    <meta name="author" content="Sagar Kanse"/>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link href="/css/style.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Inward-Outward Management
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->

                    @if (Auth::guest())
                        {{--  <li><a href="{{ url('/login') }}">Login</a></li>--}}
                        {{-- <li><a href="{{ url('/register') }}">Register</a></li>--}}
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @if (Auth::guest())
        @yield('content')
    @else
        @if(Auth::user()->hasRole('SUPERUSER'))
            <div class="row-fluid">
                <div class="col-md-offset-1 col-md-10">
                    <div class="col-md-2" style="padding: 0">
                        <div class="list-group">
                            <a href="/applications"
                               class="{{ (Request::path() ==  'applications' || Request::path() ==  'home') ? 'list-group-item active' : 'list-group-item' }}">Applications</a>
                            <a href="{{route('users.index')}}"
                               class="{{ Request::path() ==  'super/users' ? 'list-group-item active' : 'list-group-item' }}">Users</a>
                            {{-- <a href="#" class="list-group-item">Designation</a>
                             <a href="#" class="list-group-item">Document </a>
                             <a href="#" class="list-group-item">District</a>
                             <a href="#" class="list-group-item">Taluka</a>
                             <a href="#" class="list-group-item">Action</a>
                             <a href="#" class="list-group-item">Department</a>
                             <a href="#" class="list-group-item">Location</a>--}}
                        </div>
                    </div>
                    <div class="col-md-10" style="margin-top:0px;padding: 0">
                        @yield('content')
                    </div>
                </div>
            </div>
        @else
            <div class="row-fluid">
                @yield('content')
            </div>
        @endif

    @endif


</div>

<!-- Scripts -->
<script src="/js/app.js"></script>

<!-- Bootstrap datepicker JS and CSS -->
<script src="/js/bootstrap-datepicker.js"></script>


{{--Another way of includeing JS/CSS files--}}
<link rel="stylesheet" href="{{asset('css/toastr.min.css')}}"/>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if(Session::has('success'))
    toastr.success("{{Session::get('success')}}");
    @endif
    @if(Session::has('error'))
    toastr.error("{{Session::get('error')}}");
    @endif
    @if(Session::has('warning'))
    toastr.warning("{{Session::get('warning')}}");
    @endif
    @if(Session::has('info'))
    toastr.info("{{Session::get('info')}}");
    @endif
</script>

<script src="/js/modal.js"></script>

</body>
</html>
