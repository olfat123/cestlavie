<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConfigResource;
use App\Models\Config;
use App\Models\ConfigItem;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function __construct()
    {
       // $this->middleware(['auth', 'manager_access']);
    }

    public function index()
    {
        return view('pages.config.manager.index', [
            'breadcrumb' => $this->breadcrumb([], 'Configurations'),
            'configurations' => Config::with('items')->get()->sortBy('order'),
        ]);
    }

    public function update(Request $request)
    {
        //dd($request->config);
        foreach ($request->config as $item) {
            //dd($item['items']);
            if ($configData = Config::find($item['id'])) {
                $configData->update([
                    'title' => $item['title'],
                    'order' => $item['order'],
                ]);
            }
            
            //$configData->items()->detach();
            if($configItem = ConfigItem::find($item['items']['id']))
            //dd($configItem);
            $configItem->update([
                'title' => $item['items']['title'],
                'rightIcon' => $item['items']['rightIcon'],
                'leftIcon' => $item['items']['leftIcon'],
                'color' => $item['items']['color'],
            ]);
        }
        return $this->returnCrudData('Updated Successfully');
    }

    public function apiIndex(){
        $configurations = Config::with('items')->get()->sortBy('order');
        return ConfigResource::collection($configurations);
    }
}