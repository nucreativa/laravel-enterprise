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
                    <div class="card-header">{{ __('Change Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            <a href="/">Return to homepage</a>
                        @else
                            <form method="POST" action="{{ route('password.post_change') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Current Password') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="current_password" type="password"
                                               class="form-control @error('current_password')
                                                   is-invalid @enderror" name="current_password"
                                               value="{{ old('current_password') }}"
                                               required autofocus>

                                        @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('current_password') }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{ __('New Password') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password')
                                            is-invalid @enderror" name="password" value="{{ old('password') }}"
                                               required autofocus>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password')}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                        {{ __('Confirm New Password') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation')
                                            is-invalid @enderror" name="password_confirmation" value="{{ old
                                            ('password-confirm') }}"
                                               required autofocus>

                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Change Password') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
@endsection
