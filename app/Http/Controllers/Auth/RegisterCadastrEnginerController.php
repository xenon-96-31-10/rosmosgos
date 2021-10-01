<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Notifications\NewUser;

class RegisterCadastrEnginerController extends Controller
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
        $this->middleware('guest');
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
            'phone' => ['required', 'string', 'max:11', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $pass = random_int(100000, 999999);
        event(new Registered($user = $this->create($request->all(), $pass)));

        $user->notify(new NewUser($pass));

        $this->guard()->login($user);
        $ki = Role::where('slug','ki')->first();
        $watch = Permission::where('slug','only-watch')->first();
        $user->roles()->attach($ki);
        $user->permissions()->attach($watch);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data, $pass)
    {
        $hashed_random_password = Hash::make($pass);

        return User::create([
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($hashed_random_password),
        ]);
    }


}
