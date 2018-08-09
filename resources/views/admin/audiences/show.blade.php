@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.audiences.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.audiences.fields.name')</th>
                            <td field-key='name'>{{ $audience->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.audiences.fields.value')</th>
                            <td field-key='value'>{{ $audience->value }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.audiences.fields.created-by')</th>
                            <td field-key='created_by'>{{ $audience->created_by->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.audiences.fields.created-by-team')</th>
                            <td field-key='created_by_team'>{{ $audience->created_by_team->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.audiences.fields.advertiser')</th>
                            <td field-key='advertiser'>{{ $audience->advertiser->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.audiences.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
