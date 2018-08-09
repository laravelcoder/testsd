@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.networks.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.networks.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('network', trans('global.networks.fields.network').'', ['class' => 'control-label']) !!}
                    {!! Form::text('network', old('network'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('network'))
                        <p class="help-block">
                            {{ $errors->first('network') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('network_id', trans('global.networks.fields.network-id').'', ['class' => 'control-label']) !!}
                    {!! Form::text('network_id', old('network_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('network_id'))
                        <p class="help-block">
                            {{ $errors->first('network_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('affiliates', trans('global.networks.fields.affiliates').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-affiliates">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-affiliates">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('affiliates[]', $affiliates, old('affiliates'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-affiliates' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('affiliates'))
                        <p class="help-block">
                            {{ $errors->first('affiliates') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Stations
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.stations.fields.station-label')</th>
                        <th>@lang('global.stations.fields.channel-number')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="stations">
                    @foreach(old('stations', []) as $index => $data)
                        @include('admin.networks.stations_row', [
                            'index' => $index
                        ])
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="stations-template">
        @include('admin.networks.stations_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
    <script>
        $("#selectbtn-affiliates").click(function(){
            $("#selectall-affiliates > option").prop("selected","selected");
            $("#selectall-affiliates").trigger("change");
        });
        $("#deselectbtn-affiliates").click(function(){
            $("#selectall-affiliates > option").prop("selected","");
            $("#selectall-affiliates").trigger("change");
        });
    </script>
@stop