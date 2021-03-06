@extends('layouts.app', ['activePage' => 'roles'])

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                                <th data-width="30" data-switchable="false"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @if(auth()->user()->can('can_edit_role') && $role->id !== 1)
                                            <a href="{{ route('roles.edit',['role'=>$role]) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endif
                                    </td>
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

                                        <ul class="list-unstyled">
                                            @foreach ($permissionGroups as $group)
                                                <li>
                                                    <h5>{{ strtoupper($group->name)}}</h5>
                                                    <ul class="list-inline">
                                                        @foreach ($group->childs as $child)
                                                            <li class="list-inline-item align-text-top">
                                                                <h6>{{$child->name}}</h6>
                                                                <ul class="list-unstyled">
                                                                    @foreach ($child->permissions as $permission)
                                                                        <li class="icheck-primary">
                                                                            <input type="checkbox"
                                                                                   name="permissions[]"
                                                                                   id="{{ $permission->name }}"
                                                                                   value="{{$permission->id}}">
                                                                            <label for="{{ $permission->name}}">
                                                                                {{$permission->name}}
                                                                            </label>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <hr>
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
