@extends('layouts.app', ['activePage' => 'uptime'])

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Uptime
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
                                <th data-sortable="true">URL</th>
                                <th data-width="50" data-sortable="true">Status</th>
                                <th data-width="50" data-sortable="true">SSL</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sites as $key => $site)
                                <tr data-entry-id="{{ $site->id }}">
                                    <td>
                                        <a href="{{ $site->url }}">{{ $site->url }}</a>
                                    </td>
                                    <td class="text-center">
                                        @if($site->uptime_status == 'down')
                                            <span class="badge badge-danger">DOWN</span>
                                        @else
                                            <span class="badge badge-success">Up</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($site->certificate_check_enabled)
                                            @if($site->certificate_status == 'invalid')
                                                <span class="badge badge-danger">Invalid</span>
                                            @else
                                                <span class="badge badge-success">Valid</span>
                                            @endif
                                        @endif
                                    </td>
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

@section('scripts')

@endsection
