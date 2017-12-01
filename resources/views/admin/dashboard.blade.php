@extends('layouts.app')

@section('title')
Admin
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
            <a href="#">Settings</a>
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
<div style="width: 80vw;margin: 0 auto;">
    <h2 style="display: block;width:10%;margin: 0 auto 0 0;border: 1px solid greenyellow;background-color: #666;color: #fff">Users</h2>
    <div style="border: 1px solid #000;background-color: #666;color: #fff">
        <div style="display: flex;flex-wrap: wrap;border: 1px solid greenyellow">
            <div style="width: 5.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">ID</div>
            <div style="width: 15.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">Name</div>
            <div style="width: 16.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">Email</div>
            <div style="width: 8.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">Date created</div>
            <div style="width: 10.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">Employees</div>
            <div style="width: 9.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">Status</div>
            <div style="width: 8.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">Last login</div>
            <div style="width: 25.5%;align-content: center;align-items: center;text-align: center">Actions</div>
        </div>
        <div style="display: flex;flex-wrap: wrap;border: 1px solid greenyellow">
            <div style="width: 5.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">7</div>
            <div style="width: 15.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">Nick Jones</div>
            <div style="width: 16.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">Nick.Jones@gmail.com</div>
            <div style="width: 8.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">2017/10/16</div>
            <div style="width: 10.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">
                <button style="background-color: #bcd42a;border-radius: 5px">View(8)</button>
            </div>
            <div style="width: 9.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">Active</div>
            <div style="width: 8.5%;align-content: center;align-items: center;text-align: center;border-right: 1px solid greenyellow">2017/10/16</div>
            <div style="width: 25.5%;align-content: center;align-items: center;text-align: center">
                <button style="background-color: #bcd42a;border-radius: 5px">Suspend</button>
                <button style="background-color: #bcd42a;border-radius: 5px">Delete</button>
                <button style="background-color: #bcd42a;border-radius: 5px">Login</button>
            </div>
        </div>
    </div>
</div>
@stop