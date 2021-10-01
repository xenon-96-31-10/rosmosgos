<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Price;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Realty;
use App\Models\Geo;
use App\Models\Plot;
use App\Models\Rosreestrinfo;
use App\Models\Role;

class SearchobjController extends Controller
{
    //
    public function rosreestrAPI(Request $request)
    {
      $a = $request->get('datatosearchkn');

      $param = [
          'query' => "$a",
          'mode' => "normal",
          'grouped' => 0
      ];
      $params = json_encode($param);

      $curl = curl_init('https://apirosreestr.ru/api/cadaster/search');
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('POST /api/cadaster/search HTTP/1.1', 'Host: apirosreestr.ru', 'Token: KPSZ-MQPM-W4ZQ-MYSN', 'Content-Type: application/json'));
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
      $json = curl_exec($curl);
      curl_close($curl);
      $obj = json_decode($json, true);

      if($obj['found'] == 1){
        Session(['responseApi' => $obj]);
      }else {
        Session(['phoneticApi' => $obj]);
        Session()->forget('responseApi');
      }
      //
      // dd($obj['objects']['0']['CADNOMER']);
      return $obj;
    }

    public function calcItogcost(Request $request)
    {
      if(session()->has('responseApi')){
        $obj = session('responseApi');
      }else{
        $obj = session('phoneticApi');
      }
      $pricelist = Price::where('type', $request->get('type'))->get();
      $costs = [];
      $discounts = [];

      foreach ($pricelist as $item) {
        if($obj['region'] == 'Москва'){
            $costs[$item->title] = $item->price1;
            $discounts[$item->title] = $item->price1*(100 + $item->percent)/100;
          }elseif($obj['region'] == 'Московская область'){
              $costs[$item->title] = $item->price2;
              $discounts[$item->title] = $item->price2*(100 + $item->percent)/100;
            }else{
              $costs[$item->title] = $item->price3;
              $discounts[$item->title] = $item->price3*(100 + $item->percent)/100;
            }
      }


      $data = $request->get('arrayChecked');

      if($request->get('type')=='realty'){
        $sum = $this->CalcRealty($data, $costs, $discounts);
      }elseif($request->get('type')=='geo'){
        if($data != null){
          $sum = $this->CalcGeo($data, $costs, $discounts);
        }else{
          $sum['itog'] = 0;
          $sum['discount'] = 0;
        }
      }elseif($request->get('type')=='plot'){
        if($data != null){
          $sum = $this->CalcPlot($data, $costs, $discounts);
        }else{
          $sum['itog'] = 0;
          $sum['discount'] = 0;
        }
      }



      return $sum;
    }

    public function saveRealtydata(Request $request){

      Session(['realtyData' => $request->all()]);

      if(session()->has('realtyData')){
        if(Auth::check()){
          $user = Auth::user();

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
          $user->orders()->save($order);
          $rosreestr->order()->associate($order)->save();

          $response = "300";
        }else{
          $response = "200";
        }
      }else{
        $response = "500";
      }

      return $response;
    }

    public function saveGeodata(Request $request){

      Session(['geoData' => $request->all()]);

      if(session()->has('geoData')){
        if(Auth::check()){
          $user = Auth::user();

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
          $user->orders()->save($order);
          $rosreestr->order()->associate($order)->save();

          $response = "300";
        }else{
          $response = "200";
        }
      }else{
        $response = "500";
      }

      return $response;
    }

    public function savePlotdata(Request $request){

      Session(['plotData' => $request->all()]);

      if(session()->has('plotData')){
        if(Auth::check()){
          $user = Auth::user();

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
          $user->orders()->save($order);
          $rosreestr->order()->associate($order)->save();

          $response = "300";
        }else{
          $response = "200";
        }
      }else{
        $response = "500";
      }

      return $response;
    }

    protected function calcRealty(Array $data, Array $costs, Array $discounts){
      $x = 0;
      $y = 0;
      $itog = 0;
      $discount = 0;

      for ($i =0; $i<count($data);$i++){
          if(($data[$i] =='Жилой дом')){
              $x++;
          }
          if(($data[$i] =='Нежилое строение')){
              $y++;
          }
      }

      for ($i = 0; $i<count($data);$i++){
        if($data[$i]=='Госпошлина за жилой дом'){
            $itog = $itog+$x*$costs[$data[$i]];
            $discount = $discount+$x*$discounts[$data[$i]];
        }elseif($data[$i]=='Госпошлина за нежилое строение') {
                $itog = $itog + $y * $costs[$data[$i]];
                $discount = $discount+$y*$discounts[$data[$i]];
            }else{
                $itog = $itog+$costs[$data[$i]];
                $discount = $discount+$discounts[$data[$i]];
            }
      }

      $sum['itog'] = $itog;
      $sum['discount'] = $discount- $itog;

      return $sum;
    }

    protected function calcGeo(Array $data, Array $costs, Array $discounts){
      $itog = 0;
      $discount = 0;

      for ($i = 0; $i<count($data); $i++){
        if($data[$i] == 'Топографическая съемка' ){
          $pa = $costs['Топографическая съемка 20'];
          $da = $discounts['Топографическая съемка 20'];
          $pb = $costs['Топографическая съемка 100'];
          $db = $discounts['Топографическая съемка 100'];
          $pc = $costs['Топографическая съемка >100'];
          $dc = $discounts['Топографическая съемка >100'];

          if($data[$i+1] < 21){
              $itog = $itog + $pa;
              $discount = $discount+$da;
          }elseif($data[$i+1] < 101){
            $itog = $itog+$pa + ($data[$i+1]-20)*$pb;
            $discount = $discount +$da+($data[$i+1]-20)*$db;
          }else{
            $itog = $itog + $pa + 80*$pb;
            $discount = $discount + $da + 80*$db;
            $n = intdiv($data[$i+1], 100);
            $y = $data[$i+1]%100;
            $itog = $itog + $y*($pb+$pc*$n);
            $discount = $discount + $y*($db+$dc*$n);
            for($j =0; $j<$n; $j++){
              $itog = $itog + (100*$j)*($pb+$pc*($j));
              $discount = $discount + (100*$j)*($db+$dc*($j));
            }
          }
        }

        if($data[$i] == 'Вынос границ земельных участков' ){
          $pa = $costs['Вынос границ земельных участков 3'];
          $da = $discounts['Вынос границ земельных участков 3'];
          $pb = $costs['Вынос границ земельных участков 100'];
          $db = $discounts['Вынос границ земельных участков 100'];
          $pc = $costs['Вынос границ земельных участков >100'];
          $dc = $discounts['Вынос границ земельных участков >100'];

          if($data[$i+1] < 4){
              $itog = $itog + $pa;
              $discount = $discount+$da;
          }elseif($data[$i+1] < 101){
            $itog = $itog+$pa + ($data[$i+1]-3)*$pb;
            $discount = $discount +$da+($data[$i+1]-3)*$db;
          }else {
            $itog = $itog + $pa + 97*$pb + $pc*($data[$i+1]-100);
            $discount = $discount + $da + 97*$db + $dc*($data[$i+1]-100);
          }

        }

        if($data[$i] == 'Исполнительная съемка коммуникаций' ){
          $pa = $costs['Исполнительная съемка коммуникаций 100'];
          $da = $discounts['Исполнительная съемка коммуникаций 100'];
          $pb = $costs['Исполнительная съемка коммуникаций >100'];
          $db = $discounts['Исполнительная съемка коммуникаций >100'];

          if($data[$i+1] < 101){
            $itog = $itog + $pa;
            $discount = $discount+$da;
          }else{
            $n = intdiv($data[$i+1], 100);
            $itog = $itog + $pa + $pb*$n;
            $discount = $discount + $da + $pb*$n;
          }
        }

        if($data[$i] == 'Разбивка осей зданий и сооружений' ){
          $pa = $costs['Разбивка осей зданий и сооружений'];
          $da = $discounts['Разбивка осей зданий и сооружений'];

          $itog = $itog + $pa*$data[$i+1];
          $discount = $discount + $da*$data[$i+1];

        }

        if($data[$i] == 'Кадастровая съемка земельного участка' ){
          $pa = $costs['Кадастровая съемка земельного участка 20'];
          $da = $discounts['Кадастровая съемка земельного участка 20'];
          $pb = $costs['Кадастровая съемка земельного участка 100'];
          $db = $discounts['Кадастровая съемка земельного участка 100'];
          $pc = $costs['Кадастровая съемка земельного участка >100'];
          $dc = $discounts['Кадастровая съемка земельного участка >100'];

          if($data[$i+1] < 21){
              $itog = $itog + $pa;
              $discount = $discount+$da;
          }elseif($data[$i+1] < 101){
            $itog = $itog+$pa + ($data[$i+1]-20)*$pb;
            $discount = $discount +$da+($data[$i+1]-20)*$db;
          }else{
            $itog = $itog + $pa + 80*$pb;
            $discount = $discount + $da + 80*$db;
            $n = intdiv($data[$i+1], 100);
            $y = $data[$i+1]%100;
            $itog = $itog + $y*($pb+$pc*$n);
            $discount = $discount + $y*($db+$dc*$n);
            for($j =0; $j<$n; $j++){
              $itog = $itog + (100*$j)*($pb+$pc*($j));
              $discount = $discount + (100*$j)*($db+$dc*($j));
            }
          }
        }


      }

      $sum['itog'] = $itog;
      $sum['discount'] = $discount- $itog;

      return $sum;
    }

    protected function calcPlot(Array $data, Array $costs, Array $discounts){
      $itog = 0;
      $discount = 0;

      for ($i = 0; $i<count($data); $i++){
        if($data[$i] == 'Межевание земельного участка' ){
          $pa = $costs['Межевание земельного участка 20'];
          $da = $discounts['Межевание земельного участка 20'];
          $pb = $costs['Межевание земельного участка 100'];
          $db = $discounts['Межевание земельного участка 100'];
          $pc = $costs['Межевание земельного участка >100'];
          $dc = $discounts['Межевание земельного участка >100'];

          if($data[$i+1] < 21){
              $itog = $itog + $pa;
              $discount = $discount+$da;
          }elseif($data[$i+1] < 101){
            $itog = $itog+$pa + ($data[$i+1]-20)*$pb;
            $discount = $discount +$da+($data[$i+1]-20)*$db;
          }else{
            $itog = $itog + $pa + 80*$pb;
            $discount = $discount + $da + 80*$db;
            $n = intdiv($data[$i+1], 100);
            $y = $data[$i+1]%100;
            $itog = $itog + $y*($pb+$pc*$n);
            $discount = $discount + $y*($db+$dc*$n);
            for($j =0; $j<$n; $j++){
              $itog = $itog + (100*$j)*($pb+$pc*($j));
              $discount = $discount + (100*$j)*($db+$dc*($j));
            }
          }
        }

        if($data[$i] == 'Раздел земельного участка' ){
          $pa = $costs['Раздел земельного участка 2'];
          $da = $discounts['Раздел земельного участка 2'];
          $pb = $costs['Раздел земельного участка 10'];
          $db = $discounts['Раздел земельного участка 10'];
          $pc = $costs['Раздел земельного участка >10'];
          $dc = $discounts['Раздел земельного участка >10'];

          if($data[$i+1] < 3){
              $itog = $itog + $pa;
              $discount = $discount+$da;
          }elseif($data[$i+1] < 11){
            $itog = $itog+$pa + ($data[$i+1]-2)*$pb;
            $discount = $discount +$da+($data[$i+1]-2)*$db;
          }else {
            $itog = $itog + $pa + 8*$pb + $pc*($data[$i+1]-10);
            $discount = $discount + $da + 8*$db + $dc*($data[$i+1]-10);
          }

        }

        if($data[$i] == 'Оформление сервитута' ){
          $pa = $costs['Оформление сервитута'];
          $da = $discounts['Оформление сервитута'];

          $itog = $itog + $pa;
          $discount = $discount + $da;

        }

        if($data[$i] == 'Объеденние земельных участков' ){
          $pa = $costs['Объеденние земельных участков 2'];
          $da = $discounts['Объеденние земельных участков 2'];
          $pb = $costs['Объеденние земельных участков 10'];
          $db = $discounts['Объеденние земельных участков 10'];
          $pc = $costs['Объеденние земельных участков >10'];
          $dc = $discounts['Объеденние земельных участков >10'];

          if($data[$i+1] < 3){
              $itog = $itog + $pa;
              $discount = $discount+$da;
          }elseif($data[$i+1] < 11){
            $itog = $itog+$pa + ($data[$i+1]-2)*$pb;
            $discount = $discount +$da+($data[$i+1]-2)*$db;
          }else {
            $itog = $itog + $pa + 8*$pb + $pc*($data[$i+1]-10);
            $discount = $discount + $da + 8*$db + $dc*($data[$i+1]-10);
          }

        }

        if($data[$i] == 'Исправление реестровой ошибки' ){
          $pa = $costs['Исправление реестровой ошибки'];
          $da = $discounts['Исправление реестровой ошибки'];

          $itog = $itog + $pa;
          $discount = $discount + $da;

        }

        if($data[$i] == 'Землеустроительная экспертиза' ){
          $pa = $costs['Землеустроительная экспертиза'];
          $da = $discounts['Землеустроительная экспертиза'];

          $itog = $itog + $pa;
          $discount = $discount + $da;

        }

      }

      $sum['itog'] = $itog;
      $sum['discount'] = $discount- $itog;

      return $sum;
    }


}
