<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Default redirect (tidak lagi digunakan)

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        return $this->redirectBasedOnRole($user);
    }

    /**
    * Redirect user berdasarkan role
    */
    private function redirectBasedOnRole($user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'tamu') {
            return redirect()->route('tamu.dashboard');
      }

        return $this->defaultRedirect();
   }

    /**
    * Redirect default jika role tidak ditemukan
    */
    private function defaultRedirect()
    {
        return redirect('/home');
    }
}
