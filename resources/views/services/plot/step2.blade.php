@extends('layouts.app')

@section('title')Услуга Оформление земельного участка@endsection

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
                      <input type="checkbox" value="Межевание земельного участка" id="mezhplot" name="mezhplot" class="summa" onclick="Summa()" >
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="mezhplot">
                      <p>Межевание земельного участка</p>
                      <div id="mezhplotdescr" style="display: none">
                          <p>Определение границ земельного участка и постановка на кадастровый учёт в РОСРЕЕСТР.</p>
                      </div>
                      <!--<p><del><span id="pricetopografsd"></span> руб.</del> <span style="color: red;" id="pricetopografs"></span><span style="color: red;"> руб.</span></p>-->
                  </label>
                  <div class="mb-1" id="sqmezhblock" style="display: none">
                    <p>Укажите пожалуйста примерную площадь земельного участка (в сотках)</p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="sqmezhprepend">Примерная площадь:</span>
                      </div>
                      <input type="number" class="form-control summa" id="sqmezh" name="sqmezh" step="1" placeholder="Площадь участка" value="" min="0" aria-describedby="sqmezhprepend" onclick="Summa()" onchange="Summa()">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmsqmezhbtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmsqmezhbtn">Подтвердить</button>
                      <button type="button" name="sqmezhbtn" class="btn btn-custom my-2" id="sqmezhbtn" style="display:none;" onclick="BtnChange('sqmezh')">Изменить</button>
                    </div>
                  </div>
                  <p id="moremezhplot"  style="cursor: pointer" class="text-right" onclick="SM('mezhplotdescr','moremezhplot','lessmezhplot')" >Подробнее &#8595;</p>
                  <p id="lessmezhplot" onclick="SL('mezhplotdescr','moremezhplot','lessmezhplot')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Раздел земельного участка" id="razdelplot" name="razdelplot" class="summa" onclick="Summa()" >
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="razdelplot">
                      <p>Раздел земельного участка</p>
                      <div id="razdelplotdescr" style="display: none">
                          <p>Деление существующего земельного участка на несколько самостоятельных участков меньшей площади с последующей регистрацией их в РОСРЕЕСТРЕ.</p>
                      </div>
                      <!--<p><del><span id="pricetopografsd"></span> руб.</del> <span style="color: red;" id="pricetopografs"></span><span style="color: red;"> руб.</span></p>-->
                  </label>
                  <div class="mb-1" id="colpieblock" style="display: none">
                    <p>Укажите количество частей, на которые будет разделен участок (от 2 и более)</p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="colpieprepend">Колличество частей:</span>
                      </div>
                      <input type="number" class="form-control summa" id="colpie" name="colpie" step="1" placeholder="Колличество частей" value="" min="2" aria-describedby="colpieprepend" onclick="Summa()" onchange="Summa()">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmcolpiebtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmcolpiebtn">Подтвердить</button>
                      <button type="button" name="colpiebtn" class="btn btn-custom my-2" id="colpiebtn" style="display: none;" onclick="BtnChange('colpie')">Изменить</button>
                    </div>
                  </div>
                  <p id="morerazdelplot"  style="cursor: pointer" class="text-right" onclick="SM('razdelplotdescr','morerazdelplot','lessrazdelplot')" >Подробнее &#8595;</p>
                  <p id="lessrazdelplot" onclick="SL('razdelplotdescr','morerazdelplot','lessrazdelplot')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Оформление сервитута" id="servplot" name="servplot" class="summa" onclick="Summa()" >
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="servplot">
                      <p>Оформление сервитута</p>
                      <div id="servplotdescr" style="display: none">
                          <p>Установление такого обременения позволит собственникам других участков получить право проезда или пользования после регистрации в РОСРЕЕСТРЕ.</p>
                      </div>
                      <p><del><span id="priceservd">{{$discounts['Оформление сервитута']}}</span> руб.</del> <span style="color: red;" id="priceserv"></span><span style="color: red;">{{$costs['Оформление сервитута']}} руб.</span></p>
                  </label>
                  <p id="moreservplot"  style="cursor: pointer" class="text-right" onclick="SM('servplotdescr','moreservplot','lessservplot')" >Подробнее &#8595;</p>
                  <p id="lessservplot" onclick="SL('servplotdescr','moreservplot','lessservplot')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Объеденние земельных участков" id="soedplot" name="soedplot" class="summa" onclick="Summa()" >
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="mezhplot">
                      <p>Объеденние земельных участков</p>
                      <div id="soedplotdescr" style="display: none">
                          <p>Объединение двух и более смежных земельных участков в один.</p>
                      </div>
                      <!--<p><del><span id="pricetopografsd"></span> руб.</del> <span style="color: red;" id="pricetopografs"></span><span style="color: red;"> руб.</span></p>-->
                  </label>
                  <div class="mb-1" id="colpeaceblock" style="display: none">
                    <p>Укажите количество участков (от 2 и более), которые будут объединены в один участок </p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="colpeaceprepend">Колличество частей:</span>
                      </div>
                      <input type="number" class="form-control summa" id="colpeace" name="colpeace" step="1" placeholder="Колличество частей" value="" min="2" aria-describedby="colpeaceprepend" onclick="Summa()" onchange="Summa()">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmcolpeacebtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmcolpeacebtn">Подтвердить</button>
                      <button type="button" name="colpeacebtn" class="btn btn-custom my-2" id="colpeacebtn" style="display:none;" onclick="BtnChange('colpeace')">Изменить</button>
                    </div>
                  </div>
                  <p id="moresoedplot"  style="cursor: pointer" class="text-right" onclick="SM('soedplotdescr','moresoedplot','lesssoedplot')" >Подробнее &#8595;</p>
                  <p id="lesssoedplot" onclick="SL('soedplotdescr','moresoedplot','lesssoedplot')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Исправление реестровой ошибки" id="erplot" name="erplot" class="summa" onclick="Summa()" >
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="erplot">
                      <p>Исправление реестровой ошибки</p>
                      <div id="erplotdescr" style="display: none">
                          <p>Изменение данных в РОСРЕЕСТРЕ об основных характеристиках объекта (площадь, границы и т.д.).</p>
                      </div>
                      <p><del><span id="priceerplotd">{{$discounts['Исправление реестровой ошибки']}}</span> руб.</del> <span style="color: red;" id="priceerplot"></span><span style="color: red;">{{$costs['Исправление реестровой ошибки']}} руб.</span></p>
                  </label>
                  <p id="moreerplot"  style="cursor: pointer" class="text-right" onclick="SM('erplotdescr','moreerplot','lesserplot')" >Подробнее &#8595;</p>
                  <p id="lesserplot" onclick="SL('erplotdescr','moreerplot','lesserplot')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Землеустроительная экспертиза" id="expertplot" name="expertplot" class="summa" onclick="Summa()" >
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="expertplot">
                      <p>Землеустроительная экспертиза</p>
                      <div id="expertplotdescr" style="display: none">
                          <p>Проводиться судебным экспертом для разрешения всех имеющихся споров и составления заключения при необходимости предоставляемого в суд.</p>
                      </div>
                      <p><del><span id="priceexpertplot">{{$discounts['Исправление реестровой ошибки']}}</span> руб.</del> <span style="color: red;" id="priceexpertplot"></span><span style="color: red;">{{$costs['Исправление реестровой ошибки']}} руб.</span></p>
                  </label>
                  <p id="moreexpertplot"  style="cursor: pointer" class="text-right" onclick="SM('expertplotdescr','moreexpertplot','lessexpertplot')" >Подробнее &#8595;</p>
                  <p id="lessexpertplot" onclick="SL('expertplotdescr','moreexpertplot','lessexpertplot')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
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
