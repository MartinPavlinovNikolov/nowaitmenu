<div class="col-auto">
    <span>{{ Auth::guard('employer')->user()->name }}</span>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('dashboard') ? 'active-nav' : ''}}">
    <a class="process" href="{{ route('employer.dashboard') }}">Home</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('menu') ? 'active-nav' : ''}}">
    <a class="process" href="#">Menu</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('printer') ? 'active-nav' : ''}}">
    <a class="process" href="#">Printer</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('tablets') ? 'active-nav' : ''}}">
    <a class="process" href="#">Tablets</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('employees') ? 'active-nav' : ''}}">
    <a class="process" href="#">Employees</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('tables') ? 'active-nav' : ''}}">
    <a class="process" href="#">Tables</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('employer/logout') ? 'active-nav' : ''}}">
    <a class="process" href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        Logout
    </a>
</div>
<form id="logout-form" action="{{ route('employer.logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>