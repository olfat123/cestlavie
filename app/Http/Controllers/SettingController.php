<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Presenters\CommonPresenter;
use App\Http\Resources\SettingResource;

class SettingController extends Controller
{
    /**
     * index.
     *
     * @queryParam q search in name
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $settings = Setting::query();
        if('Admin' != auth()->user()->name){
            abort(403);
        }
        // if ($this->filterQueryStrings()) {
        //     $wMessages = $this->filterData($request, $wMessages);
        // }
       // dd($wMessages->get());

        $settings = app(CommonPresenter::class)->paginate($settings->get());
        return view('pages.settings.manager.index', [
            'settings' => $settings,
            'breadcrumb' => $this->breadcrumb([], 'Settings')
        ]);
    }

     /**
     * create.
     */
    public function create()
    {
        return view('pages.settings.manager.add', [
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Settings',
                    'route' => route('setting.manager.index')
                ]
            ], 'Add New Setting'),
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
        $setting = Setting::create($request->except('cover'));
        if ($cover = $request->cover) {
            $request->validate([
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
          
            $imageName = time().'.'.$request->cover->extension();  
           
            $request->cover->move('setting', $imageName);
            $setting->update(['cover'=> asset('setting').'/'.$imageName]);
        }
        //$wMessage = WeeklyMessage::create($request->except('cover'));
        
        return $this->returnCrudData(__('system_messages.common.create_success'), route('setting.manager.index'));
    }

    /**
     * edit.
     *
     * @param mixed $setting
     * @return Factory|View
     */
    public function edit($setting)
    {
        $setting = Setting::findOrFail($setting);
        return view('pages.settings.manager.edit', [
            'setting' => $setting,   
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Settings',
                    'route' => route('setting.manager.index')
                ]
            ], 'Edit Setting'),
        ]);
    }

    /**
     * update.
     *
     * @param mixed $setting
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function update($setting, Request $request)
    {
        $setting = Setting::findOrFail($setting);
        $setting->update($request->except('cover'));
        if ($cover = $request->cover) {
            $request->validate([
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
          
            $imageName = time().'.'.$request->cover->extension();  
           
            $request->cover->move('setting', $imageName);
            $setting->update(['cover'=> asset('setting').'/'.$imageName]);
        }
        return $this->returnCrudData(__('system_messages.common.update_success'), $request->redirect_to);
    }

    public function apiIndex(){
        $settings = Setting::query()->get();
        return SettingResource::collection($settings);
    }
}
