@foreach($employees as $employee)
<p>{{ $employee->name }}</p>
<p>{{ $employee->status->active == true ? 'Active' : 'Disabled' }}</p>
@endforeach