@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.stations.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.stations.fields.station-label')</th>
                            <td field-key='station_label'>{{ $station->station_label }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.stations.fields.channel-number')</th>
                            <td field-key='channel_number'>{{ $station->channel_number }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.stations.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
