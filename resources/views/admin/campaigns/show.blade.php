@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.campaign.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.campaign.fields.name')</th>
                            <td field-key='name'>{{ $campaign->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaign.fields.start-date')</th>
                            <td field-key='start_date'>{{ $campaign->start_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaign.fields.finish-date')</th>
                            <td field-key='finish_date'>{{ $campaign->finish_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaign.fields.created-by')</th>
                            <td field-key='created_by'>{{ $campaign->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaign.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $campaign->created_by_team->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.campaign.fields.ads')</th>
                            <td field-key='ads'>
                                @foreach ($campaign->ads as $singleAds)
                                    <span class="label label-info label-many">{{ $singleAds->ad_label }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.campaigns.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
