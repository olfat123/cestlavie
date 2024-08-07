<?php

namespace App\Jobs;

use ExpoSDK\Expo;
use Carbon\Carbon;
use App\Models\Token;
use App\Models\Country;
use ExpoSDK\ExpoMessage;
use App\Models\WeeklyVerse;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendWeeklyVerse implements ShouldQueue
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
        $channel = 'weekly-verse';
        foreach($countries as $country){
            $verse = WeeklyVerse::query()
                ->where(function ($query) use ($country) {
                    $query->where('country_id', $country)
                        ->orWhere('country_id', 1);
                })
                ->whereNull('sent_at')
                ->first();
            if($verse){
                $currentDayName = Carbon::now()->format('l');
                $currentHour = Carbon::now()->format('H');
                if($verse->day_to_send == $currentDayName 
                    && $verse->hour_to_send <= $currentHour){
                    $tokens = Token::where('country_id',$country)->pluck('token')->toArray();
                    if($tokens){
                        $expo->subscribe($channel, $tokens);
            
                        /**
                         * Create messages fluently and/or pass attributes to the constructor
                         */
                        $message_to_send = (new ExpoMessage([
                            'title' => 'آية اليوم',
                            'body' => $verse->verse,
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
                        $verse->update(['sent_at'=>now()]);
                    }
                }
            }
        }
    }
}
