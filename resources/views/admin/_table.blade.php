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
                    <a href='{{ route('admin.logout.employer', ['id' => $employer->id]) }}' class="btn btn-sm process {{ $employer->status->active ? 'btn-warning' : 'text-muted disabled'}}">Suspend</a>
                    <a href='{{ route('admin.delete.employer', ['id' => $employer->id]) }}' class="btn btn-sm btn-danger process">Delete</a>
                    <a href='{{ route('admin.login.employer', ['id' => $employer->id]) }}' class="btn btn-sm process {{ $employer->status->active ? 'text-muted disabled' : 'btn-primary'}}">Login</a>
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