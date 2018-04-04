@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">

            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Server Status</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item"  data-toggle="tooltip" data-placement="top" title="HH:MM - DD/MM/YYYY">
                            <b>EVE Time</b> <span class="pull-right evedatetime"></span>
                        </li>
                        <li class="list-group-item" data-toggle="tooltip" data-placement="top" title="HH:MM - DD/MM/YYYY (GMT OFFSET)">
                            <b>Local Time</b> <span class="pull-right localdatetime"></span>
                        </li>
                        <li class="list-group-item">
                            <b>Player Count</b> <span class="pull-right playercount"></span>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">User Profile</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="//image.eveonline.com/Character/{{Auth::user()->character_id}}_128.jpg" alt="User profile picture">
                    <h3 class="profile-username text-center">{{Auth::user()->character_name}}</h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Corporation</b> <span class="pull-right">{{Auth::user()->corporation->name}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Alliance</b> <span class="pull-right">{{Auth::user()->alliance->name}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Signed Up</b> <span class="pull-right">{{Auth::user()->created_at}}</span>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Corporation Profile</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="//image.eveonline.com/Corporation/{{Auth::user()->corporation->corporation_id}}_128.png" alt="Corporation Logo">
                    <h3 class="profile-username text-center">{{Auth::user()->corporation->name}}</h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Alliance</b> <span class="pull-right">{{Auth::user()->alliance->name}}</span>
                        </li>
                        <li class="list-group-item">
                            <b>Total Structures</b> <span class="pull-right">{{count(Auth::user()->corporation->structures)}}</span>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title">Structure Types</h2>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="structureTypeChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title">Structure Groups</h2>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="structureGroupChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title">Structure Fuel Status</h2>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <canvas id="structureFuelStatusChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title">Structure Calendar</h2>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="box">
                        <div class="box-header">
                            <h2 class="box-title">Upcoming Fuel Expiries</h2>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            @foreach ($upcomingStructures as $structure)
                                <div class="info-box structure">
                                    <span class="info-box-icon bg-{{ $structure->type->group->cssColor() }}"><i class="fa {{ $structure->type->group->faIcon() }}"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><strong><countdown data-color-date="{{ $structure->fuel_expires }}" date="{{ $structure->fuel_expires }}"></countdown></strong> of Fuel Remaining</span>
                                        <span class="info-box-number">
                                            <img style="margin-right:5px;" src="//image.eveonline.com/Corporation/{{ $structure->corporation->corporation_id }}_32.png">
                                            @if ($structure->corporation->alliance)
                                                <img style="margin-right:5px;" src="//image.eveonline.com/Alliance/{{ $structure->corporation->alliance->alliance_id }}_32.png">
                                            @endif
                                            <a href="/structures/{{ $structure->structure_id }}">{{ $structure->name }}</a>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('css')
@push('js')
@section('js')
    <script>
    $(function() {
        var structureTypes = {!! json_encode($structureTypes) !!};
        var structureGroups = {!! json_encode($structureGroups) !!};
        var structureFuelStatus = {!! json_encode($structureFuelStatus) !!};

        // Generating structureTypes Chart
        var structureTypeCanvas = document.getElementById("structureTypeChart");
        var labels = [], data=[];
        $.each(structureTypes, function(index, value) {
            labels.push(index);
            data.push(value);
        });
        new Chart(structureTypeCanvas, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ]
                }]
            },
            options: {
                legend: {
                    position: 'right'
                }
            }
        });

        // Generating structureGroups Chart
        var structureGroupCanvas = document.getElementById("structureGroupChart");
        var labels = [], data=[];
        $.each(structureGroups, function(index, value) {
            labels.push(index);
            data.push(value);
        });
        new Chart(structureGroupCanvas, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#dd4b39',
                        '#f39c12',
                        '#00a65a'
                    ]
                }]
            },
            options: {
                legend: {
                    position: 'right'
                }
            }
        });

        // Generating StructureFuelStatus Chart
        var structureFuelStatusCanvas = document.getElementById("structureFuelStatusChart");
        var labels = [], data=[];
        $.each(structureFuelStatus, function(index, value) {
            labels.push(index);
            data.push(value);
        });
        new Chart(structureFuelStatusCanvas, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#00a65a',
                        '#dd4b39',
                    ]
                }]
            },
            options: {
                legend: {
                    position: 'right'
                }
            }
        });

        // Calender render
        $('#calendar').fullCalendar({
            timeFormat: 'HH:mm',
            events: [
                    @foreach (Auth::user()->corporation->structures as $structure)
                {
                    title : '{{ $structure->name }}',
                    start : '{{ $structure->fuel_expires }}',
                    className : 'bg-{{ $structure->type->group->cssColor() }}',
                    allDay: false,
                    url: '/structures/{{ $structure->structure_id }}'
                },
                @endforeach
            ]
        });
    });
    </script>
@stop
