<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PersonalInformation;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $this->validator($request->all());

        $saveUser = new User();
        $saveUser->name = $request->name;
        $saveUser->email = $request->email;
        $saveUser->no_telp = $request->phone;
        $saveUser->password = Hash::make($request->password);
        $status = $saveUser->save();

        if($status == false ){
            Session::flash('failed', 'failed to register, somethin wrong with system');
            return redirect()->back();
        }

        $savePersonalUser = new PersonalInformation();
        $savePersonalUser->user_id = $saveUser->id;
        $statusSavePersonal = $savePersonalUser->save();

        if($statusSavePersonal == false){
            Session::flash('failed', 'failed create personal user');
            return redirect()->back();
        }

        Session::flash('success', 'Register Success, you can login using that account');
        return redirect()->route('login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
