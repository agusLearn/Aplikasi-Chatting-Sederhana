<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);


        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {

            $updateStatusActive = User::where('id', Auth::user()->id)->first();
            $updateStatusActive->status_active = 1;
            $updateStatusActive->save();
            return redirect()->route('appChat');
        }

        Session::flash('failed', 'Your Account Not Registered');
        return redirect()->back();
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    public function logout(Request $request)
    {
        $updateStatusActive = User::where('id', Auth::user()->id)->first();
        $updateStatusActive->status_active = 0;

        $statusUpdate = $updateStatusActive->save();
        if ($statusUpdate == true) {
            Auth::logout();
            return redirect()->route('login');
        }
    }
}
