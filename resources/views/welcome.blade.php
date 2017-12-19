<!doctype html>
<html lang="{{ app()->getLocale() }}" style="position:relative;min-height: 100%">
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
            <nav class="row justify-content-around align-items-center" style="background-color: #f3e2cd;min-height: 4rem">
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
            <section class="row flex-row" style="min-height: 55vh;flex-grow: 1">
                <div class="col-8 offset-2 text-center">
                    <h2 class="big">Get your restaurant runing in minutes</h2>
                    <hr>
                    <div class="text-success row flex-row justify-content-around">
                        @for($i=1;$i<=3;$i++)
                        <div class="row flex-row flex-wrap justify-content-center align-content-center" style="width: 12rem;height: 8rem;border: 2px solid red;border-radius: 10px;background-color: #f3e2cd;">
                            <div class="w-100 align-self-start" style="font-size: .8rem;padding: 0">
                                Video tutorial-{{$i}}
                            </div>
                            <div class="w-100 align-self-center" style="font-size: 4rem;padding: 0">
                                &triangleright;
                            </div>
                        </div>
                        @endfor
                    </div>
                    <hr>
                    <div class="row flex-row justify-content-between">
                        <div class="col"><a href="#">Enter your E-mail</a></div>
                        <div class="col"><a href="#">Enter your password</a></div>
                        <div class="col"><a href="#" class="btn btn-warning btn-sm">try it free</a></div>
                    </div>
                    <hr>
                </div>
            </section>
            <footer  style="background-color: #f3e2cd;position: absolute;bottom: 0;left: 0;margin:0;padding: 0;width: 100%">
                <div class="container"><div class="row">
                        <div class="col-12 text-center">
                            <p class="small">boring|stuff|in|the|footer</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!--TODO: CDN BOOTSTRAPJS, jQuery...-->
    </body>
</html>
