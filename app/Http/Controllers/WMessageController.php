<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\WeeklyMessage;
use App\Presenters\CommonPresenter;
use App\Http\Controllers\Traits\Filtration;

class WMessageController extends Controller
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
        $wMessages = WeeklyMessage::query();
        if ($this->filterQueryStrings()) {
            $wMessages = $this->filterData($request, $wMessages);
        }
       // dd($wMessages->get());

        $wMessages = app(CommonPresenter::class)->paginate($wMessages->get());
        return view('pages.wMessages.manager.index', [
            'wMessages' => $wMessages,
            'breadcrumb' => $this->breadcrumb([], 'Messages')
        ]);
    }

    /**
     * create.
     */
    public function create()
    {
        return view('pages.wMessages.manager.add', [
            'countries' => Country::all(),
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Messages',
                    'route' => route('wMessage.manager.index')
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
        $arr= preg_split("/\r\n|\n|\r/", $request->message);
        $data = $request->except('message');
        $i = 0;
        foreach($arr as $message){
            $data['message'] = $message;
            $data['order'] = $i;
            WeeklyMessage::create($data);
            $i++;
        }
        //$wMessage = WeeklyMessage::create($request->except('cover'));
        
        return $this->returnCrudData(__('system_messages.common.create_success'), route('wMessage.manager.index'));
    }

    /**
     * edit.
     *
     * @param mixed $wMessage
     * @return Factory|View
     */
    public function edit($wMessage)
    {
        $wMessage = WeeklyMessage::findOrFail($wMessage);
        return view('pages.wMessages.manager.edit', [
            'wMessage' => $wMessage,   
            'countries' => Country::all(),        
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Messages',
                    'route' => route('wMessage.manager.index')
                ]
            ], 'Edit Message'),
        ]);
    }

    /**
     * update.
     *
     * @param mixed $wMessage
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function update($wMessage, Request $request)
    {
        $wMessage = WeeklyMessage::findOrFail($wMessage);
        $wMessage->update([
            'message' => $request->wMessage
        ]);
        
        return $this->returnCrudData(__('system_messages.common.update_success'), $request->redirect_to);
    }

    /**
     * delete.
     *
     * @param $wMessages
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy( $wMessages, Request $request)
    {
        $wMessages = WeeklyMessage::findOrFail($wMessages);
        $wMessages->delete();
        return $this->returnCrudData(__('system_messages.common.delete_success'), $request->redirect_to ?: url()->previous());
    }
}
