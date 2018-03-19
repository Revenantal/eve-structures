@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Structure List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        @if (Auth::user()->corporation->structures->isNotEmpty())
                            <table id="example" class="table table-striped table-bordered dataTable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>State</th>
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
                                            <td><a href="//evemaps.dotlan.net/map/{{ $structure->system->region->name }}/{{ $structure->system->name }}" target="_blank">{{ $structure->system->name }}</a></td>
                                            <td>{{ $structure->type->name }}</td>
                                            <td>{{ $structure->friendlyState() }}</td>
                                            <td><img src="//image.eveonline.com/Corporation/{{ $structure->corporation->corporation_id }}_32.png"> {{ $structure->corporation->name }}</td>
                                            <td><img src="//image.eveonline.com/Alliance/{{ $structure->corporation->alliance->alliance_id }}_32.png"> {{ $structure->corporation->alliance->name }}</td>
                                            <td>
                                                @if ($structure->fuel_expires)
                                                    {{ $structure->fuel_expires }}
                                                @else
                                                    <span class="text-danger">LOW POWER</span>
                                                @endif
                                            </td>
                                            <td>{{$structure->updated_at}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>State</th>
                                        <th>Corporation</th>
                                        <th>Alliance</th>
                                        <th>Fuel Expiry</th>
                                        <th>Updated At</th>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <h2>No structures to show...</h2>
                            <p>It seems I have no structures to show you. If you are logging in as part of a corp that has not logged in before, this is expected. Please wait an hour till I next ask EVE what your structures are up to!</p>
                            <p>If an hour has already passed with no updates, please start to panic scream and yell because something probably blew up. As well send yipcool a message on discord. Thanks!</p>
                        @endif
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
        $(".dataTable").DataTable();
    </script>
@stop
