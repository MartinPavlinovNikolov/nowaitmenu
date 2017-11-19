@if(Auth::guard('admin')->check())
    <p class='text-success'>You are log in as ADMIN</p>
@else
    <p class='text-danger'>you are NOT ADMIN</p>
@endif

@if(Auth::guard('web')->check())
    <p class='text-success'>You are log in as USER</p>
@else
    <p class='text-danger'>you are NOT USER</p>
@endif