@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                @include('layouts.menu-admin')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Users
                        <div class="float-sm-right"><a href="{{route('users.export')}}">Export</a></div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered datatable" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if(auth()->user()->can('can_edit_user'))
                                        <td><a href="{{ route('users.edit',['user' => $user]) }}">Edit</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
