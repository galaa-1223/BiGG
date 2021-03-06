<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequestBiGG;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\BiGG;

use Auth;

class BiGGAuthController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/bigg/login';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function biggGet()
    {
        return redirect(url('bigg/login'));
    }

    public function biggGetLogin()
    {
        return view('bigg.login.main', [
            'layout' => 'login'
        ]);
    }

    public function BiGGLogin(LoginRequestBiGG $request)
    {
        
        if (Auth::guard('bigg')->attempt([
                'email' => $request->email, 
                'password' => $request->password
            ]))
        {
            $user = Auth::guard('bigg')->user();
            
        } else {
            throw new \Exception('Wrong email or password.');
        }
    }

    public function biggLogout()
    {
        Auth::guard('bigg')->logout();   
        return redirect(url('bigg/login'));
    }
}