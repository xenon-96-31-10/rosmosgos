<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;

class ServicesController extends Controller
{
    /**
     * [showSearchobj form for search obj throw API]
     * @param  $type [type of service]
     * @return view
     */
    public function showPhoeneticobj($type){
      $response = session('phoneticApi');
      $objects = $response['objects'];
      return view('services.phonetic', compact('type','objects'));
    }

    public function showSearchobj($type){
      return view('services.searchobj', compact('type'));
    }

    public function showOrder($type, $cadnomer){
      if (session()->has('responseApi'))
      {
        $data = session('responseApi');
        $region = $data['region'];
        $obj = $data['objects']['0'];
      }else{
        $data = session('phoneticApi');
        $region = $data['region'];
        foreach ($data['objects'] as $object) {
          if($object['CADNOMER'] == $cadnomer){
            $obj = $object;
          }
        }
      }

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

      // dd($obj);
      return view('services.'.$type.'.step2', compact('type','obj', 'costs', 'discounts'));
    }

    public function showRegwithorderform($type){
      if($type == 'realty'){
        $data = session('realtyData');
        // if(isset($data['egrn'])){
        //   dd($data['egrn']);
        // }else{
        //   dd($data);
        // }
        //dd($data);

      }
      return view('services.step3', compact('type'));
    }

}
