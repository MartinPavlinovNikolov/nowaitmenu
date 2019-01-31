@foreach($employees as $employee)
<p>{{ $employee->name }}</p>
<p>{{ $employee->password }}</p>
<p>{{ $employee->status == true ? 'Active' : 'Disabled' }}</p>
@endforeach