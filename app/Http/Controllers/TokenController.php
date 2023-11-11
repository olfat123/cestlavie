<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Traits\Filtration;
use App\Models\Country;
use App\Models\Token;
use PHPUnit\Framework\Constraint\Count;

class TokenController extends Controller
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
        $tokens = Token::query();
        if ($this->filterQueryStrings()) {
            $tokens = $this->filterData($request, $tokens);
        }

        $tokens = app(CommonPresenter::class)->paginate($tokens->get());
        return view('pages.tokens.manager.index', [
            'tokens' => $tokens,
            'breadcrumb' => $this->breadcrumb([], 'Tokens')
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
        $request->validate([
            'token' => 'required',
            'country'=> 'required'
        ]);
        $data = $request->except('country');
        $country = Country::firstWhere('country',$request->country);
        if(!$country){
           $country = Country::create(['country'=> $request->country]); 
        }

        $data['country_id'] = $country->id;
        $token = Token::firstWhere('token',$request->token);
        if(!$token){
            $token = Token::create($data);
        }else{
            $token->update(['updated_at'=>now()]);
        }
        
        return $this->returnCrudData(__('system_messages.common.create_success'), '');
    }

}
