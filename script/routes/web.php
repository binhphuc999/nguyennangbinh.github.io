<?php

use Illuminate\Support\Facades\Route;
use App\Models\Settings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'IsInstalled'], function () {
    Route::get('/install', function () {
        return redirect()->route('install/install');
    })->name('install');
    Route::get('/install/install', "Install\InstallController@index")->name('install/install');
    Route::get('/install/step1', "Install\InstallController@step1")->name('install/step1');
    Route::post('/install/step1/set_database', "Install\InstallController@set_database")->name('install/step1/set_database');
    Route::get('/install/step2', "Install\InstallController@step2")->name('install/step2');
    Route::post('/install/step2/import_database', "Install\InstallController@import_database")->name('install/step2/import_database');
    Route::get('/install/step3', "Install\InstallController@step3")->name('install/step3');
    Route::post('/install/step3/set_siteinfo', "Install\InstallController@set_siteinfo")->name('install/step3/set_siteinfo');
    Route::get('/install/step4', "Install\InstallController@step4")->name('install/step4');
    Route::post('/install/step4/set_admininfo', "Install\InstallController@set_admininfo")->name('install/step4/set_admininfo');
});



Route::group(['middleware' => 'check.installation'], function () {
    Auth::routes(['register' => false]);

    Route::get('/', 'TrashMailController@index')->name("home");

    Route::get('/index', 'TrashMailController@index')->name("index");

    Route::get('/messages', 'TrashMailController@messages')->name("messages");

    Route::get('/delete', 'TrashMailController@delete')->name("delete");

    Route::get('/delete/{id}', 'TrashMailController@deletemessage')->name("delete.message");

    Route::get('/change', 'TrashMailController@change')->name("change");

    Route::post('/create', 'TrashMailController@create')->name("create");

    Route::get('/view/{id}', 'TrashMailController@show')->name("view");

    Route::get('/message/{id}', 'TrashMailController@message')->name("message");

    Route::get('/download/{id}/{file?}', 'TrashMailController@download');

    Route::get('/page/{slug}', 'PageController@show')->name("page");

    Route::get('/contact', 'ContactController@index')->name('contact');

    Route::post('/contact', 'ContactController@store')->name('contact.store');



    if (env('SYSTEM_INSTALLED') != 0) {
        if (Settings::selectSettings('enable_blog')) {

            Route::get('/blog', 'BlogController@index')->name("blog");

            Route::get('/post/{slug}', 'PostController@show')->name("post");

            Route::get('/category/{slug}', 'CategoryController@show')->name("category");
        }
    }
});




Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin', 'check.installation']], function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    })->name('admin');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/settings', 'DashboardController@settings')->name('settings');

    // General Settings
    Route::get('/settings/general', 'settings\GeneralController@index')->name('settings.general');
    Route::post('/settings/general/update', 'settings\GeneralController@update')->name('settings.general.update');
    Route::post('/settings/general/update2', 'settings\GeneralController@update2')->name('settings.general.update2');
    Route::post('/settings/check/imap', 'settings\GeneralController@check_imap')->name('check.imap');


    // Seo Settings
    Route::get('/settings/seo', 'settings\SeoController@index')->name('settings.seo');
    Route::post('/settings/seo/update', 'settings\SeoController@update')->name('settings.seo.update');

    // Ads Settings
    Route::get('/settings/ads', 'settings\AdsController@index')->name('settings.ads');
    Route::post('/settings/ads/update', 'settings\AdsController@update')->name('settings.ads.update');

    // Blog Setting 
    Route::get('/settings/blog', 'settings\BlogSettingController@index')->name('settings.blog');
    Route::post('/settings/blog/update', 'settings\BlogSettingController@update')->name('settings.blog.update');

    // frontend Setting 
    Route::get('/settings/frontend', 'settings\TranslateController@index')->name('settings.frontend');
    Route::post('/settings/frontend/update', 'settings\TranslateController@update')->name('settings.frontend.update');

    // SMTP Setting 
    Route::get('/settings/smtp', 'settings\SmtpController@index')->name('settings.smtp');
    Route::post('/settings/smtp/update', 'settings\SmtpController@update')->name('settings.smtp.update');
    


    // Profile Settings
    Route::get('/profile', 'settings\ProfileController@index')->name('profile');
    Route::post('/profile/info/update', 'settings\ProfileController@changeInfo')->name('settings.info.update');
    Route::post('/profile/password/update', 'settings\ProfileController@changePassword')->name('settings.password.update');

    Route::get('/posts/checkslug', 'PostController@checkSlug')->name('posts.checkslug');
    Route::get('/categories/checkslug', 'CategoryController@checkSlug')->name('categories.checkslug');
    Route::get('/pages/checkslug', 'PageController@checkSlug')->name('pages.checkslug');

    Route::resource('/posts', "PostController");
    Route::resource('/categories', 'CategoryController');
    Route::resource('/pages', 'PageController');
    Route::resource('/features', 'FeatureController');
});
