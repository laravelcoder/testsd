@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.contact-companies.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.contact-companies.fields.name')</th>
                            <td field-key='name'>{{ $contact_company->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.website')</th>
                            <td field-key='website'>{{ $contact_company->website }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.email')</th>
                            <td field-key='email'>{{ $contact_company->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.address')</th>
                            <td field-key='address'>{{ $contact_company->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.address2')</th>
                            <td field-key='address2'>{{ $contact_company->address2 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.city')</th>
                            <td field-key='city'>{{ $contact_company->city }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.state')</th>
                            <td field-key='state'>{{ $contact_company->state }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.zipcode')</th>
                            <td field-key='zipcode'>{{ $contact_company->zipcode }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.country')</th>
                            <td field-key='country'>{{ $contact_company->country }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.logo')</th>
                            <td field-key='logo'>@if($contact_company->logo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $contact_company->logo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $contact_company->logo) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.created-by')</th>
                            <td field-key='created_by'>{{ $contact_company->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contact-companies.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $contact_company->created_by_team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#contacts" aria-controls="contacts" role="tab" data-toggle="tab">Contacts</a></li>
<li role="presentation" class=""><a href="#agents" aria-controls="agents" role="tab" data-toggle="tab">Agents</a></li>
<li role="presentation" class=""><a href="#categories" aria-controls="categories" role="tab" data-toggle="tab">Categories</a></li>
<li role="presentation" class=""><a href="#phones" aria-controls="phones" role="tab" data-toggle="tab">Phones</a></li>
<li role="presentation" class=""><a href="#audiences" aria-controls="audiences" role="tab" data-toggle="tab">Audiences</a></li>
<li role="presentation" class=""><a href="#demographics" aria-controls="demographics" role="tab" data-toggle="tab">Demographics</a></li>
<li role="presentation" class=""><a href="#campaign" aria-controls="campaign" role="tab" data-toggle="tab">Campaign</a></li>
<li role="presentation" class=""><a href="#ads" aria-controls="ads" role="tab" data-toggle="tab">Ads</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="contacts">
<table class="table table-bordered table-striped {{ count($contacts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.contacts.fields.first-name')</th>
                        <th>@lang('global.contacts.fields.last-name')</th>
                        <th>@lang('global.contacts.fields.email')</th>
                        <th>@lang('global.contacts.fields.created-by')</th>
                        <th>@lang('global.contacts.fields.created-by-team')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($contacts) > 0)
            @foreach ($contacts as $contact)
                <tr data-entry-id="{{ $contact->id }}">
                    <td field-key='first_name'>{{ $contact->first_name }}</td>
                                <td field-key='last_name'>{{ $contact->last_name }}</td>
                                <td field-key='email'>{{ $contact->email }}</td>
                                <td field-key='created_by'>{{ $contact->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $contact->created_by_team->name or '' }}</td>
                                                                <td>
                                    @can('contact_view')
                                    <a href="{{ route('admin.contacts.show',[$contact->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('contact_edit')
                                    <a href="{{ route('admin.contacts.edit',[$contact->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('contact_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.contacts.destroy', $contact->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="agents">
<table class="table table-bordered table-striped {{ count($agents) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.agents.fields.advertiser')</th>
                        <th>@lang('global.agents.fields.first-name')</th>
                        <th>@lang('global.agents.fields.last-name')</th>
                        <th>@lang('global.agents.fields.email')</th>
                        <th>@lang('global.agents.fields.skype')</th>
                        <th>@lang('global.agents.fields.created-by')</th>
                        <th>@lang('global.agents.fields.created-by-team')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($agents) > 0)
            @foreach ($agents as $agent)
                <tr data-entry-id="{{ $agent->id }}">
                    <td field-key='advertiser'>{{ $agent->advertiser->name or '' }}</td>
                                <td field-key='first_name'>{{ $agent->first_name }}</td>
                                <td field-key='last_name'>{{ $agent->last_name }}</td>
                                <td field-key='email'>{{ $agent->email }}</td>
                                <td field-key='skype'>{{ $agent->skype }}</td>
                                <td field-key='created_by'>{{ $agent->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $agent->created_by_team->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.agents.restore', $agent->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.agents.perma_del', $agent->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('agent_view')
                                    <a href="{{ route('admin.agents.show',[$agent->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('agent_edit')
                                    <a href="{{ route('admin.agents.edit',[$agent->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('agent_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.agents.destroy', $agent->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="categories">
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
<div role="tabpanel" class="tab-pane " id="phones">
<table class="table table-bordered table-striped {{ count($phones) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.phones.fields.phone-number')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($phones) > 0)
            @foreach ($phones as $phone)
                <tr data-entry-id="{{ $phone->id }}">
                    <td field-key='phone_number'>{{ $phone->phone_number }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.phones.restore', $phone->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.phones.perma_del', $phone->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('phone_view')
                                    <a href="{{ route('admin.phones.show',[$phone->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('phone_edit')
                                    <a href="{{ route('admin.phones.edit',[$phone->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('phone_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.phones.destroy', $phone->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="audiences">
<table class="table table-bordered table-striped {{ count($audiences) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.audiences.fields.name')</th>
                        <th>@lang('global.audiences.fields.value')</th>
                        <th>@lang('global.audiences.fields.created-by')</th>
                        <th>@lang('global.audiences.fields.created-by-team')</th>
                        <th>@lang('global.audiences.fields.advertiser')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($audiences) > 0)
            @foreach ($audiences as $audience)
                <tr data-entry-id="{{ $audience->id }}">
                    <td field-key='name'>{{ $audience->name }}</td>
                                <td field-key='value'>{{ $audience->value }}</td>
                                <td field-key='created_by'>{{ $audience->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $audience->created_by_team->name or '' }}</td>
                                <td field-key='advertiser'>{{ $audience->advertiser->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.audiences.restore', $audience->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.audiences.perma_del', $audience->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('audience_view')
                                    <a href="{{ route('admin.audiences.show',[$audience->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('audience_edit')
                                    <a href="{{ route('admin.audiences.edit',[$audience->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('audience_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.audiences.destroy', $audience->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="demographics">
<table class="table table-bordered table-striped {{ count($demographics) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.demographics.fields.demographic')</th>
                        <th>@lang('global.demographics.fields.value')</th>
                        <th>@lang('global.demographics.fields.created-by')</th>
                        <th>@lang('global.demographics.fields.created-by-team')</th>
                        <th>@lang('global.demographics.fields.advertiser')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($demographics) > 0)
            @foreach ($demographics as $demographic)
                <tr data-entry-id="{{ $demographic->id }}">
                    <td field-key='demographic'>{{ $demographic->demographic }}</td>
                                <td field-key='value'>{{ $demographic->value }}</td>
                                <td field-key='created_by'>{{ $demographic->created_by->name or '' }}</td>
                                <td field-key='created_by_team'>{{ $demographic->created_by_team->name or '' }}</td>
                                <td field-key='advertiser'>{{ $demographic->advertiser->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.demographics.restore', $demographic->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.demographics.perma_del', $demographic->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('demographic_view')
                                    <a href="{{ route('admin.demographics.show',[$demographic->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('demographic_edit')
                                    <a href="{{ route('admin.demographics.edit',[$demographic->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('demographic_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.demographics.destroy', $demographic->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
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
<div role="tabpanel" class="tab-pane " id="ads">
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

            <a href="{{ route('admin.contact_companies.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
