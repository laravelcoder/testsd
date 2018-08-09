@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.networks.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.networks.fields.network')</th>
                            <td field-key='network'>{{ $network->network }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.networks.fields.created-by')</th>
                            <td field-key='created_by'>{{ $network->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.networks.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $network->created_by_team->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.networks.fields.network-id')</th>
                            <td field-key='network_id'>{{ $network->network_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.networks.fields.affiliates')</th>
                            <td field-key='affiliates'>
                                @foreach ($network->affiliates as $singleAffiliates)
                                    <span class="label label-info label-many">{{ $singleAffiliates->affiliate }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#stations" aria-controls="stations" role="tab" data-toggle="tab">Stations</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="stations">
<table class="table table-bordered table-striped {{ count($stations) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.stations.fields.station-label')</th>
                        <th>@lang('global.stations.fields.channel-number')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($stations) > 0)
            @foreach ($stations as $station)
                <tr data-entry-id="{{ $station->id }}">
                    <td field-key='station_label'>{{ $station->station_label }}</td>
                                <td field-key='channel_number'>{{ $station->channel_number }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.stations.restore', $station->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.stations.perma_del', $station->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('station_view')
                                    <a href="{{ route('admin.stations.show',[$station->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('station_edit')
                                    <a href="{{ route('admin.stations.edit',[$station->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('station_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.stations.destroy', $station->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.networks.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
