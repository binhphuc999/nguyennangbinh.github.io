<?php

namespace App\Http\Controllers\settings;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ddeboer\Imap\Server;
use Carbon\Carbon;

class GeneralController extends Controller
{

   
    public function index()
    {
        $settings = Settings::whereIn('key', [
            'name', 'site_url', 'site_logo', 'favicon', 'imap_host', 'imap_user', 'imap_pass', 'domains', 'forbidden_id', 'allowed_files', 'fetch_time', 
            'email_lifetime', 'main_color', 'secondary_color', 'emails_created', 'messages_received', 'imap_certificate' , 'imap_port' , 'imap_encryption'
        ])->get();
        $setting = $settings->pluck('value', 'key')->all();
        return view('backend.settings.general')->with("setting", $setting);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'site_url' => 'required|url',
            'site_logo' => 'mimes:png,jpg,jpeg,svg,gif|max:2048',
            'favicon' => 'mimes:ico,png,jpg,jpeg,gif|max:2048',
        ]);

        $request->site_url = rtrim($request->site_url, '/');


        if ($request->has('site_logo')) {
            $file = $request->site_logo;
            $site_logo = time() . '-' . $file->getClientOriginalName();
            $file->move('./uploads/', $site_logo);
            Settings::updateSettings('site_logo', '/uploads/' . $site_logo);
        }

        if ($request->has('favicon')) {
            $file = $request->favicon;
            $favicon = time() . '-' . $file->getClientOriginalName();
            $file->move('./uploads/', $favicon);
            Settings::updateSettings('favicon', '/uploads/' . $favicon);
        }

        $settings = Settings::whereIn('key', ['name', 'site_url', 'main_color', 'secondary_color'])->get();
        foreach ($settings as $setting) {
            $key = $setting->key;
            $setting->value = $request->$key;
            $setting->save();
        }


        session()->flash('success', 'Updated Successfuly');
        return redirect(route('settings.general'));
    }

    public function update2(Request $request)
    {

        $request->validate([
            'imap_host' => 'required',
            'imap_user' => 'required',
            'imap_port' => 'required|numeric',
            'imap_certificate' => 'boolean',
            'domains' => 'required',
            'fetch_time' => 'numeric|required|min:5',
            'email_lifetime' => 'numeric|required|min:1',
            'messages_received' => 'numeric|required|min:0',
            'emails_created' => 'numeric|required|min:0',
        ]);

        if ($request->imap_certificate == null) {
            $request->imap_certificate = 0;
        }

        $settings = Settings::whereIn('key', ['imap_host', 'imap_user', 'imap_pass', 'domains', 'forbidden_id', 'allowed_files', 
        'fetch_time', 'email_lifetime', 'emails_created', 'messages_received' , 'imap_encryption' , 'imap_port' , 'imap_certificate'])->get();
        foreach ($settings as $setting) {
            $key = $setting->key;
            $setting->value = $request->$key;
            $setting->save();
        }

        session()->flash('success', 'Updated Successfuly');
        return redirect(route('settings.general'));
    }


    public function check_imap(Request $request){

        $time1 = Carbon::now()->timestamp;

        if ($request->certificate == null) {
            $request->certificate = 0;
        }

        

        $host = $request->host ;
        $user = $request->user ;
        $pass = $request->pass ;
        $port = $request->port ;
        $encryption = $request->encryption ;
        $certificate = $request->certificate ;


        try {

            if(empty($host) || empty($user) || empty($pass) || empty($port) || empty($encryption)  ){

                return '<div class="error">ERROR:  The server data is incomplete :/ </div>';

            }

            $flag = '/imap/' . $encryption ;

            if($certificate == 0){
                $flag .= '/novalidate-cert';
            }else{
                $flag .= '/validate-cert';
            }

            $server = new Server($host , $port,  $flag);
            $connection = $server->authenticate($user, $pass);
            $mailboxes = $connection->getMailboxes();

            $i = 0 ;
            foreach ($mailboxes as $mailbox) {
                $i++;
            }

            if($i > 0){

                $time2 = Carbon::now()->timestamp;
                $t = $time2 - $time1 ;
                return '<div class="success">SUCCESS ['.$t.'s]:  Your IMAP Server Is Working :)</div>';

            }

        } catch (\Exception $e) {
            $time2 = Carbon::now()->timestamp;
            $t = $time2 - $time1 ;
            return '<div class="error">ERROR ['.$t.'s]: Please Check You Info Or Try With Another Port And Encryption <br>' . $e->getMessage() . '</div>';

        }



    }
}
