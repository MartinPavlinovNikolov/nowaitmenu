<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{env('APP_NAME')}}</title>

        <!--TODO: CDN BOOTSTRAP STYLES -->
        

    </head>
    <body>
        <div class="container-fluid">
            <nav class="row">
                <div class="col-md-2">
                    <h1><a href='{{ url('/') }}'>NoWaitMenu-Logo</a></h1>
                </div>
                <div class="col-md-4">
                    <p class="text-right"><small>"this is the best thing for restaurants since refrigeration was invented"</small></p>
                    <p class="text-right"><small>Sir Gordon Ramsay</small></p>
                    <p  class="text-right"<><a href="#"<small>more testimonials</a></small></p>
                </div>
                <div class="col-md-1 col-md-offset-1">
                    <a href="#" class="btn btn-warning btn-lg">try it free</a>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Features</a>
                        </li>
                        <li>
                            |
                        </li>
                        <li>
                            <a href="#">Pricing</a>
                        </li>
                        <li>
                            |
                        </li>
                        <li>
                            <a href="#">Support</a>
                        </li>
                        <li>
                            |
                        </li>
                        <li>
                            <a href="{{ route('employer.register') }}">Register</a>
                        </li>
                        <li>
                            |
                        </li>
                        <li>
                            <a href="{{ route('employer.login') }}">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
            
            <!-- debuging purpose -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @component('components.who')
                    @endcomponent
                </div>
            </div>
            
            <section class="row">
                <hr>
                <div class="col-md-10 col-md-offset-1">
                    <h1 class="text-center">Get your restaurant runing in minutes</h2>
                        <div class="row">
                            <div class="col-md-4 text-center">Video tutorial-1</div>
                            <div class="col-md-4 text-center">Video tutorial-2</div>
                            <div class="col-md-4 text-center">Video tutorial-3</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 text-center"><a href="#">Enter your E-mail</a></div>
                            <div class="col-md-4 text-center"><a href="#">Enter your password</a></div>
                            <div class="col-md-4 text-center"><a href="#" class="btn btn-warning btn-lg">try it free</a></div>
                        </div>
                </div>
            </section>
            <footer class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p class="text-center">boring|stuff|in|the|footer</p>
                </div>
            </footer>
        </div>
        <!--TODO: CDN BOOTSTRAPJS, jQuery...-->
    </body>
</html>
