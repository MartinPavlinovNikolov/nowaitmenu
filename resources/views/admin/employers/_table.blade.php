<table class="table-md table-striped table-bordered table-hover table-employers table-condensed">
    <thead class="table-info">
        <tr>
            <th class="text-sm">ID</th>
            <th class="text-sm">Company name</th>
            <th class="text-sm">Email</th>
            <th class="text-sm">Date Created</th>
            <th class="text-sm">Employees</th>
            <th class="text-sm">Status</th>
            <th class="text-sm">Last Login</th>
            <th class="text-sm">Actions</th>
        </tr>
    </thead>
    <tbody>
        @if(count($employers) > 0)
        @foreach($employers as $employer)
        <tr>
            <th class="text-sm" scope="row">{{ ($employer->id) }}</th>
            <td class="text-sm">{{ ($employer->name) }}</td>
            <td class="text-sm">{{ ($employer->email) }}</td>
            <td class="text-sm">{{ ($employer->formated_created_at) }}</td>
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
                                            @if($employee->status == true)
                                            <a href='#' class="badge badge-sm badge-warning">
                                                Logout
                                            </a>
                                            @else
                                            <a href='#' class="badge badge-sm badge-primary">
                                                Login
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </td>
            @if($employer->status == true)
            <td class="text-sm text-success">
                active
            </td>
            @else
            <td class="text-sm text-danger">
                disabled
            </td>
            @endif
            <td>{{ $employer->formated_last_login }}</td>
            <td class="status-buttons-wrapper">
                <div class="flex-row justify-content-center">
                    <a href='#' class="badge badge-sm process {{ $employer->status ? 'badge-warning' : 'text-muted disabled'}}">Suspend</a>
                    <a href='#' class="badge badge-sm badge-danger process">Delete</a>
                    <a href='#' class="badge badge-sm process {{ $employer->status ? 'text-muted disabled' : 'badge-primary'}}">Login</a>
                </div>
            </td>
        </tr>
        @endforeach
        @else
    <div class="text-center">
        <h2 class="text-danger">Nothing found!</h2>
    </div>
    @endif
</tbody>
</table>
<div class="flex-row justify-content-around">
    {{ $employers->links('vendor.pagination.default') }}
</div>