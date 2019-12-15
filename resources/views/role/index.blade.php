@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                @include('layouts.menu-admin')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Roles
                        <div class="float-sm-right"><a href="{{route('roles.export')}}">Export</a></div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered datatable" width="100%">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>
                                    @if(auth()->user()->can('can_edit_role'))
                                        <td><a href="{{ route('roles.edit',['role'=>$role]) }}">Edit</a></td>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <hr>

                        @can('can_add_role')
                            <div class="card">
                                <div class="card-body">

                                    <form action="<?php echo route('roles.store')?>" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                        <input type="hidden" name="permissions[]">

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
                                                                                   value="{{$permission->id}}">
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
