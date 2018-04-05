@extends('adminlte::page')
@section('title', 'Structure Details')
@section('content_header')
    <h1>Structures Details</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-widget widget-user-2 structure">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-{{ $structure->type->group->cssColor() }}">
                    <div class="widget-user-image">
                        <img class="img-rounded" src="//image.eveonline.com/Render/{{ $structure->type_id }}_128.png" alt="Structure Icon">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{ $structure->name }}</h3>
                    <h5 class="widget-user-desc">
                        <img class="bg-gray-light img-rounded" src="//image.eveonline.com/Corporation/{{ $structure->corporation->corporation_id }}_32.png" alt="Corporation Icon" data-placement="bottom" data-toggle="tooltip" data-original-title="{{ $structure->corporation->name }}">
                        @if ($structure->corporation->alliance)
                            <img class="bg-gray-light img-rounded" src="//image.eveonline.com/Alliance/{{ $structure->corporation->alliance->alliance_id }}_32.png" alt="Alliance Icon" data-placement="bottom" data-toggle="tooltip" data-original-title="{{ $structure->corporation->alliance->name }}">
                        @endif
                    </h5>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <tbody>
                            <tr>
                                <td>Structure Type</td>
                                <td class="text-right">{{ $structure->type->name }}</td>
                            </tr>
                            <tr>
                                <td>Structure Group</td>
                                <td class="text-right">{{ $structure->type->group->name }}</td>
                            </tr>
                            <tr>
                                <td>System</td>
                                <td class="text-right">{{ $structure->system->name }}</td>
                            </tr>
                            <tr>
                                <td>Region</td>
                                <td class="text-right">{{ $structure->system->region->name }}</td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td class="text-right">{{ $structure->friendlyState() }}</td>
                            </tr>
                            <tr>
                                <td>Reinforce Weekday</td>
                                <td class="text-right">{{ $structure->reinforce_weekday }}</td>
                            </tr>
                            <tr>
                                <td>Reinforce Hour</td>
                                <td class="text-right">{{ $structure->reinforce_hour }}</td>
                            </tr>
                            <tr>
                                <td>Fuel Status</td>
                                <td class="text-right">
                                    @if ($structure->fuel_expires)
                                        <countdown class="status" date="{{ $structure->fuel_expires }}"></countdown>
                                    @else
                                        <span class="status" class="text-danger">Low Power</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Last Update</td>
                                <td class="text-right">{{ $structure->updated_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget">
                <div class="box-header">
                    <h2 class="box-title">Services</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @if ($services)
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <tbody>
                                    @foreach($services as $service)
                                        <tr>
                                            <td>{{$service->name}}</td>
                                            <td class="text-right">{{$service->state}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center no-margin">No Services Equipped</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@push('css')
    @push('js')
@section('js')
@stop
