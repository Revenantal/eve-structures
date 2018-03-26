@extends('adminlte::page')
@section('title', 'Structure Table')
@section('content_header')
    <h1>Table</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Structure Table</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example" class="table table-striped table-bordered dataTable" style="width:100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>System</th>
                                <th>Region</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Corporation</th>
                                <th>Alliance</th>
                                <th>Fuel Expiry</th>
                                <th>Updated At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (Auth::user()->corporation->structures as $structure)
                                <tr>
                                    <td>{{ $structure->name }}</td>
                                    <td>
                                        <a href="//evemaps.dotlan.net/map/{{ $structure->system->region->name }}/{{ $structure->system->name }}" data-toggle="tooltip" data-placement="top" title="View on Dotlan" target="_blank">{{ $structure->system->name }}</a>
                                        [{{$structure->system->secStatus()}}]
                                    </td>
                                    <td>{{ $structure->system->region->name }}</td>
                                    <td>{{ $structure->type->name }}</td>
                                    <td>{{ $structure->friendlyState() }}</td>
                                    <td><img src="//image.eveonline.com/Corporation/{{ $structure->corporation->corporation_id }}_32.png"> {{ $structure->corporation->name }}</td>
                                    <td><img src="//image.eveonline.com/Alliance/{{ $structure->corporation->alliance->alliance_id }}_32.png"> {{ $structure->corporation->alliance->name }}</td>
                                    <td data-color-date="{{ $structure->fuel_expires }}" data-color-date-element="bg">
                                        <strong>
                                            @if ($structure->fuel_expires)
                                                <countdown date="{{ $structure->fuel_expires }}"></countdown>
                                            @else
                                                <span class="text-danger">LOW POWER</span>
                                            @endif
                                        </strong>
                                    </td>
                                    <td>{{$structure->updated_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>System</th>
                                <th>Region</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Corporation</th>
                                <th>Alliance</th>
                                <th>Fuel Expiry</th>
                                <th>Updated At</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@stop

@push('css')
    @push('js')
@section('js')
    <script>
        $(".dataTable").DataTable( {
            "order": [[ 7, "asc" ]],
            responsive: {
                details: true
            },
            "columns": [
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" },
            ]
        });
    </script>
@stop
