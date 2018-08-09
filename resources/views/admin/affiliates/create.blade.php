@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.affiliates.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.affiliates.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('affiliate', trans('global.affiliates.fields.affiliate').'', ['class' => 'control-label']) !!}
                    {!! Form::text('affiliate', old('affiliate'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('affiliate'))
                        <p class="help-block">
                            {{ $errors->first('affiliate') }}
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
                        @include('admin.affiliates.stations_row', [
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
        @include('admin.affiliates.stations_row',
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
@stop