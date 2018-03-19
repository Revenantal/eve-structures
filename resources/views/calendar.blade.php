@extends('adminlte::page')
@section('title', 'Calendar')
@section('content_header')
    <h1>Calendar</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
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
                        allDay: false
                    },
                    @endforeach
                ]
            })
        });
    </script>
@stop
