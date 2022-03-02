<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Settings;
use App\Models\Post;
use App\Models\Category;
use App\Models\Translate;
use App\Models\Page;
use App\Models\Feature;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        try {

            if (env('SYSTEM_INSTALLED') != 0) {

                view()->composer('*', function ($view) {
                    $setting = Settings::pluck('value', 'key')->all();
                    $view->with('setdata', $setting);
                });

                view()->composer('*', function ($view) {
                    $translation = Translate::pluck('value', 'key')->all();
                    $view->with('tran', $translation);
                });


                view()->composer('layouts.user', function ($view) {
                    $pages = Page::where("status", "=", 1)->get();
                    $view->with('pages', $pages);
                });


                view()->composer('frontend.features', function ($view) {
                    $limit = Settings::selectSettings('popular_posts');
                    $posts = Post::where("status", "=", 1)->orderBy('views', 'DESC')->limit($limit)->get();
                    $features = Feature::all();
                    $view->with('popular_posts', $posts)->with("features", $features);
                });



                view()->composer('frontend.sidebar', function ($view) {
                    $posts = Post::where("status", "=", 1)->orderBy('views', 'DESC')->limit(4)->get();
                    $categories = Category::all();
                    $view->with('popular_posts', $posts)->with("categories", $categories);
                });
            }
        } catch (\Exception $e) {
            return [];
        }
    }
}
