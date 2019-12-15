@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                @include('layouts.menu-admin')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">User #{{$user->id}}</div>

                    <div class="card-body">
                        <form action="{{ route('users.update', ['user' => $user]) }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email"
                                       value="{{ $user->email }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Roles</label>

                                <ul class="list-inline">
                                    @foreach ($roles as $role)
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                                {{ (in_array($role->id, $userRoles) ? "checked":"") }}>
                                            {{ ucwords($role->name)}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="text-right">
                                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
