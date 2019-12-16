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
                                <th data-width="50" data-switchable="false"></th>
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
                                            <input type="text"
                                                   id="name" name="name" value="{{ old('name') }}"
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @enderror
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
