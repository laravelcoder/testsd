@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.phones.title')</h3>
    
    {!! Form::model($phone, ['method' => 'PUT', 'route' => ['admin.phones.update', $phone->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone_number', trans('global.phones.fields.phone-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone_number'))
                        <p class="help-block">
                            {{ $errors->first('phone_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contact_id', trans('global.phones.fields.contact').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_id', $contacts, old('contact_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('contact_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('advertiser_id', trans('global.phones.fields.advertiser').'', ['class' => 'control-label']) !!}
                    {!! Form::select('advertiser_id', $advertisers, old('advertiser_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('advertiser_id'))
                        <p class="help-block">
                            {{ $errors->first('advertiser_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('agent_id', trans('global.phones.fields.agent').'', ['class' => 'control-label']) !!}
                    {!! Form::select('agent_id', $agents, old('agent_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('agent_id'))
                        <p class="help-block">
                            {{ $errors->first('agent_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

