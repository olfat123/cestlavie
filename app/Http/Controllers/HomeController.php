<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Token;
use App\Models\WeeklyMessage;
use Illuminate\Http\Request;
use ExpoSDK\ExpoMessage;
use ExpoSDK\Expo;


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
        $wmessage = WeeklyMessage::first();
        $expo = Expo::driver('file');
        $channel = 'news-letter';
        $recipients = [
            'ExponentPushToken[eAdfsx-WnGA:APA91bG1f2VhcHlCOG_7tzxwXOUxCljRf-6ex9SYO8rmAubkEu7m7QzTKpxGVXZWrSLrrHrrwBmXOHxuImp5I3ubR9-iyUf7CDcfgU_xQlgHHj_5OrBPO-Ixi8CIaQWRa-_SOVjYhSkT]',
        ];
        $expo->subscribe($channel, $recipients);

        /**
         * Create messages fluently and/or pass attributes to the constructor
         */
        $message = (new ExpoMessage([
            'title' => 'initial title',
            'body' => 'initial body',
        ]))
            ->setTitle('This title overrides initial title')
            ->setBody('This notification body overrides initial body')
            ->setData(['id' => 1])
            ->setChannelId('default')
            ->setBadge(0)
            ->playSound();

        $response = $expo->send($message)->toChannel($channel)->push();

        // $response = (new Expo)->send($message)->to($defaultRecipients)->push();
        $data = $response->getData();
        return $this->returnCrudData('msg',null,'success',$data);

    }   
}
