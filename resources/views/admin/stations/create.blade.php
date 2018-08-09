@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.stations.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.stations.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('station_label', trans('global.stations.fields.station-label').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('station_label', old('station_label'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('station_label'))
                        <p class="help-block">
                            {{ $errors->first('station_label') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('channel_number', trans('global.stations.fields.channel-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('channel_number', old('channel_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('channel_number'))
                        <p class="help-block">
                            {{ $errors->first('channel_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('affiliate_id', trans('global.stations.fields.affiliate').'', ['class' => 'control-label']) !!}
                    {!! Form::select('affiliate_id', $affiliates, old('affiliate_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('affiliate_id'))
                        <p class="help-block">
                            {{ $errors->first('affiliate_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('network_id', trans('global.stations.fields.network').'', ['class' => 'control-label']) !!}
                    {!! Form::select('network_id', $networks, old('network_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('network_id'))
                        <p class="help-block">
                            {{ $errors->first('network_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

