@extends('layouts.app')

@section('title', 'Admin | Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('/css/admin/dashboard.css') }}">
@stop

@section('nav')
<div class="col offset-1">
    <h1 class="lead"><a href='{{ url('/') }}'>NoWaitMenu-Logo</a></h1>
</div>

<div class="col-4 align-content-center">
    <div class="row flex-row justify-content-around">
        <div class="col">
            <div>{{ Auth::guard('admin')->user()->name }}</div>
        </div>
        <div>|</div>
        <div class="col">
            <a href="{{ route('admin.settings') }}">Settings</a>
        </div>
        <div>|</div>
        <div class="col">
            <a href="#"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Logout
            </a>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
    {{ csrf_field() }}
</form>
@endsection

@section('content')
@if(session()->has('success'))
<h2>{{ session('success') }}</h2>
@endif

<form method='GET' action="{{ route('admin.search.employers') }}" role="search">
    <div class="row">
        <input type="text" class=" col-2 offset-2 form-control" name="name" placeholder="Search...">
        <button class="col-1 offset-1 btn btn-primary btn-sm" type="submit">Search</button>
    </div>
</form>

@if(count($employers) > 0)
<table class="table-md table-striped table-bordered table-hover table-employers">
    <thead class="table-info">
        <tr>
            <th>ID</th>
            <th>Company name</th>
            <th>E-mail</th>
            <th>Date created</th>
            <th>Employees</th>
            <th>Status</th>
            <th>Last Login</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employers as $employer)
        <tr>
            <th scope="row">{{ ($employer->id) }}</th>
            <td>{{ ($employer->name) }}</td>
            <td>{{ ($employer->email) }}</td>
            <td>{{ ($employer->created_at->format('d/m/Y')) }}</td>
            <td>
                @if($employer->status == 1)
                active
                @else
                disabled
                @endif
            </td>
            <td>
                <div>
                    <div class="btn btn-danger btn-sm btn-employer">
                        View({{ count($employer->employees) }})
                    </div>
                    <div class='table-modal-employees'>
                        <div>
                            <h5>Employees:</h5>
                        </div>
                        <button class="btn close-table-employees btn-sm">x</button>
                        <div class="overflow-table">
                            <table class="table-md table-striped table-bordered table-hover table-employees">
                                <thead class="table-info">
                                    <tr>
                                        <th class='table-light'>Name</td>
                                        <th class='table-light'>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employer->employees as $employee)
                                    <tr>
                                        <td class='table-light'>{{ $employee->name }}</td>
                                        <td class='table-light'>
                                            <div class="btn btn-danger btn-sm">
                                                Login
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </td>
            <td>{{ $employer->last_login->format('d/m/Y') }}</td>
            <td>actions</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="flex-row justify-content-around">
    {{ $employers->links('vendor.pagination.default') }}
</div>
@endif
@stop

@section('scripts')
<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/js/admin/dashboard.js') }}"></script>
@stop