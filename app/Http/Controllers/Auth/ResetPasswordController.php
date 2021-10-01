<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\Notifications\NewPassword;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    public function showResetForm(){
        return view('auth.passwords.reset');
    }


     public function update(Request $request){
       $pass = random_int(100000, 999999);
       $hashed_random_password = Hash::make($pass);
       if(!User::wherePhone($request->phone)->exists()){
         return redirect()->back()->withErrors(['phone' => 'Такого пользователя не существует']);
       }else{
         $user = User::where('phone', $request->phone)->first();
         $user->password = $hashed_random_password;
         $user->save();
         $user->notify(new NewPassword($pass));
         return redirect()->route('login')->with(['success' => 'Ваш пароль изменен и отправлен на Ваш номер телефона, войдете в систему']);
       }
     }



    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
