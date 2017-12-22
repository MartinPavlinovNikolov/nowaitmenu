<div class="col-auto">
    <span>Admin: {{ Auth::guard('admin')->user()->name }}</span>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('admin') ? 'active-nav' : ''}}">
    <a class="process" href="{{ route('admin.dashboard') }}">Dashboard</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('admin/settings') ? 'active-nav' : ''}}">
    <a class="process" href="{{ route('admin.settings') }}">Settings</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is('admin/logout') ? 'active-nav' : ''}}">
    <a class="process" href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        Logout
    </a>
</div>
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
    {{ csrf_field() }}
</form>