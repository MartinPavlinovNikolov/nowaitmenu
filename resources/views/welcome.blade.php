<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>{{env('APP_NAME')}}</title>

        <link rel="stylesheet" href="{{ asset('/css/bootstrap-reboot.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">


    </head>
    <body>
        <div class="container-fluid flex-column">
            <nav class="row justify-content-around align-items-center" style="background-color: #f3e2cd">
                <div class="col-1">
                    <h1 class="lead"><a href='{{ url('/') }}'>NoWaitMenu-Logo</a></h1>
                </div>
                <div class="col-4">
                    <p class="text-right text-info" style="font-size: .6rem;margin: 0">"this is the best thing for restaurants since refrigeration was invented"</p>
                    <p class="text-right text-info" style="font-size: .6rem;margin: 0">Sir Gordon Ramsay</p>
                    <p class="text-right  text-success" style="font-size: .5rem;margin: 0"><a href="#">more testimonials</a></p>
                </div>
                <div class="col-1">
                    <a href="#" class="btn btn-warning btn-sm">try it free</a>
                </div>
                <div class="col-4 align-content-center">
                    <div class="row flex-row justify-content-around">
                        <div>
                            <a class="text-success" href="#">Features</a>
                        </div>
                        <div>
                            |
                        </div>
                        <div>
                            <a class="text-success" href="#">Pricing</a>
                        </div>
                        <div>
                            |
                        </div>
                        <div>
                            <a class="text-success" href="#">Support</a>
                        </div>
                        <div>
                            |
                        </div>
                        <div>
                            <a class="text-success" href="{{ route('employer.register') }}">Register</a>
                        </div>
                        <div>
                            |
                        </div>
                        <div>
                            <a class="text-success" href="{{ route('employer.login') }}">Login</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="row flex-row">
                <div class="col-12" style="margin: 0;padding: 0">
                    <hr>
                </div>
            </div>

            <!-- debuging purpose -->
            <div class="row flex-row">
                <div class="col-12 text-center">
                    @component('components.who')
                    @endcomponent
                </div>
            </div>

            <section class="row flex-row" style="min-height: 55vh;flex-grow: 1">
                <div class="col-8 offset-2 text-center">
                    <hr>
                    <h2 class="big">Get your restaurant runing in minutes</h2>
                    <div class="row flex-row">
                        <div class="col">Video tutorial-1</div>
                        <div class="col">Video tutorial-2</div>
                        <div class="col">Video tutorial-3</div>
                    </div>
                    <hr>
                    <div class="row flex-row justify-content-between">
                        <div class="col"><a href="#">Enter your E-mail</a></div>
                        <div class="col"><a href="#">Enter your password</a></div>
                        <div class="col"><a href="#" class="btn btn-warning btn-sm">try it free</a></div>
                    </div>
                </div>
            </section>
            <div class="row flex-row">
                <div class="col-12">
                    <hr>
                </div>
            </div>
            <footer class="row flex-row" style="background-color: #f3e2cd">
                <div class="col-8 offset-2 text-center">
                    <p class="small">boring|stuff|in|the|footer</p>
                </div>
            </footer>
        </div>
        <!--TODO: CDN BOOTSTRAPJS, jQuery...-->
    </body>
</html>
