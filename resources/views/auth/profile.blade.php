@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="card">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{route('home')}}" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('profile.update')}}">Update Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('password.change')}}">Change Password</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Profile') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('profile.post_update') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Name') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="current_password" type="text"
                                           class="form-control @error('name')
                                               is-invalid @enderror" name="name"
                                           value="{{ $user->name }}"
                                           required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
@endsection
