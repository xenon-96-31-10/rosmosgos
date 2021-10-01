<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bio;
use App\Models\Biopas;
use App\Models\Biocom;
use Illuminate\Support\Facades\Validator;
use \PhpOffice\PhpWord\TemplateProcessor,
    \PhpOffice\PhpWord\Shared\Html,
    \PhpOffice\PhpWord\PhpWord;

class ClientController extends Controller
{
  public function showIndex(){
    $user = auth()->user();
    $orders = $user->orders()->orderBy('created_at', 'desc')->get();
    if(isset($user->bio)){
      $bio = $user->bio;
    }else{
      $bio ="null";
    }
    //dd($bio);
    return view('client.client', compact('orders', 'bio'));
  }

  public function showPay(){
    $user = auth()->user();
    $orders = $user->orders()->orderBy('created_at', 'desc')->get();
    if(isset($user->bio)){
      $bio = $user->bio;
    }else{
      $bio ="null";
    }
    //dd($bio);
    return view('client.pay', compact('orders', 'bio'));
  }

  public function showDocs(){
    $user = auth()->user();
    $orders = $user->orders;
    if(isset($user->bio)){
      $bio = $user->bio;
    }else{
      $bio ="null";
    }
    $directory = 'public/users/'.$user->id.'/docs';
    $files = Storage::files($directory);
    //dd($files);
    return view('client.docs', compact('orders', 'bio','files'));
  }

  public function showPersonality(){
    $user = auth()->user();
    $orders = $user->orders;
    if(isset($user->bio)){
      $bio = $user->bio;
      $data =   $bio->data;
      $pass = explode(' ', $data->pass);
      return view('client.personality', compact('orders','bio', 'data', 'pass'));
    }else{
      $bio ="null";
      return view('client.personality', compact('orders','bio'));
    }
    //dd($bio);

  }

  public function saveBio(Request $request){
    $user = auth()->user();
    $orders = $user->orders;
    //dd($request->all());
    $this->validator($request->all())->validate();

    $data = $request->all();

    if($data['type'] == 'biopas'){
      $bio = new Bio;

      $bio->familia = $data['familia'];
      $bio->name = $data['name'];
      $bio->lastname = $data['lastname'];

      $directory = 'public/users/'.$user->id.'/docs';
      Storage::makeDirectory($directory);

      if(isset($data['scanpass'])){
        $file = $request->file('scanpass');
        $filename = "скан_паспорта.";
        $filename .= $file->getClientOriginalExtension();
        $path = Storage::putFileAs('public/users/'.$user->id.'/docs', $file, $filename);
        $scanpass = 'Загружен';
      }else{
        $scanpass = 'Нет';
      }


      $biopas = new Biopas;

      $biopas->snils = $data['snils'];
      $biopas->pass = $data['pass-seria'];
      $biopas->pass .= " ";
      $biopas->pass .= $data['pass-nomer'];
      $biopas->codepass = $data['codepass'];
      $biopas->kempass = $data['kempass'];
      $biopas->datepass = $data['datepass'];
      $biopas->datebirth = $data['datebirth'];
      $biopas->scanpass = $scanpass;
      $biopas->save();

      $bio->data()->associate($biopas);
      $user->bio()->save($bio);

      $response = $this->createDogovor();


      $data =   $bio->data;
      $pass = explode(' ', $data->pass);
      return view('client.personality', compact('user','orders','bio', 'data', 'pass', 'response'));
    }else{
      $bio = new Bio;

      $bio->familia = $data['fizsurnamec'];
      $bio->name = $data['fiznamec'];
      $bio->lastname = $data['fizlastnamec'];


      if(isset($data['scandov'])){
        $file = $request->file('scandov');
        $filename = "скан_доверенности.";
        $filename .= $file->getClientOriginalExtension();
        $path = Storage::putFileAs('public/users/'.$user->id.'/docs', $file, $filename);
        $scandov = 'Загружен';
      }else{
        $scandov = 'Нет';
      }


      $biocom = new Biocom;

      $biocom->inn = $data['inncom'];
      $biocom->bank = $data['namebank'];
      $biocom->bill = $data['bil'];
      $biocom->numdov = $data['numberdov'];
      $biocom->datedov = $data['datedov'];
      $biocom->scandov = $scandov;
      $biocom->save();

      $bio->data()->associate($biocom);
      $user->bio()->save($bio);

      $response = $this->createDogovor();


      $data =   $bio->data;

      return view('client.personality', compact('user','orders','bio', 'data', 'response'));
    }
  }

  protected function createDogovor(){
    $user = auth()->user();
    $bio = $user->bio;
    $order = $user->orders()->firstWhere('status', 'Поиск исполнителя');
    $doc = new TemplateProcessor(storage_path('app/public/docs/templatedogovor.docx'));
    $doc->setValue('number', $order->id);
    $doc->setValue('region', $order->region);
    $doc->setValue('familia', $bio->familia);
    $doc->setValue('cost', $order->cost);
    $doc->saveAs(storage_path('app/public/users/'.$user->id.'/docs/dogovor.docx'));
    return 'OK';
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    if($data["type"] == 'biopas'){
      $validator = Validator::make($data, [
          'familia' => ['required', 'string', 'alpha'],
          'name' => ['required', 'string', 'alpha'],
          'lastname' => ['required', 'string', 'alpha'],
      ],
      [
          'familia.required' => 'Фамилия должна быть заполнена',
          'familia.string' => 'Фамилия должна быть строчного типа',
          'familia.alpha' => 'Фамилия должна быть из букв',
          'name.required' => 'Имя должно быть заполнено',
          'name.string' => 'Имя должно быть строчного типа',
          'name.alpha' => 'Имя должно быть из букв',
          'lastname.required' => 'Отчество должно быть заполнено',
          'lastname.string' => 'Отчество должно быть строчного типа',
          'lastname.alpha' => 'Отчество должно быть из букв',
      ],
    );
  }
  if($data["type"] == 'biocom'){
      $validator = Validator::make($data, [
          'inncom' => ['required', 'string'],
          'namebank' => ['required', 'string'],
          'fizsurnamec' => ['required', 'string', 'alpha'],
          'fiznamec' => ['required', 'string', 'alpha'],
          'fizlastnamec' => [ 'string', 'alpha'],
          'bil' => ['required', 'numeric'],
          'numberdov' => ['required', 'numeric'],
      ],
      [
          'inncom.required' => 'Поле ИНН должно быть заполнено',
          'inncom.string' => 'Поле ИНН должно быть строчного типа',
          'namebank.required' => 'Название банка должно быть заполнено',
          'fizsurnamec.required' => 'Фамилия должна быть заполнена',
          'fizsurnamec.string' => 'Фамилия должна быть строчного типа',
          'fizsurnamec.alpha' => 'Фамилия должна быть из букв',
          'fiznamec.required' => 'Имя должно быть заполнено',
          'fiznamec.string' => 'Имя должно быть строчного типа',
          'fiznamec.alpha' => 'Имя должно быть из букв',
          'fizlastnamec.required' => 'Отчество должно быть заполнено',
          'fizlastnamec.string' => 'Отчество должно быть строчного типа',
          'fizlastnamec.alpha' => 'Отчество должно быть из букв',
          'bil.required' => '№ рассчетного счета должен быть заполнен',
          'bil.numeric' => '№ рассчетного счета должен быть числом',
          'numberdov.required' => '№ доверенности должен быть заполнен',
          'numberdov.numeric' => '№ доверенности должен быть числом',
      ],
    );
  }

  return $validator;
  }

}
