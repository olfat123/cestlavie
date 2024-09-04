<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Presenters\CountryPresenter;
use App\Http\Controllers\Traits\Filtration;

class CountryController extends Controller
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
        if('Admin' != auth()->user()->name){
            abort(403);
        }
        $countries = Country::query();
        if ($this->filterQueryStrings()) {
            $countries = $this->filterData($request, $countries);
        }
        //dd($countries->get());

        $countries = app(CountryPresenter::class)->paginate($countries->get());
        return view('pages.countries.manager.index', [
            'countries' => $countries,
            'tokens_count' => Token::count(),
            'breadcrumb' => $this->breadcrumb([], 'Countries')
        ]);
    }

    /**
     * create.
     */
    public function create()
    {
        if('Admin' != auth()->user()->name){
            abort(403);
        }
        return view('pages.countries.manager.add', [
            'countries' => Country::all(),
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Countries',
                    'route' => route('country.manager.index')
                ]
            ], 'Add New Country'),
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
        $country = Country::create($request->except('cover'));
        
        return $this->returnCrudData(__('system_messages.common.create_success'), route('country.manager.index'));
    }

    /**
     * edit.
     *
     * @param mixed $country
     * @return Factory|View
     */
    public function edit($country)
    {
        if('Admin' != auth()->user()->name){
            abort(403);
        }
        $country = Country::findOrFail($country);
        return view('pages.countries.manager.edit', [
            'country' => $country,
            
            'breadcrumb' => $this->breadcrumb([
                [
                    'title' => 'Countries',
                    'route' => route('country.manager.index')
                ]
            ], 'Edit country'),
        ]);
    }

    /**
     * update.
     *
     * @param mixed $country
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function update($country, Request $request)
    {
        $country = Country::findOrFail($country);
        $country->update([
            'country' => $request->country
        ]);
        
        return $this->returnCrudData(__('system_messages.common.update_success'), $request->redirect_to);
    }

    /**
     * delete.
     *
     * @param $country
     * @param Request $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy( $country, Request $request)
    {
        $country = Country::findOrFail($country);
        $country->delete();
        return $this->returnCrudData(__('system_messages.common.delete_success'), $request->redirect_to ?: url()->previous());
    }
}
