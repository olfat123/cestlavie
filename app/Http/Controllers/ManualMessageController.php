<?php

namespace App\Http\Controllers;

use ExpoSDK\Expo;
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
        $tokens = Token::where('country_id',$message->country_id)->pluck('token');
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
        $message::update(['sent_at'=>now()]);
        return $this->returnCrudData('msg',null,'success',$data);
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
