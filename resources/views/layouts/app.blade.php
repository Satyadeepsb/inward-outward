<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inward-Outward</title>
    <meta name="author" content="Stark Technologies"/>
    <meta name="description" content="Inward Outward Management Software">
    <meta name="author" content="Satyadeep Basugade"/>
    <meta name="author" content="Sagar Kanse"/>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link href="/css/toastr.min.css" rel="stylesheet"/>
    <link href="/css/bootstrap-multiselect.css" rel="stylesheet" />
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
                <a class="navbar-brand" href="{{ url('/home') }}">
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
                               class="{{ (str_contains(Request::path(), 'application') || str_contains(Request::path(), 'home')) ? 'list-group-item active' : 'list-group-item' }}">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i> &nbsp;
                                Applications
                            </a>
                            <a href="{{route('users.index')}}"
                               class="{{ (str_contains(Request::path(), 'user')) ? 'list-group-item active' : 'list-group-item' }}">
                                <i class="fa fa-users" aria-hidden="true"></i> &nbsp;
                                Users
                            </a>
                            <a href="{{route('settings.index')}}"
                               class="{{ (str_contains(Request::path(), 'settings')) ? 'list-group-item active' : 'list-group-item' }}">
                                <i class="fa fa-cog" aria-hidden="true"></i> &nbsp;
                                Settings
                            </a>
                             <a href="{{route('master.index',['type'=>'designation'])}}"
                                class="{{ (str_contains(Request::path(), 'designation')) ? 'list-group-item active' : 'list-group-item' }}">
                                 <i class="fa fa-flag-o" aria-hidden="true"></i> &nbsp; Designation</a>
                             <a href="{{route('master.index',['type'=>'document'])}}"
                                class="{{ (str_contains(Request::path(), 'document')) ? 'list-group-item active' : 'list-group-item' }}"
                             ><i class="fa fa-file-archive-o" aria-hidden="true"></i> &nbsp;  Document </a>
                             <a href="{{route('master.index',['type'=>'district'])}}"
                                class="{{ (str_contains(Request::path(), 'district')) ? 'list-group-item active' : 'list-group-item' }}">
                                 <i class="fa fa-globe" aria-hidden="true"></i> &nbsp;  District</a>
                             <a href="{{route('master.index',['type'=>'taluka'])}}"
                                class="{{ (str_contains(Request::path(), 'taluka')) ? 'list-group-item active' : 'list-group-item' }}">
                                 <i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp;  Taluka</a>
                             <a href="{{route('master.index',['type'=>'action'])}}"
                                class="{{ (str_contains(Request::path(), 'action')) ? 'list-group-item active' : 'list-group-item' }}">
                                 <i class="fa fa-bolt" aria-hidden="true"></i> &nbsp;  Action</a>
                             <a href="{{route('master.index',['type'=>'department'])}}"
                                class="{{ (str_contains(Request::path(), 'department')) ? 'list-group-item active' : 'list-group-item' }}">
                                 <i class="fa fa-university" aria-hidden="true"></i> &nbsp; Department</a>
                             <a href="{{route('master.index',['type'=>'location'])}}"
                                class="{{ (str_contains(Request::path(), 'location')) ? 'list-group-item active' : 'list-group-item' }}">
                                 <i class="fa fa-location-arrow" aria-hidden="true"></i> &nbsp;  Location</a>
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
<script src="/js/toastr.min.js"></script>
<script src="/js/bootstrap3-typeahead.min.js"></script>
<script src="/js/bootstrap-multiselect.js"></script>
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
