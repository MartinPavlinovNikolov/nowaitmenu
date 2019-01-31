<form class="form" method="POST" action="{{route('employees.update', $employee->id) }}">
    {{ method_field('PUT') }}
    {{ csrf_field() }}

    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-4 control-label">Name: </label>

        <div class="col-8">
            <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

            @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-4 control-label">Password: </label>

        <div class="col-8">
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="status" class="col-4 control-label">Status: </label>

        <div class="col-8">
            <select class="form-control" name="status">
                <option value="1" {{$employee->status ? 'selected' : ''}}>Active</option>
                <option value="0" {{$employee->status ? '' : 'selected'}}>Disabled</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">
                Update
            </button>
        </div>
    </div>
</form>