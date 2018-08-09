@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.contact-companies.title')</h3>
    @can('contact_company_create')
    <p>
        <a href="{{ route('admin.contact_companies.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('contact_company_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('contact_company_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.contact-companies.fields.name')</th>
                        <th>@lang('global.contact-companies.fields.address')</th>
                        <th>@lang('global.contact-companies.fields.website')</th>
                        <th>@lang('global.contact-companies.fields.email')</th>
                        <th>@lang('global.contact-companies.fields.address2')</th>
                        <th>@lang('global.contact-companies.fields.city')</th>
                        <th>@lang('global.contact-companies.fields.state')</th>
                        <th>@lang('global.contact-companies.fields.zipcode')</th>
                        <th>@lang('global.contact-companies.fields.country')</th>
                        <th>@lang('global.contact-companies.fields.logo')</th>
                        <th>@lang('global.contact-companies.fields.created-by')</th>
                        <th>@lang('global.contact-companies.fields.created-by-team')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('contact_company_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.contact_companies.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.contact_companies.index') !!}';
            window.dtDefaultOptions.columns = [@can('contact_company_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'name', name: 'name'},
                {data: 'address', name: 'address'},
                {data: 'website', name: 'website'},
                {data: 'email', name: 'email'},
                {data: 'address2', name: 'address2'},
                {data: 'city', name: 'city'},
                {data: 'state', name: 'state'},
                {data: 'zipcode', name: 'zipcode'},
                {data: 'country', name: 'country'},
                {data: 'logo', name: 'logo'},
                {data: 'created_by.name', name: 'created_by.name'},
                {data: 'created_by_team.name', name: 'created_by_team.name'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection