@extends('layouts.app', ['activePage' => 'users'])

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Users
                        <div class="float-sm-right">
                            <a href="{{route('users.export')}}">Export</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table data-toggle="table"
                               data-search="true"
                               data-show-columns="true"
                               data-page-list="[10, 50]"
                               data-pagination="true"
                               data-page-size="10"
                               class="table table-bordered">
                            <thead>
                            <tr>
                                <th data-sortable="true">Name</th>
                                <th data-width="300" data-sortable="true">Email</th>
                                <th data-width="30" data-switchable="false"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if(auth()->user()->can('can_edit_user'))
                                            <a href="{{ route('users.edit',['user' => $user]) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <hr>

                        @can('can_add_user')
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('users.store') }}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text"
                                                   id="name" name="name" value="{{ old('name') }}"
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text"
                                                   id="email" name="email" value="{{ old('email') }}"
                                                   class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password"
                                                   id="password" name="password"
                                                   class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert" style="display:block!important">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="text-right">
                                            <input type="submit" value="Create" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
