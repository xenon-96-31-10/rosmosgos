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
use App\Models\Price;
use App\Models\Realty;
use App\Models\Quote;
use App\Models\Refuse;
use App\Models\Bio;
use App\Models\Bioki;
use \PhpOffice\PhpWord\TemplateProcessor,
    \PhpOffice\PhpWord\Shared\Html,
    \PhpOffice\PhpWord\PhpWord;

class AdminController extends Controller
{
  public function showIndex(){
    $user = auth()->user();
    $bio = $user->bio;
    $execution = Execution::all();
    $orders = Order::all();
    $type_title = 'Все заказы на сайте';
    //$orders = Order::orderBy('created_at', 'desc')->get();
    // $orders = Order::all();
    // dd($orders);
    // $ow = Permission::find(2);
    // dd($ow->enginers()->get());
    return view('admin.admin', compact('bio', 'orders', 'type_title'));
  }

  public function showOrders($type){
    $user = auth()->user();
    $bio = $user->bio;
    if($type == 'realty'){
      $orders = Order::where('data_type','App\Models\Realty')->get();
      $type_title = 'Оформление построек';
    }elseif($type == 'geo'){
      $orders = Order::where('data_type','App\Models\Geo')->get();
      $type_title = 'Геодезические работы';
    }elseif($type == 'plot'){
      $orders = Order::where('data_type','App\Models\Plot')->get();
      $type_title = 'Оформление земельных участков';
    }else{
      $orders = Order::where('status','!=','Поиск исполнителя')->where('status','!=','Закрыт')->get();
      $type_title = 'В работе';
    }
    return view('admin.admin', compact('bio', 'orders', 'type_title'));
  }

  public function showOrder($id){
    $user = auth()->user();
    $bio = $user->bio;

    $order = Order::findorFail($id);

    $info = $order->data()->first();
    $data = explode('|', $info->services);

    $client = $order->user()->first();
    $directory = 'public/users/'.$client->id.'/docs';
    $client_files = Storage::files($directory);
    $order_files = Storage::files('public/users/'.$client->id.'/'.$order->id.'');

    return view('admin.order', compact('order', 'data', 'info','client_files', 'order_files'));
  }

  public function showFinance(){
    $user = auth()->user();
    $bio = $user->bio;
    $execution = Execution::all();
    $finance = $this->finance();
    //$orders = Order::orderBy('created_at', 'desc')->get();
    // $orders = Order::all();
    // dd($orders);
    // $ow = Permission::find(2);
    // dd($ow->enginers()->get());
    return view('admin.finance', compact('bio', 'finance'));
  }

  public function showPrice($type){
    $user = auth()->user();
    $bio = $user->bio;
    $prices = Price::where('type',$type)->get();
    if($type == 'realty'){
      $type_title ="Оформление построек";
    }elseif($type == 'geo'){
      $type_title ="Геодезические работы";
    }elseif($type == 'plot'){
      $type_title ="Оформление земельных участков";
    }else{
      $type_title ="Оформление построек";
    }
    return view('admin.price', compact('bio', 'prices', 'type_title', 'type'));
  }

  public function updatePrice(Request $request, $type){
    $user = auth()->user();
    $bio = $user->bio;
    $data = $request->all();
    $price = Price::findorFail($data['id']);
    $price->price1 = $data['price1'];
    $price->price2 = $data['price2'];
    $price->price3 = $data['price3'];
    $price->percent = $data['percent'];
    $price->save();

    $prices = Price::where('type',$type)->get();
    if($type == 'realty'){
      $type_title ="Оформление построек";
    }elseif($type == 'geo'){
      $type_title ="Геодезические работы";
    }else{
      $type_title ="Оформление построек";
    }
    $response = 'Вы успешно обновили цену!';
    return view('admin.price', compact('bio', 'response',  'prices', 'type_title', 'type'));
  }

  public function showCalc($type, $region){
    $user = auth()->user();
    $bio = $user->bio;

    $pricelist = Price::where('type', $type)->get();

    $costs = [];
    $discounts = [];
    foreach ($pricelist as $item) {
      if($region == 'Москва'){
          $costs[$item->title] = $item->price1;
          $discounts[$item->title] = $item->price1*(100 + $item->percent)/100;
        }elseif($region == 'Московская область'){
            $costs[$item->title] = $item->price2;
            $discounts[$item->title] = $item->price2*(100 + $item->percent)/100;
          }else{
            $costs[$item->title] = $item->price3;
            $discounts[$item->title] = $item->price3*(100 + $item->percent)/100;
          }
    }

    Session(['responseApi' => ['region' => $region]]);

    return view('admin.calc', compact('bio', 'region', 'type', 'costs', 'discounts'));
  }

  public function showApp(){
    $user = auth()->user();
    $ow = Permission::findorFail(2);
    $enginers = $ow->enginers()->get();
    return view('admin.appki', compact('enginers'));
  }

  public function addApp(Request $r){
    $user = auth()->user();
    $data = $r->all();
    $ki = User::findorFail($r->id);
    $ap = Permission::findorFail(1);
    $ow = Permission::findorFail(2);
    $ki->deletePermissions([$ow->slug]);
    $ki->givePermissionsTo([$ap->slug]);
    $enginers = $ow->enginers()->get();
    $response = 'Вы успешно одобрили заявку!';
    return view('admin.appki', compact('enginers', 'response'));
  }


  protected function finance(){
    $orders = Order::all();
    $nal = Order::where('sposobpay','Оплата наличными')->get();
    $nal1 = Order::where('sposobpay','Оплата наличными')->where('statuspay','Оплачен')->where('status','Закрыт')->get();
    $nal2 = Order::where('sposobpay','Оплата наличными')->where('statuspay','Оплачен')->where('status','!=','Закрыт')->get();
    $nal3 = Order::where('sposobpay','Оплата наличными')->where('statuspay','Не оплачен')->where('status','!=','Закрыт')->get();
    $cards = Order::where('sposobpay','Оплата банковской карточкой')->get();
    $cards1 = Order::where('sposobpay','Оплата банковской карточкой')->where('statuspay','Оплачен')->where('status','Закрыт')->get();
    $cards2 = Order::where('sposobpay','Оплата банковской карточкой')->where('statuspay','Оплачен')->where('status','!=','Закрыт')->get();
    $cards3 = Order::where('sposobpay','Оплата банковской карточкой')->where('statuspay','Не оплачен')->where('status','!=','Закрыт')->get();
    $trans = Order::where('sposobpay','Оплата переводом')->get();
    $trans1 = Order::where('sposobpay','Оплата переводом')->where('statuspay','Оплачен')->where('status','Закрыт')->get();
    $trans2 = Order::where('sposobpay','Оплата переводом')->where('statuspay','Оплачен')->where('status','!=','Закрыт')->get();
    $trans3 = Order::where('sposobpay','Оплата переводом')->where('statuspay','Не оплачен')->where('status','!=','Закрыт')->get();

    $finance = [];

    $finance = [
      'Всего заказов' => count($orders),
      'Оплата наличными' => [
        'Всего заказов' =>count($nal),
        'Общая стоимость' => $this->calccost($nal),
        'Оплачено и выполнено' => $this->calccost($nal1),
        'Оплачено и не выполнено' => $this->calccost($nal2),
        'Не оплачено и не выполнено' => $this->calccost($nal3),
      ],
      'Оплата банковской карточкой' => [
        'Всего заказов' =>count($cards),
        'Общая стоимость' => $this->calccost($cards),
        'Оплачено и выполнено' => $this->calccost($cards1),
        'Оплачено и не выполнено' => $this->calccost($cards2),
        'Не оплачено и не выполнено' => $this->calccost($cards3),
      ],
      'Оплата переводом' => [
        'Всего заказов' =>count($trans),
        'Общая стоимость' => $this->calccost($trans),
        'Оплачено и выполнено' => $this->calccost($trans1),
        'Оплачено и не выполнено' => $this->calccost($trans2),
        'Не оплачено и не выполнено' => $this->calccost($trans3),
      ],
    ];



    return $finance;

  }

  protected function calccost(... $array){
    $cost = 0;
    foreach ($array[0] as $item) {
      $cost = $cost + $item['cost'];
    }
    return $cost;
  }
}
