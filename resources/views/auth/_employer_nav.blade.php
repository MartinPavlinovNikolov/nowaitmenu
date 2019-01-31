<div class="col-auto {{ Request::is('register') ? 'active-nav' : '' }}">
    <a class="process" href="{{ route('employer.register.form') }}">Register</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('login') ? 'active-nav' : '' }}">
    <a class="process" href="{{ route('employer.login.form') }}">Login</a>
</div>