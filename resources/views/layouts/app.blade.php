<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('/css/bootstrap-reboot.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/helpers.css') }}">
        @yield('styles')
    </head>
    <body>
        <div class="container-fluid">
            <nav class="row flex-row justify-content-between align-items-center">
                <div class="col-auto">
                    <a href='{{ url('/') }}'><image class="m-t-10 m-b-10" src="logos/logo80.png" alt="NoWaitMenu-Logo"></a>
                </div>
                <div class="col-auto align-content-center">
                    <div class="row justify-content-around align-items-center prity-nav-items">
                        @yield('nav')
                    </div>
                </div>
            </nav>
            {{ message() }}
            @yield('content')
            <footer>
                <div class="container"><div class="row">
                        <div class="col-12 text-center">
                            <p class="small">boring|stuff|in|the|footer</p>
                        </div>
                    </div>
                </div>
            </footer>
            @yield('scripts')
        </div>
    </body>
</html>
