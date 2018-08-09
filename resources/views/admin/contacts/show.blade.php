@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.contacts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.contacts.fields.first-name')</th>
                            <td field-key='first_name'>{{ $contact->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.last-name')</th>
                            <td field-key='last_name'>{{ $contact->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.email')</th>
                            <td field-key='email'>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.skype')</th>
                            <td field-key='skype'>{{ $contact->skype }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.address')</th>
                            <td field-key='address'>{{ $contact->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.notes')</th>
                            <td field-key='notes'>{!! $contact->notes !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.created-by')</th>
                            <td field-key='created_by'>{{ $contact->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.contacts.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $contact->created_by_team->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#phones" aria-controls="phones" role="tab" data-toggle="tab">Phones</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="phones">
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.contacts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
