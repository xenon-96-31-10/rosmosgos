<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Execution;
use App\Models\Order;
use App\Models\Doc;
use App\Models\Realty;
use App\Models\Geo;
use App\Models\Plot;
use App\Models\Quote;
use App\Models\Refuse;
use App\Models\Bio;
use App\Models\Bioki;
use App\Notifications\NewStatus;
use App\Notifications\NewDoc;
use \PhpOffice\PhpWord\TemplateProcessor,
    \PhpOffice\PhpWord\Shared\Html,
    \PhpOffice\PhpWord\PhpWord;

class KiController extends Controller
{

  public function showIndex(){
    $user = auth()->user();
    if($user->hasPermission('only-watch')){
      if(isset($user->bio)){
        $bio = $user->bio;
        $bioki = $bio->data;
      }else{
        $bio ="null";
        $bioki ="null";
      }
      $response = "Ожидайте подтверждения Вашей учетной записи администратором!";
      return view('ki.confirmed', compact('bio', 'bioki','response'));
    }else{

      //$myorder = $myorders[0]->order()->first();
      //dd($myorders[0]->order()->first()->cost);
      $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
      $bio = $user->bio;
      $bioki = $bio->data;
      return view('ki.ki', compact('bio', 'bioki', 'orders'));
    }
  }

  public function showOrders($type){
    $user = auth()->user();
    if($user->hasPermission('all-permission')){
      if($type == "realty"){
        $orders = Order::where('status','Поиск исполнителя')->where('data_type', 'App\Models\Realty')->orderBy('created_at', 'desc')->get();
        $type = "по услуге  Оформление построек";
      }elseif($type == "geo"){
        $orders = Order::where('status','Поиск исполнителя')->where('data_type', 'App\Models\Geo')->orderBy('created_at', 'desc')->get();
        $type = "по услуге  Геодезические работы";
      }elseif($type == "plot"){
        $orders = Order::where('status','Поиск исполнителя')->where('data_type', 'App\Models\Plot')->orderBy('created_at', 'desc')->get();
        $type = "по услуге  Оформление земельных участков";
      }else{
        $orders = Order::where('status','Поиск исполнителя')->where('region', 'like', '%'.$type.'%')->orderBy('created_at', 'desc')->get();
        $type = "в регионе ".$type." область/город/край/республика";
      }
      $bio = $user->bio;
      $bioki = $bio->data;
      return view('ki.orders', compact('bio', 'bioki', 'orders', 'type'));
    }else{
      abort(404);
    }
  }

  public function showMyOrders(){
    $user = auth()->user();
    $bio = $user->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    if($user->hasPermission('all-permission')){
      $myorders = $user->kiorders()->get();
      $type_title = "Все мои заявки";
      return view('ki.myorders', compact('orders', 'bioki', 'myorders', 'type_title'));
    }else{
      abort(404);
    }
  }

  public function showMyOrder($id){
    $user = auth()->user();
    $bio = $user->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    $order = Order::findorFail($id);
    $info = $order->data()->first();
    $data = explode('|', $info->services);
    $client = $order->user()->first();
    $directory = 'public/users/'.$client->id.'/docs';
    $client_files = Storage::files($directory);
    $order_files = Storage::files('public/users/'.$client->id.'/'.$order->id.'');

    if($user->hasPermission('all-permission')){
      return view('ki.myorder', compact('orders','order', 'data', 'info','bioki','client_files', 'order_files'));
    }else{
      abort(404);
    }
  }

  public function makeAct(Request $request, $id){
    $ki = auth()->user();
    $order = Order::findorFail($id);
    $r = $request->all();
    $client = $order->user()->first();
    $date = Carbon::now()->format('d-m-Y');

    $doc = new TemplateProcessor(storage_path('app/public/docs/templateact.docx'));
    $doc->setValue('number', $order->id);
    $doc->setValue('region', $order->region);
    $doc->setValue('familia', $r['familia']);
    $doc->setValue('data', $date);
    Storage::makeDirectory('public/users/'.$client->id.'/'.$order->id.'/');
    $doc->saveAs(storage_path('app/public/users/'.$client->id.'/'.$order->id.'/act.docx'), '');

    $bio = $ki->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    $info = $order->data()->first();
    $data = explode('|', $info->services);
    $response = 'Акт успешно сформирован, Вы можете продолжать работу!';

    $ex = Execution::where('order_id',$id)->first();
    $ex->act = 'Создан';
    $ex->data = $date;
    $ex->save();

    $id = $order->id;
    $client->notify(new NewDoc($id));

    $directory = 'public/users/'.$client->id.'/docs';
    $client_files = Storage::files($directory);
    $order_files = Storage::files('public/users/'.$client->id.'/'.$order->id.'');

    if($ki->hasPermission('all-permission')){
      return view('ki.myorder', compact('orders','order', 'data', 'info','bioki','response', 'client_files', 'order_files'));
    }else{
      abort(404);
    }

  }

  public function LoadDoc(Request $request, $id){
    $ki = auth()->user();
    $order = Order::findorFail($id);
    $r = $request->all();
    $client = $order->user()->first();
    Storage::makeDirectory('public/users/'.$client->id.'/'.$order->id.'/');
    $file = $request->file('doc');
    $filename = $r['name'].'.';
    $filename .= $file->getClientOriginalExtension();
    $path = Storage::putFileAs('public/users/'.$client->id.'/'.$order->id , $file, $filename);
    $doc = new Doc;
    $doc->name = $r['name'];
    $doc->path = $path;
    $doc->order()->associate($order)->save();

    $bio = $ki->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    $info = $order->data()->first();
    $data = explode('|', $info->services);
    $directory = 'public/users/'.$client->id.'/docs';
    $client_files = Storage::files($directory);
    $order_files = Storage::files('public/users/'.$client->id.'/'.$order->id.'');
    $response = 'Документ загружен, Вы можете продолжать работу!';


    $id = $order->id;
    $client->notify(new NewDoc($id));

    if($ki->hasPermission('all-permission')){
      return view('ki.myorder', compact('orders','order', 'data', 'info','bioki','response', 'client_files', 'order_files'));
    }else{
      abort(404);
    }
  }

  public function createQuote(Request $request, $id){
    $ki = auth()->user();
    $r = $request->all();
    $order = Order::findorFail($id);
    $bio = $ki->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    $info = $order->data()->first();
    $data = explode('|', $info->services);
    $response = 'Заметка создана!';
    $quote = new Quote;
    $quote->text = $r['text'];
    $quote->order()->associate($order)->save();


    $client = $order->user()->first();
    $directory = 'public/users/'.$client->id.'/docs';
    $client_files = Storage::files($directory);
    $order_files = Storage::files('public/users/'.$client->id.'/'.$order->id.'');

    if($ki->hasPermission('all-permission')){
      return view('ki.myorder', compact('orders','order', 'data', 'info','bioki','response', 'client_files', 'order_files'));
    }else{
      abort(404);
    }
  }

  public function createRefuse(Request $request, $id){
    $ki = auth()->user();
    $r = $request->all();
    $order = Order::findorFail($id);
    $bio = $ki->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    $info = $order->data()->first();
    $data = explode('|', $info->services);

    $response = 'Вы отказались от заказа!';
    $refuse = new Refuse;
    $refuse->refuse = $r['refuse'];
    $refuse->order()->associate($order)->save();

    $ex = Execution::where('order_id',$id)->first();
    $ex->delete();

    $order->status = 'Поиск исполнителя';
    $order->save();

    $client = $order->user()->first();
    $id = $order->id;
    $client->notify(new NewStatus($id));

    //вызвать отправку уведомлений
    if($ki->hasPermission('all-permission')){
      $myorders = $ki->kiorders()->get();
      $type_title = "Все мои заявки";
      return view('ki.myorders', compact('orders', 'bioki', 'myorders', 'type_title', 'response'));
    }else{
      abort(404);
    }
  }

  public function arivedtoObj(Request $request, $id){
    $ki = auth()->user();
    $r = $request->all();
    $order = Order::findorFail($id);
    $bio = $ki->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    $info = $order->data()->first();
    $data = explode('|', $info->services);

    $response = 'Вы успешно изменили статус заказа, объявив о своем присутсвии на объекте!';

    $order->status = 'Исполнитель на объекте';
    $order->save();


    $client = $order->user()->first();

    $id = $order->id;
    $client->notify(new NewStatus($id));

    $directory = 'public/users/'.$client->id.'/docs';
    $client_files = Storage::files($directory);
    $order_files = Storage::files('public/users/'.$client->id.'/'.$order->id.'');

    //вызвать отправку уведомлений

    if($ki->hasPermission('all-permission')){
      return view('ki.myorder', compact('orders','order', 'data', 'info','bioki','response', 'client_files', 'order_files'));
    }else{
      abort(404);
    }
  }

  public function takePay(Request $request, $id){
    $ki = auth()->user();
    $r = $request->all();
    $order = Order::findorFail($id);
    $bio = $ki->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    $info = $order->data()->first();
    $data = explode('|', $info->services);

    $response = 'Вы успешно изменили статус оплаты заказа, приняв наличные';

    $order->statuspay = 'Оплачен';
    $order->save();

    $client = $order->user()->first();
    $directory = 'public/users/'.$client->id.'/docs';
    $client_files = Storage::files($directory);
    $order_files = Storage::files('public/users/'.$client->id.'/'.$order->id.'');

    //вызвать отправку уведомлений

    if($ki->hasPermission('all-permission')){
      return view('ki.myorder', compact('orders','order', 'data', 'info','bioki','response', 'client_files', 'order_files'));
    }else{
      abort(404);
    }
  }

  public function closeOrder(Request $request, $id){
    $ki = auth()->user();
    $r = $request->all();
    $order = Order::findorFail($id);
    $bio = $ki->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    $info = $order->data()->first();
    $data = explode('|', $info->services);

    $response = 'Поздравляем, Вы закрыли заявку!';

    $order->status = 'Закрыт';
    $order->save();

    $client = $order->user()->first();
    $id = $order->id;
    $client->notify(new NewStatus($id));

    //вызвать отправку уведомлений

    if($ki->hasPermission('all-permission')){
      $myorders = $ki->kiorders()->get();
      $type_title = "Все мои заявки";
      return view('ki.myorders', compact('orders', 'bioki', 'myorders', 'type_title', 'response'));
    }else{
      abort(404);
    }
  }



  public function showCloseOrders(){
    $user = auth()->user();
    $bio = $user->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    if($user->hasPermission('all-permission')){
      $myorders = $user->kiorders()->get();
      $type_title = "Мои закрытые заявки";
      return view('ki.mycloseorders', compact('orders', 'bioki', 'myorders', 'type_title'));
    }else{
      abort(404);
    }
  }

  public function showPersonality(){
    $user = auth()->user();
    $orders = $user->orders;
    $bio = $user->bio;
    $bioki =   $bio->data;
    return view('ki.personality', compact('orders','bio', 'bioki'));
  }

  public function saveBio(Request $request){
    $user = auth()->user();
    $this->validator($request->all())->validate();
    if(isset($user->bio)){
      $bio = $user->bio;
      $bioki = $bio->data;
      $response = "Ожидайте подтверждения Вашей учетной записи администратором!";
      return view('ki.confirmed', compact('bio', 'bioki', 'response'));
    }else{
      $data = $request->all();
      $bio = new Bio;

      $bio->familia = $data['familia'];
      $bio->name = $data['name'];
      $bio->lastname = $data['lastname'];

      $bioki = new Bioki;

      $bioki->sertificate = $data['sertificate'];
      $bioki->region = $data['region'];
      $bioki->save();

      $bio->data()->associate($bioki);
      $user->bio()->save($bio);

      $response = "Ожидайте подтверждения Вашей учетной записи администратором!";
      return view('ki.confirmed', compact('bio', 'bioki', 'response'));
    }
  }

    public function updateBio(Request $request){
      $user = auth()->user();
      $this->validator($request->all())->validate();
      $data = $request->all();
      $bio = $user->bio;

      $bio->familia = $data['familia'];
      $bio->name = $data['name'];
      $bio->lastname = $data['lastname'];
      $bio->save();

      $bioki = $bio->data;

      $bioki->sertificate = $data['sertificate'];
      $bioki->region = $data['region'];
      $bioki->save();


      $response = "Учетная запись успешно обновлена!";
      return view('ki.personality', compact('bio', 'bioki', 'response'));
  }

  public function addMyOrders(Request $request){
    $user = auth()->user();
    $data =$request->all();
    $order = Order::find($data['id']);
    $ex = new Execution;
    $ex->act = "";
    $ex->data = "";
    $ex->ki()->associate($user);
    $ex->order()->associate($order)->save();
    $order->status = "Исполнитель найден";
    $order->save();
    $response = "Заказ принят, теперь Вы можете начать работу по нему!";

    $client = $order->user()->first();
    $id = $order->id;
    $client->notify(new NewStatus($id));

    $bio = $user->bio;
    $bioki = $bio->data;
    $orders = Order::where('status','Поиск исполнителя')->orderBy('created_at', 'desc')->get();
    $myorders = $user->kiorders()->get();
    $type_title = "Все мои заявки";
    return view('ki.myorders', compact('orders', 'bioki', 'myorders', 'type_title', 'response'));
  }

  protected function validator(array $data)
  {
      $validator = Validator::make($data, [
          'familia' => ['required', 'string', 'alpha'],
          'name' => ['required', 'string', 'alpha'],
          'lastname' => ['required', 'string', 'alpha'],
          'region' => ['required', 'string', 'alpha'],
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
          'region.required' => 'Регион должен быть заполнен',
          'region.string' => 'Регион должен быть строчного типа',
          'region.alpha' => 'Регион должен быть из букв',
      ],
    );
    return $validator;
  }

}
