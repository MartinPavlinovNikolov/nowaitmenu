@extends('layouts.app')

@section('title')
Admin
@stop

@section('nav')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu">
        <li>
            <a href="#"
               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                Logout
            </a>

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
@stop