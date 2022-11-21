<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => ['required', 'max:255'],
            'password'  => ['required']
        ]);

        $validated = $validator->validated();

        if(auth()->attempt(['name' => $validated['name'], 'password' => $validated['password']])){
            $user = auth()->user();
            if($user->role == 'staf'){
                return redirect()->route('pasien.index');
            }
            if($user->role == 'admin' || $user->role == 'kepala'){
                return redirect()->route('dashboard');
            }
            if($user->role == 'perawat'){
                return redirect()->route('dashboard');
            }
            if($user->role == 'dokter'){
                return redirect()->route('dashboard');
            }
        }

        session()->flash('fail', 'username / password salah');
        return redirect()->back()->withInput();
    }
}