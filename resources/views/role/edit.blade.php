@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                @include('layouts.menu-admin')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Role #{{$role->id}}</div>

                    <div class="card-body">
                        <form action="{{ route('roles.update', ['role' => $role]) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $role->name }}">
                            </div>

                            <hr>

                            <ul class="list-unstyled">
                                @foreach ($permissionGroups as $group)
                                    <li>
                                        {{ strtoupper($group->name)}}
                                        <ul class="list-inline">
                                            @foreach ($group->childs as $child)
                                                <li class="list-inline-item">
                                                    {{$child->name}}
                                                    <ul class="list-unstyled">
                                                        @foreach ($child->permissions as $permission)
                                                            <li>
                                                                <input type="checkbox" name="permissions[]"
                                                                       value="{{$permission->id}}"
                                                                    {{ (in_array($permission->id,
                                                                    $rolePermissions) ? "checked":"") }}>
                                                                {{$permission->name}}
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
