<div class="col-auto">
    <span>Admin: {{ Auth::guard('admin')->user()->name }}</span>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is(route('admin.employers.index')) ? 'active-nav' : ''}}">
    <a class="process" href="{{ route('admin.employers.index') }}">Home</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is(route('admin.settings.edit', Auth::guard('admin')->user()->id)) ? 'active-nav' : ''}}">
    <a class="process" href="{{ route("admin.settings.edit", Auth::guard('admin')->user()->id) }}">Settings</a>
</div>
<div class="col-auto">|</div>
<div class="col-auto {{ Request::is(route('admin.logout')) ? 'active-nav' : ''}}">
    <a class="process" href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        Logout
    </a>
</div>
<form id="logout-form" action="{{ route('admin.logout') }}" method="PUT">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
</form>