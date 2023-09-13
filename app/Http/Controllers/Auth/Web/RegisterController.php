<?php

namespace App\Http\Controllers\Auth\Web;

use App\Models\User;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\UserStore;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        $page_title = '';
        // switch ($request->type) {
        //     case 'customer':
        //         $page_title = __('auth.join_as_spotter');
        //         break;
        //     case 'provider':
        //         $page_title = __('auth.join_as_partner');
        //         break;
        //     default:
        //         abort(404);
        // }
        // Cookie::queue('type',$request->type,10);
        abort('404');

        return view('auth.register',
            [
                'type' => 'host',
                'page_title' => $page_title,
                'breadcrumb' => $this->breadcrumb([], $page_title, 0),
            ]);
    }

    public function showAdminRegisterForm(){
        return view('auth.admin_register',
            [
                'type' => 'host',
                'childCategories' => Category::lastLevel()->get()->sortBy('name'),
                'page_title' => 'Host Registration',
                'breadcrumb' => $this->breadcrumb([], 'Host Registration', 0),
            ]);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $data = $request->except(['logo', 'social','cover','categories']);
        if ($request->social) {
            $data['email_verified_at'] = now();
        }
        $user = User::create($data);
        if ($categories = $request->categories) {
            $user->categories()->sync($categories);
        }
        if ($cover = $request->cover) {
            $request->validate([
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]); 
            $imageName = time() .'_' . $request->name . '.' .$request->cover->extension();  
            $path = $request->file('cover')->storeAs(
                'hosts/cover',
                $imageName,
                's3'
            );
            Image::create([
                'title'=>$request->name,
                'image'=>$path
            ]);
            $request->cover->move('hosts/cover', $imageName);
            $user->update(['cover'=> 'hosts/cover/'.$imageName]);
        }
        if ($logo = $request->logo) {
            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]); 
            $imageName = time() .'_' . $request->name . '.' .$request->logo->extension();  
            $path = $request->file('logo')->storeAs(
                'hosts/logo',
                $imageName,
                's3'
            );
            Image::create([
                'title'=>$request->name,
                'image'=>$path
            ]);
            $request->logo->move('hosts/logo', $imageName);
            $user->update(['logo'=> 'hosts/logo/'.$imageName]);
        }
        $user->update(['status_id'=> 2]);
        $user->assignRole('vendor');
        $user->sendEmailVerificationNotification();

        //event(new Registered($user));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, app(UserStore::class)->rules());
    }

    /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     *
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $url = route('verification.notice');
        if ($user->hasCompleteVerification())
            $url = route('user.dashboard');
        return $this->returnCrudData(__('system_messages.auth.register_success'), $url);
    }
}
