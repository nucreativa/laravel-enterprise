@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                @include('layouts.menu-admin')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Permissions
                        <div class="float-sm-right"><a href="{{route('permissions.export')}}">Export</a></div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered datatable" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Group</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td>{{optional($permission->group)->name}}</td>
                                    <td>
                                        @if(auth()->user()->can('can_edit_permission'))
                                            <a href="{{ route('permissions.edit',['permission'=>$permission])
                                            }}">Edit</a>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <hr>

                        @can('can_add_permission')
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?php echo route('permissions.store')?>" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>

                                        <hr>

                                        <ul class="list-unstyled">
                                            @foreach ($roles as $role)
                                                <li>
                                                    <input type="checkbox" name="roles[]" value="{{$role->id}}">
                                                    {{$role->name}}
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Create</button>
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
