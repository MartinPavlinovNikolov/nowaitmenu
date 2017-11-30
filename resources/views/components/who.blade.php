@if(Auth::guard('admin')->check())
    <p class='text-success'>You are log in as ADMIN</p>
@else
    <p class='text-danger'>you are NOT ADMIN</p>
@endif

@if(Auth::guard('employer')->check())
    <p class='text-success'>You are log in as EMPLOYER</p>
@else
    <p class='text-danger'>you are NOT EMPLOYER</p>
@endif