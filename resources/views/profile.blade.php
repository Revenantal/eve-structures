@extends('adminlte::page')
@section('title', 'User Profile')
@section('content_header')
    <h1>User Profile</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
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
            <!-- /.box -->
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">User Settings</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <p>Settings successfully updated!</p>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <p>The following errors have been detected.</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {!! Form::open(['url' => 'profile/update', 'method' => 'put', 'class' => 'form-horizontal']) !!}

                    <div class="panel panel-default">
                        <div class="panel-heading">Alert Settings</div>
                        <div class="panel-body">
                            <div class="form-group {{($errors->has('email')) ? 'has-error' : '' }}">
                                {{Form::label('name', 'Email Address', ['class' => 'col-md-2 control-label'])}}
                                <div class="col-md-9">
                                    {{  Form::text('email', Auth::user()->getSetting('email'), ['class' => 'form-control', 'placeholder' => 'user@domain.com']) }}
                                </div>
                            </div>
                            <div class="form-group ">
                                {{Form::label('name', 'Email Alerts', ['class' => 'col-md-2 control-label'])}}
                                <div class="col-md-9">
                                    {{ Form::select('email-alerts', [
                                             'False' => 'Disabled (Default)',
                                             'True' => 'Enabled',
                                         ], Auth::user()->getSetting('email-alerts'), ['class' => 'form-control'])
                                     }}
                                </div>
                            </div>
                        </div>
                    </div>


                        <div class="panel panel-default">
                            <div class="panel-heading">Time Settings</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    {{Form::label('name', 'Timezone', ['class' => 'col-md-2 control-label'])}}
                                    <div class="col-md-9">
                                        {!! Timezonelist::create('timezone', Auth::user()->getSetting('timezone'), 'class="form-control"') !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{Form::label('name', 'Time Format', ['class' => 'col-md-2 control-label'])}}
                                    <div class="col-md-9">
                                        {{ Form::select('time-format', [
                                                '24' => '24 Hour Clock (Default)',
                                                '12' => '12 Hour Clock',
                                            ], Auth::user()->getSetting('time-format'), ['class' => 'form-control'])
                                        }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{Form::label('name', 'Displayed Time', ['class' => 'col-md-2 control-label'])}}
                                    <div class="col-md-9">
                                        {{ Form::select('time-display', [
                                                'eve' => 'EVE Time (Default)',
                                                'local' => 'Local Time',
                                            ], Auth::user()->getSetting('time-display'), ['class' => 'form-control'])
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    {{Form::submit('Save Settings', ['class'=>'btn btn-primary pull-right'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@push('css')
@push('js')
@section('js')

@stop
