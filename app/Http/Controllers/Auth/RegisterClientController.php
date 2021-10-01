<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Order;
use App\Models\Realty;
use App\Models\Rosreestrinfo;
use Illuminate\Auth\Events\Registered;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Notifications\NewUser;

class RegisterClientController extends Controller
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
            'register_phone' => ['required', 'string', 'size:11', 'unique:users,phone'],
            'register_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email']
        ],
        [
            'register_phone.required' => 'Поле Телефон должно быть заполнено',
            'register_phone.string' => 'Поле Телефон должно быть строчного типа',
            'register_phone.unique' => 'Пользователь с таким телефоном уже есть',
            'register_phone.size' => 'Введите 11 цифр',
            'register_email.required' => 'Поле Email должно быть заполнено',
            'register_email.string' => 'Поле Email должно быть строчного типа',
            'register_email.unique' => 'Пользователь с таким email уже есть',
        ],
        [
        'register_phone' => 'phone',
        'register_email' => 'email',
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
        $client = Role::where('slug','client')->first();
        $user->roles()->attach($client);

        if($request->type == 'realty'){
          $data = session('realtyData');
          if(session()->has('responseApi')){
            $obj = session('responseApi');
          }else{
            $obj = session('phoneticApi');
          }
          $rosreestr = $this->fullrosreestrsearch($data);
          $realty = $this->createRealty($data);
          $order= $this->createOrder($data, $obj);

          $order->data()->associate($realty);
        }else if($request->type == 'geo'){
          $data = session('geoData');
          if(session()->has('responseApi')){
            $obj = session('responseApi');
          }else{
            $obj = session('phoneticApi');
          }
          $rosreestr = $this->fullrosreestrsearch($data);
          $geo = $this->createGeo($data);
          $order= $this->createOrder($data, $obj);

          $order->data()->associate($geo);
        }else if($request->type == 'plot'){
          $data = session('plotData');
          if(session()->has('responseApi')){
            $obj = session('responseApi');
          }else{
            $obj = session('phoneticApi');
          }
          $rosreestr = $this->fullrosreestrsearch($data);
          $plot = $this->createPlot($data);
          $order= $this->createOrder($data, $obj);

          $order->data()->associate($plot);
        }

        $user->orders()->save($order);
        $rosreestr->order()->associate($order)->save();

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
            'phone' => $data['register_phone'],
            'email' => $data['register_email'],
            'password' => $hashed_random_password,
        ]);

    }


}
