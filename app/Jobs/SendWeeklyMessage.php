<?php

namespace App\Jobs;

use WMessage;
use ExpoSDK\Expo;
use Carbon\Carbon;
use App\Models\Token;
use App\Models\Country;
use ExpoSDK\ExpoMessage;
use App\Models\WeeklyMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendWeeklyMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $countries = Country::query()->pluck('id')->toArray();
        $expo = Expo::driver('file');
        $channel = 'weekly-message';
        foreach($countries as $country){
            $message = WeeklyMessage::query()->where('country_id',$country)->whereNull('sent_at')->first();
            if($message){
                $currentDayName = Carbon::now()->format('l');
                $currentHour = Carbon::now()->format('H');
                if($message->day_to_send == $currentDayName 
                    && $message->hour_to_send <= $currentHour){
                    $tokens = Token::where('country_id',$country)->pluck('token')->toArray();
                    if($tokens){
                        $expo->subscribe($channel, $tokens);
            
                        /**
                         * Create messages fluently and/or pass attributes to the constructor
                         */
                        $message_to_send = (new ExpoMessage([
                            'title' => $message->title,
                            'body' => $message->message,
                            'icon' => asset('cestlavie.jpeg')
                        ]))
                            ->setData(['id' => 1])
                            ->setChannelId('default')
                            ->setBadge(0)
                            ->playSound();
            
                        //$response = $expo->send($message_to_send)->toChannel($channel)->push();
                        (new Expo)->send($message_to_send)->to($tokens)->push();

                        // $response = (new Expo)->send($message)->to($defaultRecipients)->push();
                        //$data = $response->getData();
                        $message->update(['sent_at'=>now()]);

                    }
                }
            }
        }       
    }
}
