<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="position:relative;min-height: 100%">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <link rel="stylesheet" href="{{ asset('/css/bootstrap-reboot.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
        @yield('styles')
    </head>
    <body>
        <div class="container-fluid flex-row">
            <nav class="row justify-content-around align-items-center">
                @yield('nav')
            </nav>
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
