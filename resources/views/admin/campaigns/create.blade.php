@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.campaign.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.campaigns.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.campaign.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('start_date', trans('global.campaign.fields.start-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('start_date'))
                        <p class="help-block">
                            {{ $errors->first('start_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('finish_date', trans('global.campaign.fields.finish-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('finish_date', old('finish_date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('finish_date'))
                        <p class="help-block">
                            {{ $errors->first('finish_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('advertiser_id', trans('global.campaign.fields.advertiser').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('ads', trans('global.campaign.fields.ads').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-ads">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-ads">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('ads[]', $ads, old('ads'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-ads' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ads'))
                        <p class="help-block">
                            {{ $errors->first('ads') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
    <script>
        $("#selectbtn-ads").click(function(){
            $("#selectall-ads > option").prop("selected","selected");
            $("#selectall-ads").trigger("change");
        });
        $("#deselectbtn-ads").click(function(){
            $("#selectall-ads > option").prop("selected","");
            $("#selectall-ads").trigger("change");
        });
    </script>
@stop