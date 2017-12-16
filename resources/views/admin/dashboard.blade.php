@extends('layouts.app')

@section('title', 'Admin | Dashboard')

@section('styles')
<link rel="stylesheet" href="{{ asset('/css/admin/dashboard.css') }}">
@stop

@section('nav')
<div class="col offset-1">
    <h1 class="lead"><a href='{{ url('/') }}'>NoWaitMenu-Logo</a></h1>
</div>

<div class="col-5 align-content-center">
    <div class="row flex-row justify-content-around">
        <div class="col">
            <div>Admin: {{ Auth::guard('admin')->user()->name }}</div>
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
@if(session()->has('message'))
<div class="text-center">
    <h2>{{ session('message') }}</h2>
</div>
@endif

<form method='GET' action="{{ route('admin.search.employers') }}" role="search">
    <div class="row flex-row align-items-center">
        <input type="text" class=" col-2 offset-2 form-control" name="value" placeholder="Search..." value='@if(session()->has('value')){{ session('value') }}@endif'>
        <button class="col-1 btn btn-primary btn-sm" type="submit">Search</button>
        <div class="col-3">
            <div class="flex-wrap">
                <div class="row flex-row align-items-center radio-wrapper">
                    <input class="col text-sm" id="name" type="radio" name="sort" value="name" @if((session()->has('sort') && session('sort')=='name') || (!session()->has('sort')))
                           checked="checked"
                           @endif>
                    <label class="col text-sm" for="name">find by name</label>
                </div>
                <div class="row flex-row align-items-center radio-wrapper">
                    <input class="col text-sm" id="email" type="radio" name="sort" value="email" @if(session()->has('sort') && session('sort')=='email')
                           checked="checked"
                           @endif>
                    <label class="col text-sm" for="email">find by email</label>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="flex-row align-items-center">
                <a href="{{ route('admin.dashboard') }}" class="col btn btn-warning btn-sm btn-all-of-some-employers"><span class="text-primary">All</span> employers</a>
                <a href="{{ route('admin.active.employers') }}" class="col btn btn-warning btn-sm btn-all-of-some-employers"><span class="text-success">Active</span> employers</a>
                <a href="{{ route('admin.disabled.employers') }}" class="col btn btn-warning btn-sm btn-all-of-some-employers"><span class="text-danger">Disabled</span> employers</a>
            </div>
        </div>
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
            <th class="text-sm" scope="row">{{ ($employer->id) }}</th>
            <td class="text-sm">{{ ($employer->name) }}</td>
            <td class="text-sm">{{ ($employer->email) }}</td>
            <td class="text-sm">{{ ($employer->created_at->format('d/m/Y')) }}</td>
            <td>
                <div>
                    <div class="btn btn-danger btn-sm btn-employer text-center">
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
            @if($employer->status->active == 1)
            <td class="text-sm text-success">
                active
            </td>
            @else
            <td class="text-sm text-danger">
                disabled
            </td>
            @endif
            <td>{{ $employer->last_login->format('d/m/Y') }}</td>
            <td class="status-buttons-wrapper">
                <div class="flex-row justify-content-center">
                    <a href='{{ route('admin.employer.logout', ['id' => $employer->id]) }}' class="btn btn-sm btn-warning">Suspend</a>
                    <a href='{{ route('admin.employer.delete', ['id' => $employer->id]) }}' class="btn btn-sm btn-danger">Delete</a>
                    <a href='{{ route('admin.employer.login', ['id' => $employer->id]) }}' class="btn btn-sm btn-primary">Login</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="flex-row justify-content-around">
    {{ $employers->links('vendor.pagination.default') }}
</div>
@else
<div class="text-center">
    <h2 class="text-danger">Nothing found!</h2>
</div>
@endif
@stop

@section('scripts')
<script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('/js/admin/dashboard.js') }}"></script>
@stop