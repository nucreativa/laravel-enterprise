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
                                <th data-width="200" data-sortable="true">Group</th>
                                <th data-width="50" data-switchable="false"></th>
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
