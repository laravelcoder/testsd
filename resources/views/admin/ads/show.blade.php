@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.ads.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.ads.fields.ad-label')</th>
                            <td field-key='ad_label'>{{ $ad->ad_label }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.ad-description')</th>
                            <td field-key='ad_description'>{!! $ad->ad_description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.video-upload')</th>
                            <td field-key='video_upload'>@if($ad->video_upload)<a href="{{ asset(env('UPLOAD_PATH').'/' . $ad->video_upload) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.total-impressions')</th>
                            <td field-key='total_impressions'>{{ $ad->total_impressions }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.total-networks')</th>
                            <td field-key='total_networks'>{{ $ad->total_networks }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.total-channels')</th>
                            <td field-key='total_channels'>{{ $ad->total_channels }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.created-by')</th>
                            <td field-key='created_by'>{{ $ad->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $ad->created_by_team->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.category-id')</th>
                            <td field-key='category_id'>
                                @foreach ($ad->category_id as $singleCategoryId)
                                    <span class="label label-info label-many">{{ $singleCategoryId->category }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.ads.fields.video-screenshot')</th>
                            <td field-key='video_screenshot'>@if($ad->video_screenshot)<a href="{{ asset(env('UPLOAD_PATH').'/' . $ad->video_screenshot) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $ad->video_screenshot) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#categories" aria-controls="categories" role="tab" data-toggle="tab">Categories</a></li>
<li role="presentation" class=""><a href="#campaign" aria-controls="campaign" role="tab" data-toggle="tab">Campaign</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="categories">
<table class="table table-bordered table-striped {{ count($categories) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.categories.fields.category')</th>
                        <th>@lang('global.categories.fields.slug')</th>
                        <th>@lang('global.categories.fields.advertiser-id')</th>
                        <th>@lang('global.categories.fields.ad-id')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($categories) > 0)
            @foreach ($categories as $category)
                <tr data-entry-id="{{ $category->id }}">
                    <td field-key='category'>{{ $category->category }}</td>
                                <td field-key='slug'>{{ $category->slug }}</td>
                                <td field-key='advertiser_id'>
                                    @foreach ($category->advertiser_id as $singleAdvertiserId)
                                        <span class="label label-info label-many">{{ $singleAdvertiserId->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='ad_id'>
                                    @foreach ($category->ad_id as $singleAdId)
                                        <span class="label label-info label-many">{{ $singleAdId->ad_label }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.categories.restore', $category->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.categories.perma_del', $category->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('category_view')
                                    <a href="{{ route('admin.categories.show',[$category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('category_edit')
                                    <a href="{{ route('admin.categories.edit',[$category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('category_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.categories.destroy', $category->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="campaign">
<table class="table table-bordered table-striped {{ count($campaigns) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.campaign.fields.name')</th>
                        <th>@lang('global.campaign.fields.start-date')</th>
                        <th>@lang('global.campaign.fields.finish-date')</th>
                        <th>@lang('global.campaign.fields.created-by')</th>
                        <th>@lang('global.campaign.fields.created-by-team')</th>
                        <th>@lang('global.campaign.fields.ads')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($campaigns) > 0)
            @foreach ($campaigns as $campaign)
                <tr data-entry-id="{{ $campaign->id }}">
                    <td field-key='name'>{{ $campaign->name }}</td>
                                <td field-key='start_date'>{{ $campaign->start_date }}</td>
                                <td field-key='finish_date'>{{ $campaign->finish_date }}</td>
                                <td field-key='created_by'>{{ $campaign->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $campaign->created_by_team->name or '' }}</td>
                                <td field-key='ads'>
                                    @foreach ($campaign->ads as $singleAds)
                                        <span class="label label-info label-many">{{ $singleAds->ad_label }}</span>
                                    @endforeach
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.campaigns.restore', $campaign->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.campaigns.perma_del', $campaign->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('campaign_view')
                                    <a href="{{ route('admin.campaigns.show',[$campaign->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('campaign_edit')
                                    <a href="{{ route('admin.campaigns.edit',[$campaign->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('campaign_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.campaigns.destroy', $campaign->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.ads.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
