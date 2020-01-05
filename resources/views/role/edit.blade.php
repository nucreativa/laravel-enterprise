@extends('layouts.app', ['activePage' => 'roles'])

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Role #{{$role->id}}</div>

                    <div class="card-body">
                        <form action="{{ route('roles.update', ['role' => $role]) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                       id="name" name="name" value="{{ old('name') ?? $role->name }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @enderror
                            </div>

                            <hr>

                            <ul class="list-unstyled">
                                @foreach ($permissionGroups as $group)
                                    <li>
                                        {{ strtoupper($group->name)}}
                                        <ul class="list-inline">
                                            @foreach ($group->childs as $child)
                                                <li class="list-inline-item align-text-top">
                                                    {{$child->name}}
                                                    <ul class="list-unstyled">
                                                        @foreach ($child->permissions as $permission)
                                                            <li class="icheck-primary">
                                                                <input type="checkbox" name="permissions[]"
                                                                       value="{{$permission->id}}"
                                                                       id="{{$permission->id}}"
                                                                    {{ (in_array($permission->id,
                                                                    $rolePermissions) ? "checked":"") }}>
                                                                <label for="{{$permission->id}}">
                                                                    {{$permission->name}}
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="text-right">
                                <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
