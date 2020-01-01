@extends('layouts.app', ['activePage' => 'permissions'])

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Permission #{{$permission->id}}</div>

                    <div class="card-body">
                        <form action="{{ route('permissions.update', ['permission' => $permission]) }}" method="post">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                       id="name" name="name" value="{{ old('name') ?? $permission->name }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @enderror
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
