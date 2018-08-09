@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.categories.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.categories.fields.category')</th>
                            <td field-key='category'>{{ $category->category }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.categories.fields.slug')</th>
                            <td field-key='slug'>{{ $category->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.categories.fields.advertiser-id')</th>
                            <td field-key='advertiser_id'>
                                @foreach ($category->advertiser_id as $singleAdvertiserId)
                                    <span class="label label-info label-many">{{ $singleAdvertiserId->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.categories.fields.ad-id')</th>
                            <td field-key='ad_id'>
                                @foreach ($category->ad_id as $singleAdId)
                                    <span class="label label-info label-many">{{ $singleAdId->ad_label }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#ads" aria-controls="ads" role="tab" data-toggle="tab">Ads</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="ads">
<table class="table table-bordered table-striped {{ count($ads) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.ads.fields.ad-label')</th>
                        <th>@lang('global.ads.fields.total-impressions')</th>
                        <th>@lang('global.ads.fields.total-networks')</th>
                        <th>@lang('global.ads.fields.total-channels')</th>
                        <th>@lang('global.ads.fields.created-by')</th>
                        <th>@lang('global.ads.fields.created-by-team')</th>
                        <th>@lang('global.ads.fields.category-id')</th>
                        <th>@lang('global.ads.fields.video-screenshot')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($ads) > 0)
            @foreach ($ads as $ad)
                <tr data-entry-id="{{ $ad->id }}">
                    <td field-key='ad_label'>{{ $ad->ad_label }}</td>
                                <td field-key='total_impressions'>{{ $ad->total_impressions }}</td>
                                <td field-key='total_networks'>{{ $ad->total_networks }}</td>
                                <td field-key='total_channels'>{{ $ad->total_channels }}</td>
                                <td field-key='created_by'>{{ $ad->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $ad->created_by_team->name or '' }}</td>
                                <td field-key='category_id'>
                                    @foreach ($ad->category_id as $singleCategoryId)
                                        <span class="label label-info label-many">{{ $singleCategoryId->category }}</span>
                                    @endforeach
                                </td>
                                <td field-key='video_screenshot'>@if($ad->video_screenshot)<a href="{{ asset(env('UPLOAD_PATH').'/' . $ad->video_screenshot) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $ad->video_screenshot) }}"/></a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.ads.restore', $ad->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.ads.perma_del', $ad->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('ad_view')
                                    <a href="{{ route('admin.ads.show',[$ad->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('ad_edit')
                                    <a href="{{ route('admin.ads.edit',[$ad->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('ad_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.ads.destroy', $ad->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="16">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
