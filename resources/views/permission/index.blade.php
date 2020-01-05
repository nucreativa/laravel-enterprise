@extends('layouts.app', ['activePage' => 'permissions'])

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                                <th data-width="30" data-switchable="false"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td>{{optional($permission->group)->name}}</td>
                                    <td>
                                        @if(auth()->user()->can('can_edit_permission'))
                                            <a href="{{ route('permissions.edit',['permission'=>$permission]) }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
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
                                            <input type="text"
                                                   id="name" name="name" value="{{ old('name') }}"
                                                   class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <hr>

                                        <ul class="list-unstyled">
                                            @foreach ($roles as $role)
                                                <li class="icheck-primary">
                                                    <input type="checkbox" name="roles[]"
                                                           id="{{$role->id}}" value="{{$role->id}}">
                                                    <label for="{{$role->name}}">{{$role->name}}</label>
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
