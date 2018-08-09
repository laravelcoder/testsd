<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 1, 'title' => 'user_management_access'],
            ['id' => 2, 'title' => 'permission_access'],
            ['id' => 3, 'title' => 'permission_create'],
            ['id' => 4, 'title' => 'permission_edit'],
            ['id' => 5, 'title' => 'permission_view'],
            ['id' => 6, 'title' => 'permission_delete'],
            ['id' => 7, 'title' => 'role_access'],
            ['id' => 8, 'title' => 'role_create'],
            ['id' => 9, 'title' => 'role_edit'],
            ['id' => 10, 'title' => 'role_view'],
            ['id' => 11, 'title' => 'role_delete'],
            ['id' => 12, 'title' => 'user_access'],
            ['id' => 13, 'title' => 'user_create'],
            ['id' => 14, 'title' => 'user_edit'],
            ['id' => 15, 'title' => 'user_view'],
            ['id' => 16, 'title' => 'user_delete'],
            ['id' => 17, 'title' => 'ads_dashboard_access'],
            ['id' => 19, 'title' => 'team_access'],
            ['id' => 20, 'title' => 'team_create'],
            ['id' => 21, 'title' => 'team_edit'],
            ['id' => 22, 'title' => 'team_view'],
            ['id' => 23, 'title' => 'team_delete'],
            ['id' => 24, 'title' => 'internal_notification_access'],
            ['id' => 25, 'title' => 'internal_notification_create'],
            ['id' => 26, 'title' => 'internal_notification_edit'],
            ['id' => 27, 'title' => 'internal_notification_view'],
            ['id' => 28, 'title' => 'internal_notification_delete'],
            ['id' => 29, 'title' => 'contact_management_access'],
            ['id' => 30, 'title' => 'contact_management_create'],
            ['id' => 31, 'title' => 'contact_management_edit'],
            ['id' => 32, 'title' => 'contact_management_view'],
            ['id' => 33, 'title' => 'contact_management_delete'],
            ['id' => 34, 'title' => 'contact_company_access'],
            ['id' => 35, 'title' => 'contact_company_create'],
            ['id' => 36, 'title' => 'contact_company_edit'],
            ['id' => 37, 'title' => 'contact_company_view'],
            ['id' => 38, 'title' => 'contact_company_delete'],
            ['id' => 39, 'title' => 'contact_access'],
            ['id' => 40, 'title' => 'contact_create'],
            ['id' => 41, 'title' => 'contact_edit'],
            ['id' => 42, 'title' => 'contact_view'],
            ['id' => 43, 'title' => 'contact_delete'],
            ['id' => 44, 'title' => 'agent_access'],
            ['id' => 45, 'title' => 'agent_create'],
            ['id' => 46, 'title' => 'agent_edit'],
            ['id' => 47, 'title' => 'agent_view'],
            ['id' => 48, 'title' => 'agent_delete'],
            ['id' => 49, 'title' => 'ad_access'],
            ['id' => 50, 'title' => 'ad_create'],
            ['id' => 51, 'title' => 'ad_edit'],
            ['id' => 52, 'title' => 'ad_view'],
            ['id' => 53, 'title' => 'ad_delete'],
            ['id' => 54, 'title' => 'category_access'],
            ['id' => 55, 'title' => 'category_create'],
            ['id' => 56, 'title' => 'category_edit'],
            ['id' => 57, 'title' => 'category_view'],
            ['id' => 58, 'title' => 'category_delete'],
            ['id' => 59, 'title' => 'phone_access'],
            ['id' => 60, 'title' => 'phone_create'],
            ['id' => 61, 'title' => 'phone_edit'],
            ['id' => 62, 'title' => 'phone_view'],
            ['id' => 63, 'title' => 'phone_delete'],
            ['id' => 65, 'title' => 'ads_section_access'],
            ['id' => 66, 'title' => 'audience_access'],
            ['id' => 67, 'title' => 'audience_create'],
            ['id' => 68, 'title' => 'audience_edit'],
            ['id' => 69, 'title' => 'audience_view'],
            ['id' => 70, 'title' => 'audience_delete'],
            ['id' => 71, 'title' => 'demographic_access'],
            ['id' => 72, 'title' => 'demographic_create'],
            ['id' => 73, 'title' => 'demographic_edit'],
            ['id' => 74, 'title' => 'demographic_view'],
            ['id' => 75, 'title' => 'demographic_delete'],
            ['id' => 76, 'title' => 'advertisers_detail_access'],
            ['id' => 77, 'title' => 'network_research_access'],
            ['id' => 83, 'title' => 'network_access'],
            ['id' => 84, 'title' => 'network_create'],
            ['id' => 85, 'title' => 'network_edit'],
            ['id' => 86, 'title' => 'network_view'],
            ['id' => 87, 'title' => 'network_delete'],
            ['id' => 93, 'title' => 'station_access'],
            ['id' => 94, 'title' => 'station_create'],
            ['id' => 95, 'title' => 'station_edit'],
            ['id' => 96, 'title' => 'station_view'],
            ['id' => 97, 'title' => 'station_delete'],
            ['id' => 98, 'title' => 'advertiser_management_access'],
            ['id' => 99, 'title' => 'campaign_access'],
            ['id' => 100, 'title' => 'campaign_create'],
            ['id' => 101, 'title' => 'campaign_edit'],
            ['id' => 102, 'title' => 'campaign_view'],
            ['id' => 103, 'title' => 'campaign_delete'],
            ['id' => 104, 'title' => 'affiliate_access'],
            ['id' => 105, 'title' => 'affiliate_create'],
            ['id' => 106, 'title' => 'affiliate_edit'],
            ['id' => 107, 'title' => 'affiliate_view'],
            ['id' => 108, 'title' => 'affiliate_delete'],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
