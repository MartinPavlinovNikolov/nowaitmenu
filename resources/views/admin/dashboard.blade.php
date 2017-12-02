@extends('layouts.app')

@section('title')
Admin-Dashboard
@stop

@section('nav')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li>
            <a href="#"
               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                Logout
            </a>
            <a href="{{ route('admin.settings') }}">Settings</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
    </ul>
</li>
@stop

@section('content')
<h2>HELLO ADMIN</h2>

<!-- debuging purpose -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        @component('components.who')
        @endcomponent
    </div>
</div>
@if(count($employers) > 0)
<ul style="list-style: none;padding: 0;display:flex;flex-wrap: wrap;justify-content: space-between;background-color: gold">
    @foreach($employers as $employer)
    <li style="width: 5%;border:1px solid black;">ID: {{ ($employer->employer_id) }}</li> 
    <li style="width: 18%;border:1px solid black;">Company name: {{ ($employer->name) }}</li> 
    <li style="width: 20%;border:1px solid black;">E-mail: {{ ($employer->email) }}</li> 
    <li style="width: 20%;border:1px solid black;">Last Login: {{ $employer->last_login }}</li> 
    <li style="width: 10%;border:1px solid black;">
        Status: 
        @if($employer->status == 1)
        active
        @else
        disabled
        @endif
    </li> 
    <li style="width: 25%;border:1px solid black;">Employees:
        <ul style="list-style: none;padding: 0;width: 80%;display:flex;flex-wrap: wrap;justify-content: space-around;align-items: center;background-color: violet">
            @if(count($employees) == 0)
            <li style="background-color: linen;text-align: center">
                Missing employees!
            </li>
            @else
            <?php $i = 0; ?>
            @foreach($employees as $employee)
            @if($employee->employer_id == $employer->employer_id)
            <?php $i++; ?>
            <li style="width: 30%;margin: 1rem;background-color: wheat;text-align: center">
                Name: {{ $employee->name }}
            </li> 
            @if($employee->status == 1)
            <li style="width: 30%;margin: 1rem;background-color: greenyellow;text-align: center">Status:  
                active
            </li>
            @else
            <li style="width: 30%;margin: 1rem;background-color: tomato;text-align: center">Status:  
                disabled
            </li>
            @endif
            @endif
            @endforeach
            <li style="width: 90%;border:1px solid black;margin: 1rem;background-color: skyblue;text-align: center">Employees-Total: {{ $i }}</li>
        </ul>
    </li>
    @endif 
    @endforeach
</ul>
@endif
@stop