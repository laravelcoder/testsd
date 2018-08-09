<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Social Login Routes..
Route::get('login/{driver}', 'Auth\LoginController@redirectToSocial')->name('auth.login.social');
Route::get('{driver}/callback', 'Auth\LoginController@handleSocialCallback')->name('auth.login.social_callback');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('ads_dashboards', 'Admin\AdsDashboardsController');
    Route::resource('contact_companies', 'Admin\ContactCompaniesController');
    Route::post('contact_companies_mass_destroy', ['uses' => 'Admin\ContactCompaniesController@massDestroy', 'as' => 'contact_companies.mass_destroy']);
    Route::resource('contacts', 'Admin\ContactsController');
    Route::post('contacts_mass_destroy', ['uses' => 'Admin\ContactsController@massDestroy', 'as' => 'contacts.mass_destroy']);
    Route::resource('agents', 'Admin\AgentsController');
    Route::post('agents_mass_destroy', ['uses' => 'Admin\AgentsController@massDestroy', 'as' => 'agents.mass_destroy']);
    Route::post('agents_restore/{id}', ['uses' => 'Admin\AgentsController@restore', 'as' => 'agents.restore']);
    Route::delete('agents_perma_del/{id}', ['uses' => 'Admin\AgentsController@perma_del', 'as' => 'agents.perma_del']);
    Route::resource('audiences', 'Admin\AudiencesController');
    Route::post('audiences_mass_destroy', ['uses' => 'Admin\AudiencesController@massDestroy', 'as' => 'audiences.mass_destroy']);
    Route::post('audiences_restore/{id}', ['uses' => 'Admin\AudiencesController@restore', 'as' => 'audiences.restore']);
    Route::delete('audiences_perma_del/{id}', ['uses' => 'Admin\AudiencesController@perma_del', 'as' => 'audiences.perma_del']);
    Route::resource('demographics', 'Admin\DemographicsController');
    Route::post('demographics_mass_destroy', ['uses' => 'Admin\DemographicsController@massDestroy', 'as' => 'demographics.mass_destroy']);
    Route::post('demographics_restore/{id}', ['uses' => 'Admin\DemographicsController@restore', 'as' => 'demographics.restore']);
    Route::delete('demographics_perma_del/{id}', ['uses' => 'Admin\DemographicsController@perma_del', 'as' => 'demographics.perma_del']);
    Route::get('internal_notifications/read', 'Admin\InternalNotificationsController@read');
    Route::resource('internal_notifications', 'Admin\InternalNotificationsController');
    Route::post('internal_notifications_mass_destroy', ['uses' => 'Admin\InternalNotificationsController@massDestroy', 'as' => 'internal_notifications.mass_destroy']);
    Route::resource('phones', 'Admin\PhonesController');
    Route::post('phones_mass_destroy', ['uses' => 'Admin\PhonesController@massDestroy', 'as' => 'phones.mass_destroy']);
    Route::post('phones_restore/{id}', ['uses' => 'Admin\PhonesController@restore', 'as' => 'phones.restore']);
    Route::delete('phones_perma_del/{id}', ['uses' => 'Admin\PhonesController@perma_del', 'as' => 'phones.perma_del']);
    Route::resource('categories', 'Admin\CategoriesController');
    Route::post('categories_mass_destroy', ['uses' => 'Admin\CategoriesController@massDestroy', 'as' => 'categories.mass_destroy']);
    Route::post('categories_restore/{id}', ['uses' => 'Admin\CategoriesController@restore', 'as' => 'categories.restore']);
    Route::delete('categories_perma_del/{id}', ['uses' => 'Admin\CategoriesController@perma_del', 'as' => 'categories.perma_del']);
    Route::resource('ads', 'Admin\AdsController');
    Route::post('ads_mass_destroy', ['uses' => 'Admin\AdsController@massDestroy', 'as' => 'ads.mass_destroy']);
    Route::post('ads_restore/{id}', ['uses' => 'Admin\AdsController@restore', 'as' => 'ads.restore']);
    Route::delete('ads_perma_del/{id}', ['uses' => 'Admin\AdsController@perma_del', 'as' => 'ads.perma_del']);
    Route::resource('campaigns', 'Admin\CampaignsController');
    Route::post('campaigns_mass_destroy', ['uses' => 'Admin\CampaignsController@massDestroy', 'as' => 'campaigns.mass_destroy']);
    Route::post('campaigns_restore/{id}', ['uses' => 'Admin\CampaignsController@restore', 'as' => 'campaigns.restore']);
    Route::delete('campaigns_perma_del/{id}', ['uses' => 'Admin\CampaignsController@perma_del', 'as' => 'campaigns.perma_del']);
    Route::resource('networks', 'Admin\NetworksController');
    Route::post('networks_mass_destroy', ['uses' => 'Admin\NetworksController@massDestroy', 'as' => 'networks.mass_destroy']);
    Route::post('networks_restore/{id}', ['uses' => 'Admin\NetworksController@restore', 'as' => 'networks.restore']);
    Route::delete('networks_perma_del/{id}', ['uses' => 'Admin\NetworksController@perma_del', 'as' => 'networks.perma_del']);
    Route::resource('affiliates', 'Admin\AffiliatesController');
    Route::post('affiliates_mass_destroy', ['uses' => 'Admin\AffiliatesController@massDestroy', 'as' => 'affiliates.mass_destroy']);
    Route::post('affiliates_restore/{id}', ['uses' => 'Admin\AffiliatesController@restore', 'as' => 'affiliates.restore']);
    Route::delete('affiliates_perma_del/{id}', ['uses' => 'Admin\AffiliatesController@perma_del', 'as' => 'affiliates.perma_del']);
    Route::resource('stations', 'Admin\StationsController');
    Route::post('stations_mass_destroy', ['uses' => 'Admin\StationsController@massDestroy', 'as' => 'stations.mass_destroy']);
    Route::post('stations_restore/{id}', ['uses' => 'Admin\StationsController@restore', 'as' => 'stations.restore']);
    Route::delete('stations_perma_del/{id}', ['uses' => 'Admin\StationsController@perma_del', 'as' => 'stations.perma_del']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('teams', 'Admin\TeamsController');
    Route::post('teams_mass_destroy', ['uses' => 'Admin\TeamsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);

    Route::model('messenger', 'App\MessengerTopic');
    Route::get('messenger/inbox', 'Admin\MessengerController@inbox')->name('messenger.inbox');
    Route::get('messenger/outbox', 'Admin\MessengerController@outbox')->name('messenger.outbox');
    Route::resource('messenger', 'Admin\MessengerController');


    Route::get('search', 'MegaSearchController@search')->name('mega-search');
    Route::get('language/{lang}', function ($lang) {
        return redirect()->back()->withCookie(cookie()->forever('language', $lang));
    })->name('language');});
