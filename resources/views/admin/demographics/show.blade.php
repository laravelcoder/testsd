@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.demographics.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.demographics.fields.demographic')</th>
                            <td field-key='demographic'>{{ $demographic->demographic }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.demographics.fields.value')</th>
                            <td field-key='value'>{{ $demographic->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.demographics.fields.created-by')</th>
                            <td field-key='created_by'>{{ $demographic->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.demographics.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $demographic->created_by_team->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.demographics.fields.advertiser')</th>
                            <td field-key='advertiser'>{{ $demographic->advertiser->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.demographics.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
