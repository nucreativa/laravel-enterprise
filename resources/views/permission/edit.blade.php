@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                @include('layouts.menu-admin')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Permission #{{$permission->id}}</div>

                    <div class="card-body">
                        <form action="{{ route('permissions.update', ['permission' => $permission]) }}" method="post">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $permission->name }}">
                            </div>

                            <hr>

                            <ul class="list-unstyled">
                                @foreach ($roles as $role)
                                    <li>
                                        <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                            {{ (in_array($role->id, $permissionRoles) ? "checked":"") }}>
                                        {{$role->name}}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="text-right">
                                <a href="{{ route('permissions.index') }}" class="btn btn-default">Cancel</a>
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
