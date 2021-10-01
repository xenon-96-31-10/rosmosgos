@extends('layouts.app')

@section('title')Поиск объекта недвижимости@endsection

@section('content')
<div class="container my-5">
  @include('partials.services.header')
  <div class="row rounded border shadow justify-content-center p-3 mb-3">
      <div class="col-4 col-sm-2 text-center">
          <a class="btn btn-outline-custom btn-block" href="{{url()->previous()}}">Назад</a>
      </div>
      <div class="col-8 col-sm-10 my-auto">
          <div class="progress" style="height: 20px;">
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 70%;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Шаг 2</div>
          </div>
      </div>
  </div>

  <div class="row rounded border shadow justify-content-center p-3">
    <div class="col-12">
      <h1 class="text-center border-bottom pb-2" >Выбор услуг:</h1>

      <form id="orderGeo" method="post" class="needs-validation" novalidate>
        @csrf

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Топографическая съемка" id="topografs" name="topografs" class="summa" onclick="Summa()" >
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="topografs">
                      <p>Топографическая съемка земельного участка (Масштаб 1:500)</p>
                      <div id="topografsdescr" style="display: none">
                          <p>Топографическая съёмка – это проведение комплекса работ с целью создания топографических карт и планов местности с помощью измерений показаний геодезических точек земельного участка, на котором находится объект. Геоработы проводятся для составления и обновления планов и карт (гражданские и промышленные здания, дороги, мосты, линии электропередач, газопроводы и пр.).</p>
                          <p>Особенности топографической съёмки : определение размера, формы, ландшафта, перепада высот, горизонтальных и вертикальных измерений.</p>
                      </div>
                      <!--<p><del><span id="pricetopografsd"></span> руб.</del> <span style="color: red;" id="pricetopografs"></span><span style="color: red;"> руб.</span></p>-->
                  </label>
                  <div class="mb-1" id="sqzemuchblock" style="display: none">
                    <p>Укажите пожалуйста примерную площадь земельного участка (в сотках)</p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="sqzemuchprepend">Примерная площадь:</span>
                      </div>
                      <input type="number" class="form-control summa" id="sqzemuch" name="sqzemuch" step="1" placeholder="Площадь участка" value="" min="0" aria-describedby="sqzemuchprepend" onclick="Summa()" onchange="Summa()">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmsqzemuchbtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmsqzemuchbtn">Подтвердить</button>
                      <button type="button" name="sqzemuchbtn" class="btn btn-custom my-2" id="sqzemuchbtn" style="display:none;" onclick="BtnChange('sqzemuch')">Изменить</button>
                    </div>
                  </div>
                  <p id="moretopografs"  style="cursor: pointer" class="text-right" onclick="SM('topografsdescr','moretopografs','lesstopografs')" >Подробнее &#8595;</p>
                  <p id="lesstopografs" onclick="SL('topografsdescr','moretopografs','lesstopografs')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Вынос границ земельных участков" id="vinosgranic" name="vinosgranic" class="summa" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="vinosgranic">
                      <p>Вынос границ земельных участков</p>
                      <div id="vinosgranicdescr" style="display: none">
                          <p>Вынос границ представляет собой непосредственное фактическое закрепление на местности поворотных точек границ земельного участка межевыми знаками (металлическими штырями) ,местоположение которых соответствует данным Росреестра и подтверждается выпиской ЕГРН, координаты которых указаны в АКТЕ сдачи приемки межевых знаков на сохранность с указанием кадастрового номера.</p>
                      </div>
                      <!--<p><del><span id="pricetopografsd"></span> руб.</del> <span style="color: red;" id="pricetopografs"></span><span style="color: red;"> руб.</span></p>-->
                  </label>
                  <div class="mb-1" id="vinosgranicblock" style="display: none">
                    <p>Укажите пожалуйста количество межевых знаков</p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="colznakovprepend">Количество знаков:</span>
                      </div>
                      <input type="number" class="form-control summa" id="colznakov" name="colznakov" step="1" placeholder="Количество знаков" value="" min="0" aria-describedby="colznakovprepend" onclick="Summa()" onchange="Summa()">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmcolznakovbtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmcolznakovbtn">Подтвердить</button>
                      <button type="button" name="colznakovbtn" class="btn btn-custom my-2" id="colznakovbtn" style="display:none;" onclick="BtnChange('colznakov')">Изменить</button>
                    </div>
                  </div>
                  <p id="morevinosgranic"  style="cursor: pointer" class="text-right" onclick="SM('vinosgranicdescr','morevinosgranic','lessvinosgranic')" >Подробнее &#8595;</p>
                  <p id="lessvinosgranic" onclick="SL('vinosgranicdescr','morevinosgranic','lessvinosgranic')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Кадастровая съемка земельного участка" id="cadsemzu" name="cadsemzu" class="summa" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="cadsemzu">
                      <p>Кадастровая съемка земельного участка</p>
                      <div id="cadsemzudescr" style="display: none">
                          <p>Кадастровая съемка – один из видов геодезических изысканий. Особенность такой съемки заключается в измерении и исследовании границ, очертания, метража и месторасположения землевладения или отдельного земельного участка а так же контуров всех строений и сооружений.</p>
                      </div>
                      <!--<p><del><span id="pricetopografsd"></span> руб.</del> <span style="color: red;" id="pricetopografs"></span><span style="color: red;"> руб.</span></p>-->
                  </label>
                  <div class="mb-1" id="cadsemzublock" style="display: none">
                    <p>Укажите пожалуйста примерную площадь земельного участка (в сотках) </p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="sqzemuccsprepend">Площадь участка:</span>
                      </div>
                      <input type="number" class="form-control summa" id="sqzemuccs" name="sqzemuccs" step="1" placeholder="Площадь участка" value="" min="0" aria-describedby="sqzemuccsprepend" onclick="Summa()" onchange="Summa()">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmsqzemuccsbtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmsqzemuccsbtn">Подтвердить</button>
                      <button type="button" name="sqzemuccsbtn" class="btn btn-custom my-2" id="sqzemuccsbtn" style="display:none;" onclick="BtnChange('sqzemuccs')">Изменить</button>
                    </div>
                  </div>
                  <p id="morecadsemzu"  style="cursor: pointer" class="text-right" onclick="SM('cadsemzudescr','morecadsemzu','lesscadsemzu')" >Подробнее &#8595;</p>
                  <p id="lesscadsemzu" onclick="SL('cadsemzudescr','morecadsemzu','lesscadsemzu')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Исполнительная съемка коммуникаций" id="semkacomm" name="semkacomm" class="summa" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="semkacomm">
                      <p>Исполнительная съемка коммуникаций</p>

                      <div id="semkacommdescr" style="display: none">
                          <p>Исполнительная съёмка несёт собой информацию о таких характеристиках подземных коммуникаций как : протяженность , местоположение с координированием углов поворота и характерных точек , назначение (водопровод, канализация, связь ,газ, электрические сети),а так же все необходимые данные для постановки линейных сооружений на кадастровый учёт посредством изготовления технического плана.</p>
                      </div>
                      <!--<p><del><span id="pricetopografsd"></span> руб.</del> <span style="color: red;" id="pricetopografs"></span><span style="color: red;"> руб.</span></p>-->
                  </label>
                  <div class="mb-1" id="semkacommblock" style="display: none">
                    <p>Укажите пожалуйста предполагаемую протяженность трассы (в метрах)</p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="prottrassprepend">Протяженность трассы:</span>
                      </div>
                      <input type="number" class="form-control summa" id="prottrass" name="prottrass" step="1" placeholder="Протяженность трассы" value="" min="0" aria-describedby="prottrassprepend" onclick="Summa()" onchange="Summa()">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmprottrassbtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmprottrassbtn">Подтвердить</button>
                      <button type="button" name="prottrassbtn" class="btn btn-custom my-2" id="prottrassbtn" style="display:none;" onclick="BtnChange('prottrass')">Изменить</button>
                    </div>
                  </div>
                  <p id="moresemkacomm"  style="cursor: pointer" class="text-right" onclick="SM('semkacommdescr','moresemkacomm','lesssemkacomm')" >Подробнее &#8595;</p>
                  <p id="lesssemkacomm" onclick="SL('semkacommdescr','moresemkacomm','lesssemkacomm')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Разбивка осей зданий и сооружений" id="razbivkaos" name="razbivkaos" class="summa" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="razbivkaos">
                      <p>Разбивка осей зданий и сооружений</p>
                      <div id="razbivkaosdescr" style="display: none">
                          <p>Разбивка осей необходима при начальном этапе строительства для высокоточного определения местоположения строений и сооружений на земельном участке как в плане так и по высоте на основании проекта строительства, а так же в ходе строительства для контроля и проверки соответствия проектной документации.</p>
                      </div>
                      <!--<p><del><span id="pricetopografsd"></span> руб.</del> <span style="color: red;" id="pricetopografs"></span><span style="color: red;"> руб.</span></p>-->
                  </label>
                  <div class="mb-1" id="razbivkaosblock" style="display: none">
                    <p>Укажите пожалуйста предполагаемое количество осей</p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="coloseyprepend">Количество осей:</span>
                      </div>
                      <input type="number" class="form-control summa" id="colosey" name="colosey" step="1" placeholder="Количество осей" value="" min="0" aria-describedby="coloseyprepend" onclick="Summa()" onchange="Summa()">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmcoloseybtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmpcoloseybtn">Подтвердить</button>
                      <button type="button" name="coloseybtn" class="btn btn-custom my-2" id="coloseybtn" style="display:none;" onclick="BtnChange('colosey')">Изменить</button>
                    </div>
                  </div>
                  <p id="morerazbivkaos"  style="cursor: pointer" class="text-right" onclick="SM('razbivkaosdescr','morerazbivkaos','lessrazbivkaos')" >Подробнее &#8595;</p>
                  <p id="lessrazbivkaos" onclick="SL('razbivkaosdescr','morerazbivkaos','lessrazbivkaos')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <div class="border-bottom my-2 text-center" id="datakiblock" style="display: none">
          <br>
          <h5>Выберите желаемую дату и время  приезда Специалиста</h5>
          <br>
          <div class="form-group row">
              <div class="col-sm-1"><label for="dataki" class="col-2 col-form-label">Дата</label></div>
              <div class="col-sm-3"><input class="form-control" type="text" name="dataki" id="dataki"/></div>
              <div class="col-sm-2"><label for="timeki1" class="col-2 col-form-label">C </label></div>
              <div class="col-sm-2"><input class="form-control" type="time" value="09:00" name="timeki1" id="timeki1" min="09:00:00" max="20:00:00"></div>
              <div class="col-sm-2"><label for="timeki2" class="col-2 col-form-label">До </label></div>
              <div class="col-sm-2"><input class="form-control" type="time" value="20:00" name="timeki2" id="timeki2" min="09:00" max="20:00"></div>
          </div>
        </div>

        <div class="my-3">
          <h3 class="text-center">Способ оплаты:</h3>
          <br>
          <div class="form-row text-center" >
              <div class="col-sm-4">
                  <label class="checkbox-other">
                      <input type="checkbox" value="Оплата банковской карточкой" id="payonline" name="payonline" disabled>Оплата банковской карточкой
                  </label>
              </div>
              <div class="col-sm-4" id="paykiblock">
                  <label class="checkbox-other">
                      <input type="checkbox" value="Оплата наличными" id="payki" name="payki" checked><span id="paykides1"  style="display: none">Оплата наличными</span><span id="paykides2">Оплата Специалисту</span>
                  </label>
              </div>
              <div class="col-sm-4">
                  <label class="checkbox-other" title="Оплата производится переводом по номеру телефона или номеру карты.">
                      <input type="checkbox" value="Оплата переводом" id="paytrans" name="paytrans">Оплата переводом
                  </label>
              </div>
          </div>
        </div>

        <input type="hidden" id="cost" name="cost" value=""/>
        <input type="hidden" id="cadnumber" name="cadnumber" value="{{$obj['CADNOMER']}}"/>
        <input type="hidden" id="type" name="type" value="{{$type}}"/>
        @include('partials.services.btnzakaz')
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/services.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function () {
  var $element = $('#stopscroll');

    $(window).scroll(function() {
        var scroll = $(window).scrollTop() + $(window).height();
        //Если скролл до конца елемента
        //var offset = $element.offset().top + $element.height();
        //Если скролл до начала елемента
        var offset = $element.offset().top;

        if (scroll > offset) {
            $('#divscrolitog').removeClass('fixed-bottom');
        }
        if(offset > scroll+100){
            $('#divscrolitog').addClass('fixed-bottom');
        }
        if (scroll > offset) {
            $('#divscrolitog2').removeClass('fixed-bottom');
        }
        if(offset > scroll+100){
            $('#divscrolitog2').addClass('fixed-bottom');
        }
    });

  });
</script>
@endsection
