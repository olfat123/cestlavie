<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Country;
use App\Models\WeeklyVerse;
use Illuminate\Http\Request;
use App\Presenters\CommonPresenter;
use App\Http\Controllers\Traits\Filtration;

class WVerseController extends Controller
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
        $wVerses = WeeklyVerse::query();
        if ($this->filterQueryStrings()) {
            $wVerses = $this->filterData($request, $wVerses);
        }
        //dd($wVerses->get());

        $wVerses = app(CommonPresenter::class)->paginate($wVerses->get());
        return view('pages.wverses.manager.index', [
            'wVerses' => $wVerses,
            'breadcrumb' => $this->breadcrumb([], 'Verses')
        ]);
    }

    /**
     * create.
     */
    public function create()
    {
        return view('pages.wverses.manager.add', [
            'countries' => Country::all(),
            'days' => Carbon::getDays(),
            'hours' => $this->hoursList(), 
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Verses',
                    'route' => route('wVerse.manager.index')
                ]
            ], 'Add New Verse'),
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
        $arr= preg_split("/\r\n|\n|\r/", $request->verse);
        $data = $request->except('verse');
        $i = 0;
        foreach($arr as $verse){
            $data['verse'] = $verse;
            $data['order'] = $i;
            WeeklyVerse::create($data);
            $i++;
        }
       // $wVerse = WeeklyVerse::create($request->except('cover'));
        
        return $this->returnCrudData(__('system_messages.common.create_success'), route('wVerse.manager.index'));
    }

    /**
     * edit.
     *
     * @param mixed $wVerses
     * @return Factory|View
     */
    public function edit($wVerses)
    {
        $wVerse = WeeklyVerse::findOrFail($wVerses);
        return view('pages.wverses.manager.edit', [
            'wVerse' => $wVerse,
            'countries' => Country::all(),
            'days' => Carbon::getDays(),
            'hours' => $this->hoursList(), 
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Countries',
                    'route' => route('wVerse.manager.index')
                ]
            ], 'Edit Verse'),
        ]);
    }

    /**
     * update.
     *
     * @param mixed $wVerses
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function update($wVerses, Request $request)
    {
        $wVerses = WeeklyVerse::findOrFail($wVerses);
        $wVerses->update([
            'wVerses' => $request->wVerses
        ]);
        
        return $this->returnCrudData(__('system_messages.common.update_success'), $request->redirect_to);
    }

    /**
     * delete.
     *
     * @param $wVerses
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy( $wVerses, Request $request)
    {
        $wVerses = WeeklyVerse::findOrFail($wVerses);
        $wVerses->delete();
        return $this->returnCrudData(__('system_messages.common.delete_success'), $request->redirect_to ?: url()->previous());
    }
}
