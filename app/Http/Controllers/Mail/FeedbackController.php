<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

class FeedbackController extends Controller
{
  public function send(Request $request) {

    $this->validate($request, [
    'nameclient' => 'required|alpha',
    'phoneclient' => 'required|numeric'
    ],
    [
      'nameclient.required' => 'Напишите свое имя, с которым к Вам можно обратиться',
      'phoneclient.required' => 'Напишите свой телефон, на который можно обратиться',
      'phoneclient.numeric' => 'Напишите свой телефон цифрами'
    ]);

    $feedback = array(
        'nameclient' => $request->nameclient,
        'phoneclient' => $request->phoneclient
    );

    $toEmail = "arsen963110@mail.ru";
    Mail::to($toEmail)->send(new FeedbackMail($feedback));
    return back()->with('successsend', 'Ваше сообщение отправлено. Скоро мы свяжемся с Вами, спасибо!');
  }


}
