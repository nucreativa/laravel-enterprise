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
                            @method('put')

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                       id="name" name="name" value="{{ old('name') ?? $user->name }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email"
                                       value="{{ $user->email }}" disabled>
                            </div>

                            <div class="form-group">
                                <label>Roles</label>
                                <input type="hidden" name="roles[]">
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
