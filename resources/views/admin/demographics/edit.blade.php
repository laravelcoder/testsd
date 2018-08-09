@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.demographics.title')</h3>
    
    {!! Form::model($demographic, ['method' => 'PUT', 'route' => ['admin.demographics.update', $demographic->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('demographic', trans('global.demographics.fields.demographic').'', ['class' => 'control-label']) !!}
                    {!! Form::text('demographic', old('demographic'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('demographic'))
                        <p class="help-block">
                            {{ $errors->first('demographic') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('value', trans('global.demographics.fields.value').'', ['class' => 'control-label']) !!}
                    {!! Form::text('value', old('value'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('value'))
                        <p class="help-block">
                            {{ $errors->first('value') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('advertiser_id', trans('global.demographics.fields.advertiser').'', ['class' => 'control-label']) !!}
                    {!! Form::select('advertiser_id', $advertisers, old('advertiser_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('advertiser_id'))
                        <p class="help-block">
                            {{ $errors->first('advertiser_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

