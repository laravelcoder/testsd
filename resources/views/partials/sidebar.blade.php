@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li>
                <select class="searchable-field form-control"></select>
            </li>

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @can('ads_dashboard_access')
            <li>
                <a href="{{ route('admin.ads_dashboards.index') }}">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.ads-dashboard.title')</span>
                </a>
            </li>@endcan
            
            @can('advertiser_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-phone-square"></i>
                    <span>@lang('global.advertiser-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('advertisers_detail_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.advertisers-details.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('contact_company_access')
                            <li>
                                <a href="{{ route('admin.contact_companies.index') }}">
                                    <i class="fa fa-building-o"></i>
                                    <span>@lang('global.contact-companies.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('contact_access')
                            <li>
                                <a href="{{ route('admin.contacts.index') }}">
                                    <i class="fa fa-user-plus"></i>
                                    <span>@lang('global.contacts.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('agent_access')
                            <li>
                                <a href="{{ route('admin.agents.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.agents.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('audience_access')
                            <li>
                                <a href="{{ route('admin.audiences.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.audiences.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('demographic_access')
                            <li>
                                <a href="{{ route('admin.demographics.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.demographics.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                    @can('phone_access')
                    <li>
                        <a href="{{ route('admin.phones.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.phones.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('ads_section_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-adn"></i>
                            <span>@lang('global.ads-section.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('category_access')
                            <li>
                                <a href="{{ route('admin.categories.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.categories.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('ad_access')
                            <li>
                                <a href="{{ route('admin.ads.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span>@lang('global.ads.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                    @can('campaign_access')
                    <li>
                        <a href="{{ route('admin.campaigns.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.campaign.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('internal_notification_access')
            <li>
                <a href="{{ route('admin.internal_notifications.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span>@lang('global.internal-notifications.title')</span>
                </a>
            </li>@endcan
            
            @can('network_research_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-video-o"></i>
                    <span>@lang('global.network-research.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('network_access')
                    <li>
                        <a href="{{ route('admin.networks.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.networks.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('affiliate_access')
                    <li>
                        <a href="{{ route('admin.affiliates.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.affiliates.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('station_access')
                    <li>
                        <a href="{{ route('admin.stations.index') }}">
                            <i class="fa fa-video-camera"></i>
                            <span>@lang('global.stations.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('team_access')
                    <li>
                        <a href="{{ route('admin.teams.index') }}">
                            <i class="fa fa-users"></i>
                            <span>@lang('global.teams.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            

            

            
            @php ($unread = App\MessengerTopic::countUnread())
            <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                <a href="{{ route('admin.messenger.index') }}">
                    <i class="fa fa-envelope"></i>

                    <span>Messages</span>
                    @if($unread > 0)
                        {{ ($unread > 0 ? '('.$unread.')' : '') }}
                    @endif
                </a>
            </li>
            <style>
                .page-sidebar-menu .unread * {
                    font-weight:bold !important;
                }
            </style>



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

