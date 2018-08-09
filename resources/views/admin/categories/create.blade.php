@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.categories.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.categories.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('category', trans('global.categories.fields.category').'', ['class' => 'control-label']) !!}
                    {!! Form::text('category', old('category'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category'))
                        <p class="help-block">
                            {{ $errors->first('category') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('slug', trans('global.categories.fields.slug').'', ['class' => 'control-label']) !!}
                    {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('slug'))
                        <p class="help-block">
                            {{ $errors->first('slug') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('advertiser_id', trans('global.categories.fields.advertiser-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-advertiser_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-advertiser_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('advertiser_id[]', $advertiser_ids, old('advertiser_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-advertiser_id' ]) !!}
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
                    {!! Form::label('ad_id', trans('global.categories.fields.ad-id').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-ad_id">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-ad_id">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('ad_id[]', $ad_ids, old('ad_id'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-ad_id' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ad_id'))
                        <p class="help-block">
                            {{ $errors->first('ad_id') }}
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

    <script>
        $("#selectbtn-advertiser_id").click(function(){
            $("#selectall-advertiser_id > option").prop("selected","selected");
            $("#selectall-advertiser_id").trigger("change");
        });
        $("#deselectbtn-advertiser_id").click(function(){
            $("#selectall-advertiser_id > option").prop("selected","");
            $("#selectall-advertiser_id").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-ad_id").click(function(){
            $("#selectall-ad_id > option").prop("selected","selected");
            $("#selectall-ad_id").trigger("change");
        });
        $("#deselectbtn-ad_id").click(function(){
            $("#selectall-ad_id > option").prop("selected","");
            $("#selectall-ad_id").trigger("change");
        });
    </script>
@stop