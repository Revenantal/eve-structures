@extends('adminlte::page')
@section('title', 'Calendar')
@section('content_header')
    <h1>Calendar</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Upcoming Fuel Expiries</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @foreach ($upcomingStructures as $structure)
                        <div class="info-box">
                            <span class="info-box-icon bg-{{ $structure->type->group->cssColor() }}"><i class="fa {{ $structure->type->group->faIcon() }}"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong><countdown data-color-date="{{ $structure->fuel_expires }}" date="{{ $structure->fuel_expires }}"></countdown></strong> of Fuel Remaining</span>
                                <span class="info-box-number">
                                    <img style="margin-right:5px;" src="//image.eveonline.com/Corporation/{{ $structure->corporation->corporation_id }}_32.png">
                                    @if ($structure->corporation->alliance)
                                        <img style="margin-right:5px;" src="//image.eveonline.com/Alliance/{{ $structure->corporation->alliance->alliance_id }}_32.png">
                                    @endif
                                    {{ $structure->name }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Legend</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        @foreach ($structureGroups as $group)
                            <div class="col-md-{{ 12 / $structureGroups->count()}}">
                                <span class="btn bg-{{$group->cssColor()}} btn-block btn-lg btn-flat no-hover">
                                    {{$group->name}}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-body no-padding">
                    <div id="calendar"></div>
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
            })
        });
    </script>
@stop
