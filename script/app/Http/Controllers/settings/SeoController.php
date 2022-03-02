<?php

namespace App\Http\Controllers\settings;

use App\Models\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $settings = Settings::whereIn('key', ['description', 'keywords', 'google_analytics_code', 'facebook', 'instagram', 'youtube', 'twitter', 'chrome_extensions', 'mozilla_extensions', 'playstore', 'appstore'])->get();
        $setting = $settings->pluck('value', 'key')->all();
        return view('backend.settings.seo')->with("setting", $setting);
    }

    public function update(Request $request)
    {
        //dd($request);
        $request->validate([
            'description' => 'max:1000',
            'keywords' => 'max:1000',
            'google_analytics_code' => 'max:100',
        ]);

        $settings = Settings::whereIn('key', ['description', 'keywords', 'google_analytics_code', 'facebook', 'instagram', 'youtube', 'twitter', 'chrome_extensions', 'mozilla_extensions', 'playstore', 'appstore'])->get();
        foreach ($settings as $setting) {
            $key = $setting->key;
            $setting->value = $request->$key;
            $setting->save();
        }

        session()->flash('success', 'Updated Successfuly');
        return redirect(route('settings.seo'));
    }
}
