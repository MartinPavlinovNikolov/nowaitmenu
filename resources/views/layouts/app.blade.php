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
    </head>
    <body>
        <div class="container-fluid flex-row">
            <nav class="row justify-content-around align-items-center" style="background-color: #f3e2cd;min-height: 4rem">
                @yield('nav')
            </nav>
            @yield('content')
            <footer  style="background-color: #f3e2cd;position: absolute;bottom: 0;left: 0;margin:0;padding: 0;width: 100%">
                <div class="container"><div class="row">
                        <div class="col-12 text-center">
                            <p class="small">boring|stuff|in|the|footer</p>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Scripts -->
            <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
            <script>
            $(document).ready(function () {
                $('.btn-employer').on('click', function(e){
                    e.preventDefault();
                    $(this).parent().children('.table-employers').css('display', 'block');
                });
                $('.close').on('click', function(e){
                    $(this).parent().parent().css('display', 'none');
                });
            });
            </script>
        </div>
    </body>
</html>
