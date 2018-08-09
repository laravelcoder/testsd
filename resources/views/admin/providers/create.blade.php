@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.providers.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.providers.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('provider', trans('global.providers.fields.provider').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('provider', old('provider'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('provider'))
                        <p class="help-block">
                            {{ $errors->first('provider') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

