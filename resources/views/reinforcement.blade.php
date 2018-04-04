@extends('adminlte::page')
@section('title', 'Reinforcement Schedule')
@section('content_header')
    <h1>Reinforcement Schedule</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">What is this?</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>This page indicates the opening window of a structure reinforcement. Keeping in mind that the structure reinforcement mechanics now act as such. A structure may be attacked at any time. If the aggressor successfully reinforces the structure, then the structure will enter go into reinforcement. This reinforcement time is determine by you, by select a week day and a time. To make things a bit more confusing, CCP then added a +/- 2 hour time frame to that time. This page displays that +/- 2 hour window your structure can enter reinforcement.</p>
                    <p>In a quick example, let's say you pick "Monday" at "10:00 EVE time" as your reinforcement time. This means your reinforcement window would be Monday 10:00 EVE - 2 hours, and Monday 10:00 EVE + 2 hours. This results in a window of Monday 08:00 EVE to Monday 12:00 EVE. Clear as fog? </p>
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
            defaultView: 'agendaWeek',
            header: {
                left: '',
                center: '',
                right: ''
            },
            columnHeaderFormat: 'dddd',
            height:'auto',
            now:moment().utc(),
            nowIndicator: true,
            slotLabelFormat: 'HH:mm [EVE]',
            allDaySlot: false,
            events: [
                @foreach ($structures as $structure)
                    {
                        title : '{{ $structure->name }}',
                        start : '{{ $structure->reinforcementWindow()['start'] }}',
                        end : '{{ $structure->reinforcementWindow()['end'] }}',
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
