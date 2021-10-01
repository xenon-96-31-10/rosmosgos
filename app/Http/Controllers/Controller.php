<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createOrder(Array $data, Array $obj)
    {
      $order = new \App\Models\Order;
      $order->cost = $data['cost'];
      $order->status = "Поиск исполнителя";
      if(isset($data['payonline'])){
        $order->sposobpay = $data['payonline'];
      }else if(isset($data['payki'])){
        $order->sposobpay = $data['payki'];
      }else{
        $order->sposobpay = $data['paytrans'];
      }
      $order->statuspay = "Не оплачен";
      $order->region = $obj['region'];
      return $order;
    }

    public function createRealty(Array $data)
    {
        $services = "";

        if(isset($data['regpraval'])){
          $services .= $data['regpraval'];
          $services .= " -> ";
          if(isset($data['regpravalarea'])){
              $services .= $data['regpravalarea'];
              $services .= " | ";
          }else{
              $services .= 'Площадь не указана';
              $services .= " |";
          }
        }

        if(isset($data['regprava'])){
          $services .= $data['regprava'];
          $services .= " -> ";
          if(isset($data['regpravanlh'])){
            $services .= $data['regpravanlh'];
            if($data['regpravanlh'] != 'Другое'){
                $services .= " | ";
            }else{
                $services .= " -> ";
                $services .= $data['regpravadr'];
                $services .= " | ";
            }
          }
        }

        if(isset($data['uchet'])){
          $services .= $data['uchet'];
          $services .= " | ";
        }

        if(isset($data['livinghouse'])){
            $services .= $data['livinghouse'];
            $services .= " -> ";
            if(isset($data['livinghousearea'])){
                $services .= $data['livinghousearea'];
                $services .= " | ";
            }else{
                $services .= 'Площадь не указана';
                $services .= " |";
            }
        }

        if(isset($data['nonlivinghouse'])){
            $services .= $data['nonlivinghouse'];
            $services .= " -> ";
            if(isset($data['typerealtynlh'])){
              $services .= $data['typerealtynlh'];
              if($data['typerealtynlh'] != 'Другое'){
                  $services .= " | ";
              }else{
                  $services .= " -> ";
                  $services .= $data['typerealtydr'];
                  $services .= " | ";
              }
            }
        }

        for($i=1; $i<10;$i++){
          if(isset($data['nonlivinghouse'.$i.''])){
              $services .= $data['nonlivinghouse'.$i.''];
              $services .= " -> ";
              if(isset($data['typerealtynlh'.$i.''])){
                $services .= $data['typerealtynlh'.$i.''];
                if($data['typerealtynlh'.$i.''] != 'Другое'){
                    $services .= " | ";
                }else{
                    $services .= " -> ";
                    $services .= $data['typerealtydr'.$i.''];
                    $services .= " | ";
                }
              }
          }
        }

        if(isset($data['egrn'])){
          $services .= $data['egrn'];
          $services .= " | ";
        }

        if(isset($data['cadst'])){
          $services .= $data['cadst'];
          $services .= " | ";
        }

        if(isset($data['arest'])){
          $services .= $data['arest'];
          $services .= " | ";
        }

        if(isset($data['egrp'])){
          $services .= $data['egrp'];
          $services .= " | ";
        }

        if(isset($data['sposobpodachi'])){
            $services .= $data['sposobpodachi'];
            $services .= " -> ";
            if ($data['sposobpodachi'] == 'Кадастровым инженером'){
                if(isset($data['resulttoemail'])){
                    $services .= $data['resulttoemail'];
                    if(isset($data['resulttokurier'])){
                      $services .= " -> ";
                    }
                }
                if(isset($data['resulttokurier'])){
                    $services .= $data['resulttokurier'];
                }
                $services .= " | ";
            }
            if ($data['sposobpodachi'] == 'Самостоятельно в МФУ'){
                if(isset($data['zapistpnacd'])){
                    $services .= $data['zapistpnacd'];
                    if(isset($data['tpkurierom'])){
                      $services .= " -> ";
                    }
                }
                if(isset($data['tpkurierom'])){
                    $services .= $data['tpkurierom'];
                }
                $services .= " | ";
            }
        }


        if(isset($data['dataki'])){
            $dataki = $data['dataki'];
            $dataki .= " c ";
            $dataki .= $data['timeki1'];
            $dataki .= " до ";
            $dataki .= $data['timeki2'];
        }else{
          $dataki = "Без выезда";
        }


        if(isset($data['adresdostavki'])){
          $adresdostavki = $data['adresdostavki'];
        }else{
          $adresdostavki = "Без доставки";
        }

        return \App\Models\Realty::create([
            'services' => $services,
            'dateki' => $dataki,
            'adresdostavki' => $adresdostavki,
        ]);


    }

    public function createGeo(Array $data)
    {
        $services = "";

        if(isset($data['topografs'])){
          $services .= $data['topografs'];
          $services .= " -> ";
          if(isset($data['sqzemuch'])){
              $services .= $data['sqzemuch'];
              $services .= " соток";
              $services .= " | ";
          }
        }

        if(isset($data['vinosgranic'])){
          $services .= $data['vinosgranic'];
          $services .= " -> ";
          if(isset($data['colznakov'])){
              $services .= $data['colznakov'];
              $services .= " количество межевых знаков";
              $services .= " | ";
          }
        }

        if(isset($data['semkacomm'])){
          $services .= $data['prottrass'];
          $services .= " -> ";
          if(isset($data['prottrass'])){
              $services .= $data['prottrass'];
              $services .= " м";
              $services .= " | ";
          }
        }

        if(isset($data['razbivkaos'])){
          $services .= $data['razbivkaos'];
          $services .= " -> ";
          if(isset($data['colosey'])){
              $services .= $data['colosey'];
              $services .= " количество осей";
              $services .= " | ";
          }
        }

        if(isset($data['cadsemzu'])){
          $services .= $data['cadsemzu'];
          $services .= " -> ";
          if(isset($data['sqzemuccs'])){
              $services .= $data['sqzemuccs'];
              $services .= " соток";
              $services .= " | ";
          }
        }

        if(isset($data['dataki'])){
            $dataki = $data['dataki'];
            $dataki .= " c ";
            $dataki .= $data['timeki1'];
            $dataki .= " до ";
            $dataki .= $data['timeki2'];
        }else{
          $dataki = "Без выезда";
        }

        return \App\Models\Geo::create([
            'services' => $services,
            'datespec' => $dataki,
        ]);
    }

    public function createPlot(Array $data)
    {
        $services = "";

        if(isset($data['mezhplot'])){
          $services .= $data['mezhplot'];
          $services .= " -> ";
          if(isset($data['sqmezh'])){
              $services .= $data['sqmezh'];
              $services .= " соток";
              $services .= " | ";
          }
        }

        if(isset($data['razdelplot'])){
          $services .= $data['razdelplot'];
          $services .= " -> ";
          if(isset($data['colpie'])){
              $services .= "на ";
              $services .= $data['colpie'];
              $services .= " ч.";
              $services .= " | ";
          }
        }

        if(isset($data['servplot'])){
          $services .= $data['servplot'];
          $services .= " | ";
        }

        if(isset($data['soedplot'])){
          $services .= $data['soedplot'];
          $services .= " -> ";
          if(isset($data['colpeace'])){
              $services .= "из ";
              $services .= $data['colpeace'];
              $services .= " уч.";
              $services .= " | ";
          }
        }

        if(isset($data['erplot'])){
          $services .= $data['erplot'];
          $services .= " | ";
        }

        if(isset($data['expertplot'])){
          $services .= $data['expertplot'];
          $services .= " | ";
        }

        if(isset($data['dataki'])){
            $dataki = $data['dataki'];
            $dataki .= " c ";
            $dataki .= $data['timeki1'];
            $dataki .= " до ";
            $dataki .= $data['timeki2'];
        }else{
          $dataki = "Без выезда";
        }

        return \App\Models\Plot::create([
            'services' => $services,
            'datespec' => $dataki,
        ]);

    }

    public function fullrosreestrsearch(Array $data){
      $param=[
        'query' => $data['cadnumber'],
        'mode' => "normal",
        'grouped' => 0
      ];
      $params = json_encode($param);

      $curl = curl_init('https://apirosreestr.ru/api/cadaster/objectInfoFull');
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('POST /api/cadaster/search HTTP/1.1', 'Host: apirosreestr.ru', 'Token: KPSZ-MQPM-W4ZQ-MYSN', 'Content-Type: application/json' ));
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
      $json = curl_exec($curl);
      curl_close($curl);
      $obj=json_decode($json,true);

      $rosreestr = new \App\Models\Rosreestrinfo;

      $x = "Нет данных в выписке";

      $array = array(
          ['Тип объекта','typeobj'],
          ['Кадастровый номер','cadnomer'],
          ['Адрес (местоположение)','adres'],
          ['Статус объекта','statusobj'],
          ['Дата постановки на кадастровый учет','datepostuch'],
          ['Категория земель','catzemly'],
          ['Разрешенное использование', 'razreshisp'],
          ['Площадь','area'],
          ['Единица измерения (код)','areacod'],
          ['Кадастровая стоимость','cadastrcost'],
          ['Дата определения стоимости','dateoprcost'],
          ['Дата внесения стоимости','datevnescost'],
          ['Дата утверждения стоимости','dateutvercost'],
          ['Дата обновления информации','dateupdateinf'],
          ['Форма собственности','formsobstv'],
          ['Количество правообладателей','numberhoz'],
          ['Кадастровый инженер','ki'],
      );

      foreach ($array as list($a, $b)) {
        if(isset($obj['EGRN']['details'][''.$a.''])){
          $rosreestr->$b = $obj['EGRN']['details'][''.$a.''];
        }else {
          $rosreestr->$b = $x;
        }
      }

      if(isset($obj['coordinates'][0])){
        $rosreestr->coordinata1 = $obj['coordinates'][0];
      }else {
        $rosreestr->coordinata1 = $x;
      }

      if(isset($obj['coordinates'][1])){
        $rosreestr->coordinata2 = $obj['coordinates'][1];
      }else {
        $rosreestr->coordinata2 = $x;
      }

      return $rosreestr;
    }
}
