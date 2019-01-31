<form method='GET' action="#" role="search">
    <div class="row flex-row align-items-center">
        <input id='search' type="text" class=" col-2 offset-2 form-control" name="value" placeholder="Search..." value='@if(session()->has('value') && !empty('value')){{ session('value') }}@endif'>
               <button class="col-1 btn btn-primary btn-sm if-process" type="submit">Search</button>
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
                <a href="{{ route('admin.employers.index') }}" class="col btn btn-warning btn-sm btn-all-of-some-employers process"><span class="text-primary">View All</span> employers</a>
                <a href="{{ route('admin.employers.active') }}" class="col btn btn-warning btn-sm btn-all-of-some-employers process"><span class="text-success">Active</span> employers</a>
                <a href="{{ route('admin.employers.disabled') }}" class="col btn btn-warning btn-sm btn-all-of-some-employers process"><span class="text-danger">Disabled</span> employers</a>
            </div>
        </div>
    </div>
</form>