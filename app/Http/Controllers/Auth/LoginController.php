<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * method redirectTo for redirect after auth
     * @return route
     */
    public function redirectTo()
    {
        $role = auth()->user()->roles()->first();
        $for = [
            'admin' => 'admin',
            'ki'  => 'ki',
            'client'  => 'client',
        ];
        return $this->redirectTo = route($for[$role->slug]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'phone';
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ],
        [
            'phone.required' => 'Поле Телефон должно быть заполнено',
            'phone.string' => 'Поле Телефон должно быть строчного типа',
            'password.required' => 'Поле Пароль должно быть заполнено',
            'password.string' => 'Поле Пароль должно быть строчного типа',
        ]);
    }
}
