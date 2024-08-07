<?php

namespace App\Http\Controllers;

use ExpoSDK\Expo;
use Carbon\Carbon;
use App\Models\Token;
use App\Models\Country;
use ExpoSDK\ExpoMessage;
use Illuminate\Http\Request;
use App\Models\ManualMessage;
use App\Presenters\CommonPresenter;
use App\Http\Controllers\Traits\Filtration;

class ManualMessageController extends Controller
{
    use Filtration;
    /**
     * index.
     *
     * @queryParam q search in name
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $messages = ManualMessage::query();
        if ($this->filterQueryStrings()) {
            $messages = $this->filterData($request, $messages);
        }
        //dd($messages->get());

        $messages = app(CommonPresenter::class)->paginate($messages->get());
        return view('pages.manualMessages.manager.index', [
            'messages' => $messages,
            'breadcrumb' => $this->breadcrumb([], 'Manual Message')
        ]);
    }

    /**
     * create.
     */
    public function create()
    {
        return view('pages.manualMessages.manager.add', [
            'events' => ManualMessage::all(),
            'countries' => Country::all(),
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Manual Messages',
                    'route' => route('manualMessage.manager.index')
                ]
            ], 'Add New Message'),
        ]);
    }

    /**
     * store.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $message = ManualMessage::create($request->except('cover'));
        $expo = Expo::driver('file');
        $channel = 'news-letter';
        $date = Carbon::createFromFormat('d-m-Y', '02-07-2024');

        if($message->country_id == 1){
            $tokens = Token::query()->where('created_at','>',$date)->pluck('token')->toArray();
        }else{
            $tokens = Token::where('country_id',$message->country_id)->where('created_at','>',$date)->pluck('token')->toArray();
        }        
        if($tokens){
            //$expo->subscribe($channel, $tokens);

            /**
             * Create messages fluently and/or pass attributes to the constructor
             */
            $message_to_send = (new ExpoMessage([
                'title' => $message->title,
                'body' => $message->message,
            ]))
                ->setData(['id' => 1])
                ->setChannelId('default')
                ->playSound();

           // (new Expo)->send($message_to_send)->to($tokens)->push();

            $response = $expo->send($message_to_send)->to($tokens)->push();

            // $response = (new Expo)->send($message)->to($defaultRecipients)->push();
            //$data = $response->getData();
            $message->update(['sent_at'=>now()]);
        }
        return $this->returnCrudData('Added successfully',null,'success');
    }

    /**
     * edit.
     *
     * @param mixed $message
     * @return Factory|View
     */
    public function edit($message)
    {
        $message = ManualMessage::findOrFail($message);
        return view('pages.manualMessages.manager.edit', [
            'message' => $message,
            'countries' => Country::all(),
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Manual Messages',
                    'route' => route('manualMessage.manager.index')
                ]
            ], 'Edit Message'),
        ]);
    }

    /**
     * update.
     *
     * @param mixed $message
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function update( $message, Request $request)
    {
        $message = ManualMessage::findOrFail($message);
        $message->update($request->except('redirect_to'));
        
        return $this->returnCrudData(__('system_messages.common.update_success'), $request->redirect_to);
    }

    /**
     * delete.
     *
     * @param  $message
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy( $message, Request $request)
    {
        $message = ManualMessage::findOrFail($message);
        $message->delete();
        return $this->returnCrudData(__('system_messages.common.delete_success'), $request->redirect_to ?: url()->previous());
    }

}
