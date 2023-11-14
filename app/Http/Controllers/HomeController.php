<?php

namespace App\Http\Controllers;

use ExpoSDK\Expo;
use App\Models\User;
use App\Models\Token;
use App\Models\Country;
use ExpoSDK\ExpoMessage;
use Illuminate\Http\Request;
use App\Models\WeeklyMessage;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome');
    }
    public function dashboard()
    {
        return view('pages.dashboard.index', [
            'breadcrumb' => $this->breadcrumb([], 'Dashboard', false),
            'customers_count' => User::count(),
        ]);
    }
    public function profile()
    {
        return view('pages.profile', [
            'breadcrumb' => $this->breadcrumb([], 'Edit Profile')
        ]);
    }

    public function open($token)
    {
        $token_object = Token::firstWhere('token',$token);
        $token_object::update(['last_open_at'=>now()]);
        return $this->returnCrudData('Updated Successfully');
    }

    public function testpn(){
        $countries = Country::query()->pluck('id')->toArray();
        $expo = Expo::driver('file');
        $channel = 'weekly-message';
        foreach($countries as $country){
            $message = WeeklyMessage::query()->where('country_id',$country)->whereNotNull('sent_at')->first();
            $tokens = Token::where('country_id',$country)->pluck('token')->toArray();
            if($tokens){
                $expo->subscribe($channel, $tokens);
    
                /**
                 * Create messages fluently and/or pass attributes to the constructor
                 */
                $message_to_send = (new ExpoMessage([
                    'title' => $message->title,
                    'body' => $message->message,
                ]))
                    ->setData(['id' => 1])
                    ->setChannelId('default')
                    ->setBadge(0)
                    ->playSound();
    
                $response = $expo->send($message_to_send)->toChannel($channel)->push();
    
                // $response = (new Expo)->send($message)->to($defaultRecipients)->push();
                $data = $response->getData();
                $message->update(['sent_at'=>now()]);
            }
        }
    }   
}
