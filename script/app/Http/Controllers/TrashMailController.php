<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\Settings;
use App\Models\TrashMail;
use Illuminate\Support\Str;
use Ddeboer\Imap\Search\RawExpression;
use Ddeboer\Imap\SearchExpression;
use Ddeboer\Imap\Search\Email\To;
use Ddeboer\Imap\Search\Text\Body;
use Illuminate\Support\Facades\Cache;
use Vinkla\Hashids\Facades\Hashids;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;



class TrashMailController extends Controller
{

    // show home page 
    public function index()
    {
        return view('frontend.index');
    }


    // generat email and check if unique  
    private function generateRandomEmail($length = 7, $num = 3)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '013456789';
        $charactersLength = strlen($characters);
        $numbersLength = strlen($numbers);
        $randomEmail = '';
        for ($i = 0; $i < $length; $i++) {
            $randomEmail .= $characters[rand(0, $charactersLength - 1)];
        }
        for ($i = 0; $i < $num; $i++) {
            $randomEmail .= $numbers[rand(0, $numbersLength - 1)];
        }

        $randomEmail .= "@";

        if (Str::length(Settings::selectSettings("domains")) > 0) {
            $domain = explode(',', Settings::selectSettings("domains"));
            $randomEmail .= $domain[array_rand($domain)];
        } else {
            abort(401, 'You must add a domain');
        }

        if (TrashMail::where('email',  $randomEmail)->exists()) {
            return generateRandomEmail();
        } else {
            return $randomEmail;
        }
    }


    // get all messages from 
    public function messages()
    {
        if (Cookie::has('email')) {
            $email =  Cookie::get('email');
        } else {

            $date = Carbon::now();
            $newDateTime = Carbon::now()->addDays(Settings::selectSettings("email_lifetime"));

            $email = $this->generateRandomEmail();
            Cookie::queue('email', $email, Settings::selectSettings("email_lifetime") * 1440);
            Settings::updateSettings(
                'total_emails_created',
                Settings::selectSettings('total_emails_created') + 1
            );

            $trashmail = new TrashMail();
            $trashmail->email = $email;
            $trashmail->delete_in = $newDateTime;
            $trashmail->save();
        }

        $response  = TrashMail::allMessages($email);

        return $response;
    }

    //delete email
    public function delete()
    {
        $now = Carbon::now();

        if (Cookie::has('email')) {
            $email =  Cookie::get('email');
            $trash = TrashMail::where('email', $email)->first();
            if ($trash) {
                $trash->update([
                    'delete_in' => $now,
                ]);
            }

            Cookie::queue(Cookie::forget('email'));
        }

        return redirect(route('home'));
    }


    // delete messgae
    public function deletemessage($id)
    {

        if (Cache::has($id)) {
            Cache::forget($id);
        }
        $id = Hashids::decode($id);

        TrashMail::DeleteMessage($id[0]);

        return redirect(route('home'));
    }


    //show message
    public function show($id)
    {
        $message[] = Cache::remember($id, Settings::selectSettings("email_lifetime") * 86400, function () use ($id) {
            return TrashMail::messages($id);
        });

        return view('frontend.view')->with('message', $message[0]);
    }



    //show message content
    public function message($id)
    {
        $message[] = Cache::remember($id, Settings::selectSettings("email_lifetime") * 86400, function () use ($id) {
            return TrashMail::messages($id);
        });

        return $message[0]['content'];
    }




    // download files 
    public function download($id, $file)
    {
        $id = Hashids::decode($id);

        if (file_exists('temp/attachments/' . $id[0] . '/' . $file)) {
            return response()->download('temp/attachments/' . $id[0] . '/' . $file);
        } else {
            abort(404);
        }
    }



    public function change()
    {
        return view('frontend.change');
    }

    // create new Custom Email 
    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100|min:1|alpha_num|notIn:' . implode(',', explode(',', Settings::selectSettings('forbidden_id'))),
            'domain' => 'required|in:' . implode(',', explode(',', Settings::selectSettings('domains'))),
        ]);

        $new_email =  $request->name . "@" .  $request->domain;

        $check = TrashMail::where('email', '=', $new_email)->count();


        if ($check == 0) {

            $date = Carbon::now();
            $newDateTime = Carbon::now()->addDays(Settings::selectSettings("email_lifetime"));


            if (Cookie::has('email')) {
                $email =  Cookie::get('email');
                $trash = TrashMail::where('email', $email)->first();
                if ($trash) {
                    $trash->update([
                        'delete_in' => $date,
                    ]);
                }
                Cookie::queue(Cookie::forget('email'));
                $email = $this->generateRandomEmail();
                Cookie::queue('email', $new_email, Settings::selectSettings("email_lifetime") * 1440);

                Settings::updateSettings(
                    'total_emails_created',
                    Settings::selectSettings('total_emails_created') + 1
                );

                $trashmail = new TrashMail();
                $trashmail->email = $new_email;
                $trashmail->delete_in = $newDateTime;
                $trashmail->save();

                return redirect(route('home'));
            }
        } else {

            session()->flash('error', 'The address you have chosen is already in use. Please choose a different one.');
            return redirect(route('change'));
        }
    }
}
