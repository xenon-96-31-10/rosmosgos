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

      <form id="orderRealty" method="post" class="needs-validation" novalidate>
        @csrf
        <!-- <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Получение ГПЗУ" id="gpzu" name="gpzu" class="summa" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="gpzu">
                      <p>Получение ГПЗУ</p>
                      <div id="gpzudescr" style="display: none">
                          <p>Текст про ГПЗУ</p>
                      </div>
                      <p><del><span id="pricegpzud">{{$discounts['Получение ГПЗУ']}}</span> руб.</del> <span style="color: red;" id="pricegpzu"></span><span style="color: red;">{{$costs['Получение ГПЗУ']}} руб.</span></p>
                  </label>
                  <p id="moregpzu"  style="cursor: pointer" class="text-right" onclick="SM('gpzudescr','moregpzu','lessgpzu')" >Подробнее &#8595;</p>
                  <p id="lessgpzu" onclick="SL('gpzudescr','moregpzu','lessgpzu')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table> -->
        <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Оформление права собственности на жилой дом" id="regpraval" name="regpraval" class="summa" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="regpraval">
                      <p>Оформление права собственности на жилой дом</p>
                      <div id="regpravaldescr" style="display: none">
                          <p>Регистрация права и постановка на кадастровый учёт построек (<a type="button" class="text-info" data-toggle="modal" data-target=".bd-example-modal-lg">технический план</a>) в координатах с получением новой выписки ЕГРН на ранее не оформленные объекты недвижимости. Каждый документ подтверждён ЭЦП (электронно –цифровой подписью Росреестра).</p>
                      </div>
                      <p><del><span id="priceregpravald">{{$discounts['Оформление права собственности на жилой дом']}}</span> руб.</del> <span style="color: red;" id="priceregpraval"></span><span style="color: red;">{{$costs['Оформление права собственности на жилой дом']}} руб.</span></p>
                  </label>
                  <div class="mb-3" id="regpravalareablock" style="display: none;">
                    <p>Необходимо указать примерную площадь строения в кв.м.</p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="regpravalareaprepend">Примерная площадь:</span>
                      </div>
                      <input type="text" class="form-control" id="regpravalarea" name="regpravalarea" aria-describedby="regpravalareaprepend">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmregpravalareabtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmregpravalareabtn">Подтвердить</button>
                      <button type="button" name="regpravalareabtn" class="btn btn-custom my-2" id="regpravalareabtn" style="display:none;" onclick="BtnChange('regpravalarea')">Изменить</button>
                    </div>
                  </div>
                  <p id="moreregpraval"  style="cursor: pointer" class="text-right" onclick="SM('regpravaldescr','moreregpraval','lessregpraval')" >Подробнее &#8595;</p>
                  <p id="lessregpraval" onclick="SL('regpravaldescr','moreregpraval','lessregpraval')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Оформление права собственности на нежилое строение" id="regprava" name="regprava" class="summa" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="regprava">
                      <p>Оформление права собственности на нежилое строение</p>
                      <div id="regpravadescr" style="display: none">
                        <p>Регистрация права и постановка на кадастровый учёт построек (<a type="button" class="text-info" data-toggle="modal" data-target=".bd-example-modal-lg">технический план</a>) в координатах с получением новой выписки ЕГРН на ранее не оформленные объекты недвижимости. Каждый документ подтверждён ЭЦП (электронно –цифровой подписью Росреестра).</p>
                      </div>
                      <p><del><span id="priceegrnd">{{$discounts['Оформление права собственности на нежилое строение']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Оформление права собственности на нежилое строение']}} руб.</span></p>
                  </label>
                  <div class="mb-3" id="regpravanlhselect" style="display:none">
                    <select class="mdb-select md-form mb-2" id="regpravanlh" name="regpravanlh" onclick="Summa()">
                        <option value="Список" class="summa">Выберите из списка</option>
                        <option value="Гараж" class="summa">Гараж: <span style="color: red;">{{$costs['Гараж']}} руб.</span></option>
                        <option value="Баня" class="summa" >Баня: <span style="color: red;">{{$costs['Баня']}} руб.</span></option>
                        <option value="Хозяйственный блок" class="summa" >Хозяйственный блок: <span style="color: red;">{{$costs['Хозяйственный блок']}} руб.</span></option>
                        <option value="Навес" class="summa" >Навес: <span style="color: red;">{{$costs['Навес']}} руб.</span></option>
                        <option value="Теплица" class="summa" >Теплица: <span style="color: red;">{{$costs['Теплица']}} руб.</span></option>
                        <option value="Садовый дом" class="summa" >Садовый дом: <span style="color: red;">{{$costs['Садовый дом']}} руб.</span></option>
                        <option value="Другое" class="summa" >Другое: <span style="color: red;">{{$costs['Другое']}} руб.</span></option>
                    </select>
                    <div id="regpravanlhdrugoe" style="display: none;">
                      <div class="input-group" >
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="regpravadrprepend">Укажите другое:</span>
                        </div>
                        <input type="text" class="form-control" id="regpravadr" name="regpravadr" aria-describedby="regpravadrprepend">
                      </div>
                    </div>
                  </div>
                  <p id="moreregprava"  style="cursor: pointer" class="text-right" onclick="SM('regpravadescr','moreregprava','lessregprava')" >Подробнее &#8595;</p>
                  <p id="lessregprava" onclick="SL('regpravadescr','moreregprava','lessregprava')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Постановка на учет (ранее зарегистрированного строения)" id="uchet" name="uchet" class="summa" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="uchet">
                      <p>Постановка на учет (ранее зарегистрированного строения)</p>
                      <div id="uchetdescr" style="display: none">
                        <p>Координатная привязка построек (<a type="button" class="text-info" data-toggle="modal" data-target=".bd-example-modal-lg">технический план</a>) для подтверждение расположения объектов недвижимости на земельном участке а так же привязка к кадастровому номеру земельного участка в ЕГРН.</p>
                      </div>
                      <p><del><span id="priceegrnd">{{$discounts['Постановка на учет (ранее зарегистрированного строения)']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Постановка на учет (ранее зарегистрированного строения)']}} руб.</span></p>
                  </label>
                  <p id="moreuchet"  style="cursor: pointer" class="text-right" onclick="SM('uchetdescr','moreuchet','lessuchet')" >Подробнее &#8595;</p>
                  <p id="lessuchet" onclick="SL('uchetdescr','moreuchet','lessuchet')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5" id="livinghousecheckblock" style="display: none">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Жилой дом" id="livinghouse" name="livinghouse" class="summa" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="livinghouse">
                      <p>Жилой дом</p>
                      <p><del><span id="priceegrnd">{{$discounts['Жилой дом']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Жилой дом']}} руб.</span></p>
                  </label>
                  <div class="mb-3" id="livinghouseareablock" style="display: none;">
                    <p>Необходимо указать примерную площадь строения в кв.м.</p>
                    <div class="input-group" >
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="livinghouseareaprepend">Примерная площадь:</span>
                      </div>
                      <input type="text" class="form-control" id="livinghousearea" name="livinghousearea" aria-describedby="livinghouseareaprepend">
                    </div>
                    <div class="d-flex justify-content-end">
                      <button type="button" name="confirmlivinghouseareabtn" class="btn btn-custom mr-2 my-2 d-block d-sm-none" id="confirmlivinghouseareabtn">Подтвердить</button>
                      <button type="button" name="livinghouseareabtn" class="btn btn-custom my-2" id="livinghouseareabtn" style="display:none;" onclick="BtnChange('livinghousearea')">Изменить</button>
                    </div>
                  </div>
              </td>
          </tr>
        </table>

        <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5" id="nonlivinghousecheckblock" style="display: none">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Нежилое строение" id="nonlivinghouse" name="nonlivinghouse" class="summa" onclick="Summa();addInput()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="nonlivinghouse">
                      <p>Нежилое строение</p>
                      <p><del><span id="pricenlhd">{{$discounts['Нежилое строение']}}</span> руб.</del> <span style="color: red;" id="pricenlh">{{$costs['Нежилое строение']}}</span><span style="color: red;"> руб.</span></p>
                  </label>
                  <div class="mb-3" id="nlhselect" style="display:none">
                    <select class="mdb-select md-form mb-2" id="typerealtynlh" name="typerealtynlh" onclick="Summa()">
                        <option value="Список" class="summa">Выберите из списка</option>
                        <option value="Гараж" class="summa">Гараж: <span style="color: red;">{{$costs['Гараж']}} руб.</span></option>
                        <option value="Баня" class="summa" >Баня: <span style="color: red;">{{$costs['Баня']}} руб.</span></option>
                        <option value="Хозяйственный блок" class="summa" >Хозяйственный блок: <span style="color: red;">{{$costs['Хозяйственный блок']}} руб.</span></option>
                        <option value="Навес" class="summa" >Навес: <span style="color: red;">{{$costs['Навес']}} руб.</span></option>
                        <option value="Теплица" class="summa" >Теплица: <span style="color: red;">{{$costs['Теплица']}} руб.</span></option>
                        <option value="Садовый дом" class="summa" >Садовый дом: <span style="color: red;">{{$costs['Садовый дом']}} руб.</span></option>
                        <option value="Другое" class="summa" >Другое: <span style="color: red;">{{$costs['Другое']}} руб.</span></option>
                    </select>
                    <div class="d-none">
                      <span id="garazh" style="color: red;">{{$costs['Гараж']}} руб.</span>
                      <span id="bany" style="color: red;">{{$costs['Баня']}} руб.</span>
                      <span id="hozblock" style="color: red;">{{$costs['Хозяйственный блок']}} руб.</span>
                      <span id="naves" style="color: red;">{{$costs['Навес']}} руб.</span>
                      <span id="tepl" style="color: red;">{{$costs['Теплица']}} руб.</span>
                      <span id="saddom" style="color: red;">{{$costs['Садовый дом']}} руб.</span>
                      <span id="drugoe" style="color: red;">{{$costs['Другое']}} руб.</span>
                    </div>
                    <div id="nlhdrugoe" style="display: none;">
                      <div class="input-group" >
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="typerealtydrprepend">Укажите другое:</span>
                        </div>
                        <input type="text" class="form-control" id="typerealtydr" name="typerealtydr" aria-describedby="typerealtydrprepend">
                      </div>
                    </div>
                  </div>
              </td>
          </tr>
        </table>
        <div id="input0"></div>

        <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5">
          <tr>
              <td width="10%" valign="top">
                  <div class="checkbox-other">
                      <input type="checkbox" value="Получение официальной выписки из ЕГРН" id="egrn" name="egrn" class="summa onlypaytrans" onclick="Summa()">
                  </div>
              </td>
              <td valign="top">
                  <label class="checkbox-other" for="egrn">
                      <p>Получение официальной выписки ЕГРН из Росреестра</p>
                      <div id="egrndescr" style="display: none">
                          <p>Вся имеющиеся официальная и актуальная информация по объекту недвижимости с приложением координат и чертежа границ из базы ЕГРН. Каждый документ подтверждён ЭЦП (электронно-цифровой подписью Росреестра)</p>
                      </div>
                      <p><del><span id="priceegrnd">{{$discounts['Получение официальной выписки из ЕГРН']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Получение официальной выписки из ЕГРН']}} руб.</span></p>
                  </label>
                  <p id="moreegrn"  style="cursor: pointer" class="text-right" onclick="SM('egrndescr','moreegrn','lessegrn')" >Подробнее &#8595;</p>
                  <p id="lessegrn" onclick="SL('egrndescr','moreegrn','lessegrn')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
              </td>
          </tr>
        </table>

        <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5">
          <tr>
            <td width="10%" valign="top">
                <div class="checkbox-other">
                    <input type="checkbox" value="Справка о кадастровой стоимости" id="cadst" name="cadst" class="summa onlypaytrans" onclick="Summa()">
                </div>
            </td>
            <td valign="top">
                <label class="checkbox-other" for="cadst">
                    <p>Справка о кадастровой стоимости</p>
                    <div id="cadstdescr" style="display: none">
                        <p>Содержит актуальную информацию о кадастровой стоимости и основных характеристиках объекта недвижимости из базы ЕГРН. Каждый документ подтверждён ЭЦП (электронно- цифровой подписью Росреестра).</p>
                    </div>
                    <p><del><span id="priceegrnd">{{$discounts['Справка о кадастровой стоимости']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Справка о кадастровой стоимости']}} руб.</span></p>
                </label>
                <p id="morecadst"  style="cursor: pointer" class="text-right" onclick="SM('cadstdescr','morecadst','lesscadst')" >Подробнее &#8595;</p>
                <p id="lesscadst" onclick="SL('cadstdescr','morecadst','lesscadst')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
            </td>
          </tr>
        </table>

        <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5">
          <tr>
            <td width="10%" valign="top">
                <div class="checkbox-other">
                    <input type="checkbox" value="Проверка объекта на арест" id="arest" name="arest" class="summa onlypaytrans" onclick="Summa()">
                </div>
            </td>
            <td valign="top">
                <label class="checkbox-other" for="arest">
                    <p>Проверка объекта на арест, залог и основные характеристики</p>
                    <div id="arestdescr" style="display: none">
                        <p>Вся имеющиеся официальная и актуальная информация по объекту недвижимости из базы ЕГРН по залогам и обременениям. Каждый документ подтверждён ЭЦП (электронно- цифровой подписью Росреестра).</p>
                    </div>
                    <p><del><span id="priceegrnd">{{$discounts['Проверка объекта на арест']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Проверка объекта на арест']}} руб.</span></p>
                </label>
                <p id="morearest"  style="cursor: pointer" class="text-right" onclick="SM('arestdescr','morearest','lessarest')" >Подробнее &#8595;</p>
                <p id="lessarest" onclick="SL('arestdescr','morearest','lessarest')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
            </td>
          </tr>
        </table>

        <table class="border-bottom mb-2" width="100%" cellspacing="0" cellpadding="5">
          <tr>
            <td width="10%" valign="top">
                <div class="checkbox-other">
                    <input type="checkbox" value="Выписка из ЕГРП о переходе прав" id="egrp" name="egrp" class="summa onlypaytrans" onclick="Summa()">
                </div>
            </td>
            <td valign="top">
                <label class="checkbox-other" for="egrp">
                    <p>Выписка из ЕГРП о переходе прав</p>
                    <div id="egrpdescr" style="display: none">
                        <p>Полный список собственников объекта недвижимости по настоящее время начиная с 1998 г., имеющихся в базе ЕГРН.
                            Каждый документ подтверждён ЭЦП (электронно –цифровой подписью Росреестра).
                        </p>
                    </div>
                    <p><del><span id="priceegrnd">{{$discounts['Выписка из ЕГРП о переходе прав']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Выписка из ЕГРП о переходе прав']}} руб.</span></p>
                </label>
                <p id="moreegrp"  style="cursor: pointer" class="text-right" onclick="SM('egrpdescr','moreegrp','lessegrp')" >Подробнее &#8595;</p>
                <p id="lessegrp" onclick="SL('egrpdescr','moreegrp','lessegrp')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
            </td>
          </tr>
        </table>


        <div class="text-center mb-3" id="sposobpodachiblock" style="display: none;">
            <h5>Выберите способ подачи документов в Росреестр</h5>
            <div class="form_radio_group">
                <div class="form_radio_group-item">
                    <input id="sposobpodachi1" type="radio" name="sposobpodachi"  value="Кадастровым инженером" class="summa" onclick="Summa()">
                    <label for="sposobpodachi1"><span class="d-none d-sm-block">Кадастровым инженером</span><span class="d-block d-sm-none">КИ</span></label>
                </div>
                <div class="form_radio_group-item">
                    <input id="sposobpodachi2" type="radio" name="sposobpodachi"  value="Самостоятельно в МФУ" class="summa" onclick="Summa()" >
                    <label for="sposobpodachi2">Самостоятельно в МФЦ</label>
                </div>
            </div>
        </div>

        <div class="border-bottom mb-3" id="gosposhlinablock" style="display: none">
          <table width="100%" cellspacing="0" cellpadding="5">
              <tr>
                  <td width="10%" valign="top">
                      <div class="checkbox-other">
                          <input type="checkbox" value="" id="gp" name="gp" checked disabled>
                          <input type="checkbox" value="Госпошлина за жилой дом" id="gosposhlina" name="gosposhlina" class="summa" onclick="Summa()" style="visibility: hidden" >
                      </div>
                  </td>
                  <td valign="top">
                      <label class="checkbox-other" for="gp">
                          <p>Госпошлина за жилой дом</p>
                          <div id="gosposhlinadescr" style="display: none">
                              <p>
                                  В стоимость подачи документов входит стоимость госпошлины</p>
                          </div>
                          <p><del><span id="pricegpd">{{$discounts['Госпошлина за жилой дом']}}</span> руб.</del> <span style="color: red;" id="pricegp">{{$costs['Госпошлина за жилой дом']}}</span><span style="color: red;"> руб.</span></p>
                      </label>
                      <p id="moregp"  style="cursor: pointer" class="text-right" onclick="SM('gosposhlinadescr','moregp','lessgp')" >Подробнее &#8595;</p>
                      <p id="lessgp" onclick="SL('gosposhlinadescr','moregp','lessgp')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
                  </td>
              </tr>
          </table>
        </div>
        <div class="border-bottom" id="gosposhlinanblock" style="display: none">
          <table width="100%" cellspacing="0" cellpadding="5">
              <tr>
                  <td width="10%" valign="top">
                      <div class="checkbox-other">
                          <input type="checkbox" value="" id="gpn" name="gpn" checked disabled>
                          <input type="checkbox" value="Госпошлина за нежилое строение" id="gosposhlinan" name="gosposhlinan" class="summa" onclick="Summa()" style="visibility: hidden" >
                      </div>
                  </td>
                  <td valign="top">
                      <label class="checkbox-other" for="gp">
                          <p>Госпошлина за нежилое строение</p>
                          <!-- <p>Выбрано: <span id="countnlh"></span></p> -->
                          <div id="gosposhlinandescr" style="display: none">
                              <p>
                                  В стоимость подачи документов входит стоимость госпошлины</p>
                          </div>
                          <p><del><span id="pricegpnd">{{$discounts['Госпошлина за нежилое строение']}}</span> руб.</del> <span style="color: red;" id="pricegpn">{{$costs['Госпошлина за нежилое строение']}}</span><span style="color: red;"> руб.</span> x <span id="countnlh"></span></p>
                      </label>
                      <p id="morengp"  style="cursor: pointer" class="text-right" onclick="SM('gosposhlinandescr','morengp','lessngp')" >Подробнее &#8595;</p>
                      <p id="lessngp" onclick="SL('gosposhlinandescr','morengp','lessngp')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
                  </td>
              </tr>
          </table>
        </div>

        <div id="sposob1" style="display: none">
          <div class="my-2 border-bottom">
              <p>Подача за Вас всех документов Кадастровым инженером.</p>
          </div>
          <div class="border-bottom my-2" >
              <table width="100%" cellspacing="0" cellpadding="5">
                  <tr>
                      <td width="10%" valign="top">
                          <div class="checkbox-other">
                              <input type="checkbox" value="Получить результаты на email" id="resulttoemail" name="resulttoemail" class="summa" onclick="Summa()">
                          </div>
                      </td>
                      <td valign="top">
                          <label class="checkbox-other" for="resulttoemail">
                              <p>Получить результаты на email</p>
                              <div id="resulttoemaildescr" style="display: none">
                                  <p>В момент готовности заключения РОСРЕЕСТРА на поданные кадастровым инженером документы автоматически высылается на указанный email.</p>
                              </div>
                              <p><span style="color: red;" id="pricerte">{{$costs['Получить результаты на email']}}</span><span style="color: red;"> руб.</span></p>
                          </label>
                          <p id="morerte"  style="cursor: pointer" class="text-right" onclick="SM('resulttoemaildescr','morerte','lessrte')" >Подробнее &#8595;</p>
                          <p id="lessrte" onclick="SL('resulttoemaildescr','morerte','lessrte')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
                      </td>
                  </tr>
              </table>
          </div>
          <div class="border-bottom my-2">
              <table width="100%" cellspacing="0" cellpadding="5">
                  <tr>
                      <td width="10%" valign="top">
                          <div class="checkbox-other">
                              <input type="checkbox" value="Курьером в бумажном виде" id="resulttokurier" name="resulttokurier" class="summa" onclick="Summa()">
                          </div>
                      </td>
                      <td valign="top">
                          <label class="checkbox-other" for="resulttokurier">
                              <p>Получить результаты курьером в бумажном виде</p>
                              <div id="resulttokurierdescr" style="display: none">
                                  <p>После готовности заключения РОСРЕЕСТРА на поданные кадастровым инженером документы распечатывается в человек читаемом формате. </p>
                              </div>
                              <p><del><span id="pricebvkd">{{$discounts['Курьером в бумажном виде']}}</span> руб.</del> <span style="color: red;" id="pricebvk">{{$costs['Курьером в бумажном виде']}}</span><span style="color: red;"> руб.</span></p>
                          </label>
                          <p id="morebvk"  style="cursor: pointer" class="text-right" onclick="SM('resulttokurierdescr','morebvk','lessbvk')" >Подробнее &#8595;</p>
                          <p id="lessbvk" onclick="SL('resulttokurierdescr','morebvk','lessbvk')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
                      </td>
                  </tr>
              </table>
          </div>
        </div>

        <div id="sposob2" style="display: none">
          <div class="my-2 border-bottom">
            <p>Подготовленные документы через систему <a href="{{ route('home')}}" target="_blank">Rosmosgos.ru</a>, Вам будет необходимо подать в ближайшем  МФЦ лично.</p>
          </div>
          <div class="my-2 border-bottom" >
              <table width="100%" cellspacing="0" cellpadding="5">
                  <tr>
                      <td width="10%" valign="top">
                          <div class="checkbox-other">
                              <input type="checkbox" value="Запись тех. плана на CD" id="zapistpnacd" name="zapistpnacd" class="summa" onclick="Summa()">
                          </div>
                      </td>
                      <td valign="top">
                          <label class="checkbox-other" for="zapistpnacd">
                              <p>Запись тех. плана на CD</p>
                              <div id="zapistpnacddescr" style="display: none">
                                <p>Для Вас будет записан Диск со всей необходимыми документами по Вашему заказу. Диск можно будет забрать в ближайшем отделении компании. Адрес ближайшего офиса по готовности документов будет отправлен в смс уведомлении или на электронный адрес.</p>
                              </div>
                              <p><del><span id="pricepcdd">{{$discounts['Запись тех. плана на CD']}}</span> руб.</del> <span style="color: red;" id="pricepcd">{{$costs['Запись тех. плана на CD']}}</span><span style="color: red;"> руб.</span></p>
                          </label>
                          <p id="moreztpcd"  style="cursor: pointer" class="text-right" onclick="SM('zapistpnacddescr','moreztpcd','lessztpcd')" >Подробнее &#8595;</p>
                          <p id="lessztpcd" onclick="SL('zapistpnacddescr','moreztpcd','lessztpcd')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
                      </td>
                  </tr>
              </table>
          </div>
          <div class="my-2 border-bottom" >
              <table width="100%" cellspacing="0" cellpadding="5">
                  <tr>
                      <td width="10%" valign="top">
                          <div class="checkbox-other">
                              <input type="checkbox" value="Доставка тех. плана курьером" id="tpkurierom" name="tpkurierom" class="summa" onclick="Summa()">
                          </div>
                      </td>
                      <td valign="top">
                          <label class="checkbox-other" for="tpkurierom">
                              <p>Доставка тех. плана курьером</p>
                              <div id="tpkurieromdescr" style="display: none">
                                  <p>Все необходимые документы согласно Вашему заказу будут доставлены Курьерской службой.</p>
                              </div>
                              <p><del><span id="pricetpkd">{{$discounts['Доставка тех. плана курьером']}}</span> руб.</del> <span style="color: red;" id="pricetpk">{{$costs['Доставка тех. плана курьером']}}</span><span style="color: red;"> руб.</span></p>
                          </label>
                          <p id="moretpk"  style="cursor: pointer" class="text-right" onclick="SM('tpkurieromdescr','moretpk','lesstpk')" >Подробнее &#8595;</p>
                          <p id="lesstpk" onclick="SL('tpkurieromdescr','moretpk','lesstpk')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
                      </td>
                  </tr>
              </table>
          </div>
        </div>

        <div class="border-bottom my-2 text-center" id="datakiblock" style="display: none">
          <br>
          <h5>Выберите желаемую дату и время  приезда Кадастрового инженера</h5>
          <br>
          <div class="form-group row">
              <div class="col-sm-1"><label for="dataki" class="col-2 col-form-label">Дата</label></div>
              <div class="col-sm-3"><input class="form-control" type="text" name="dataki" id="dataki"/></div>
              <div class="col-sm-2"><label for="timeki1" class="col-2 col-form-label">C </label></div>
              <div class="col-sm-2"><input class="form-control" type="time" value="09:00" name="timeki1" id="timeki1"></div>
              <div class="col-sm-2"><label for="timeki2" class="col-2 col-form-label">До </label></div>
              <div class="col-sm-2"><input class="form-control" type="time" value="20:00" name="timeki2" id="timeki2"></div>
          </div>
        </div>

        <div class="border-bottom my-3 pb-2" id="adresdatadostavki" style="display: none">
          <br>
            <h5 class="text-center">Выберите желаемый адрес доставки документов</h5>
          <br>
          <div class="form-row">
            <div class="col-12 col-sm-2 text-center my-auto">
              <label for="adresdostavki">Адрес доставки:</label>
            </div>
            <div class="col-12 col-sm-7">
              <input class="form-control" type="text" id="adresdostavki" name="adresdostavki" value=""/>
            </div>
            <div class="col-12 col-sm-3 text-center">
              <div class="checkbox-other">
                <input type="checkbox" value="Да" id="saveadresdostavki" name="saveadresdostavki">
                <label for="saveadresdostavki">По адресу объекта</label>
              </div>
            </div>
          </div>
        </div>

        <div class="my-2 border-bottom">
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
                      <input type="checkbox" value="Оплата наличными" id="payki" name="payki" checked><span id="paykides1"  style="display: none">Оплата наличными</span><span id="paykides2">Оплата Кадастравому инженеру</span>
                  </label>
              </div>
              <div class="col-sm-4">
                  <label class="checkbox-other" title="Оплата производится переводом по номеру телефона или номеру карты.">
                      <input type="checkbox" value="Оплата переводом" id="paytrans" name="paytrans">Оплата переводом
                  </label>
              </div>
          </div>
        </div>

        <div>
          <br>
          <div class="row">
              <div class="col-sm-10">
                  <p><strong>Что делать, земельный участок имеет ограничения и расположен в границах полос воздушных подходов аэродромов?</strong></p>
              </div>
              <div class="col-sm-2">
                  <p id="morendescr1"  style="cursor: pointer" class="text-right" onclick="SM('descr1','morendescr1','lessndescr1')" >Подробнее &#8595;</p>

              </div>
          </div>
          <div id="descr1" style="word-wrap: break-word; display: none">
              <p><span>В случае если земельный участок имеет ограничения и расположен в границах полос воздушных подходов аэродромов, необходимо получить согласование размещения объекта с федеральным органом исполнительной власти, осуществляющим функции по оказанию государственных услуг и управлению государственным имуществом в сфере воздушного транспорта (Межрегиональным территориальным управлением воздушного транспорта Центральных районов Федерального агентства воздушного транспорта).</span><br /><br /><span>Необходимая для получения согласования информация размещена на официальном сайте МТУ ВТ ЦР Росавиации:&nbsp;</span><a href="http://mtuvtcrfavt.ru/documents/670.html" target="_blank" rel="noopener">http://mtuvtcrfavt.ru/documents/670.html</a><br /><br /><span>Как узнать об ограничениях, действующих в отношении Вашего земельного участка:</span><br /><br /><span>- получить государственную услугу &laquo;Подготовка градостроительного плана земельного участка в городе Москве&raquo; посредством обращения на портал Мэра Москвы&nbsp;</span><a href="https://www.mos.ru" target="_blank">mos.ru</a><span>&nbsp;или&nbsp;</span><a href="https://mosreg.ru" target="_blank" >mosreg.ru</a><span>&nbsp;или&nbsp;</span><a href="https://mosgosreg.ru" target="_blank" >mosgosreg.ru</a><span>&nbsp;(у Нас).</span></p>
          </div>
          <p id="lessndescr1" onclick="SL('descr1','morendescr1','lessndescr1')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
        </div>

        <div>
          <div class="row">
              <div class="col-sm-10">
                  <p><strong>Нормативно-правовые документы:</strong></p>
              </div>
              <div class="col-sm-2">
                  <p id="morendescr2"  style="cursor: pointer" class="text-right" onclick="SM('descr2','morendescr2','lessndescr2')" >Подробнее &#8595;</p>
              </div>
          </div>
          <div id="descr2" style="word-wrap: break-word; display: none">
              <p><span>&bull; Федеральный закон от 13.07.2015 № 218-ФЗ &laquo;О государственной регистрации недвижимости&raquo;;</span><br /><span>&bull; Федеральный закон от 30.12.2004 № 214-ФЗ &laquo;Об участии в долевом строительстве многоквартирных домов и иных объектов недвижимости&raquo;;</span><br /><span>&bull; Приказ Минэкономразвития России от 16.12.2015 № 943 &laquo;Об установлении порядка ведения Единого государственного реестра недвижимости, формы специальной регистрационной надписи на документе, выражающем содержание сделки, состава сведений, включаемых в специальную регистрационную надпись на документе, выражающем содержание сделки, и требований к ее заполнению, а также требований к формату специальной регистрационной надписи на документе, выражающем содержание сделки, в электронной форме, порядка изменения в Едином государственном реестре недвижимости сведений о местоположении границ земельного участка при исправлении реестровой ошибки&raquo;;</span><br /><span>&bull; Приказ Минэкономразвития России от 23.12.2015 № 967 &laquo;Об утверждении порядка взимания и возврата платы за предоставление сведений, содержащихся в Едином государственном реестре недвижимости, и иной информации&raquo;;</span><br /><span>&bull; Приказ Минэкономразвития России от 23.12.2015 № 968 &laquo;Об установлении порядка предоставления сведений, содержащихся в Едином государственном реестре недвижимости, и порядка уведомления заявителей о ходе оказания услуги по предоставлению сведений, содержащихся в Едином государственном реестре недвижимости&raquo;.</span><br /><span>Оформите заявку на сайте, мы свяжемся с вами в ближайшее время и ответим на все интересующие вопросы.</span></p>                        </div>
          <p id="lessndescr2" onclick="SL('descr2','morendescr2','lessndescr2')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>
        </div>


        <input type="hidden" id="cost" name="cost" value=""/>
        <input type="hidden" id="cadnumber" name="cadnumber" value="{{$obj['CADNOMER']}}"/>
        <input type="hidden" id="type" name="type" value="{{$type}}"/>
        @include('partials.services.btnzakaz')
      </form>
    </div>
  </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">Технический план здания</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Технический план здания – это документ, который содержит подробные сведения о месторасположении, площади, габаритах и характерных особенностях планировки. На все строения требуется технический план. Требования к формату самого документа, который, кстати, изготавливается в электронном виде и записывается на цифровой наситель, установлены статьей 24  Федерального закона "О государственной регистрации недвижимости" от 13.07.2015 N 218-ФЗ. Технический план является неотъемлемой частью комплекта документов, без которого ни один объект капитального строения нельзя поставить на кадастровый учет.</p>
        <p>Со вступлением в силу с 1 января 2017 года 218-ФЗ поменялись требования к формату документов. Ранее на здания выдавали технические паспорта и в них содержалась практически та же информация, что на сегодняшний день содержится в техплане, разве что техплан стал более расширенной версией техпаспорта и строение теперь обязательно привязывают к земле (каждое здание обязательно должно иметь свои координаты, которые после постановки на кадастровый учет будут отражаться на публичной кадастровой карте).</p>
        <p>Новые правила кадастрового учета появились значительно недавно. Ранее, зданиям присваивали кадастровые номера не учитывая  координаты и теперь, часть ранее зарегистрированных объектов не отражается на кадастровой карте, так как не имеют четких координат. То есть имеющийся пакет документов, на уже построенные здания является законным и действительным, но не обновленным с учетом положений законодательства и не внесенным в базу Росреестра так как положено.</p>
        <p>Любое недвижимое имущество должно быть поставлено на кадастровый учет в органы Росреестра, а сам кадастровый учет без составления и предъявления техплана на строение невозможен.</p>
        <p>Требования к техническому плану капитальных строений едины. Любой технический план всегда состоит из двух частей: текстовой и графической. Текст расшифровывает графические изображения, кроме того, в текстовой части содержится перечень документов, послуживших основанием подготовки техплана, сведения о кадастровом инженере, который его готовил, сведения о геодезических измерениях.</p>
        <p>Графическая часть дает понять какова этажность здания, внутренние габариты и схематичное изображение стен, перегородок, лестниц окон. При подготовке техплана учитываются требования к точности и методам определения координат характерных точек границ, утвержденные Приказом Минэкономразвития России от 01.03.2016 № 90, а также положения Приказа Минэкономразвития России от 18.12.2015 N 953 «Об утверждении формы технического плана и требований к его подготовке».</p>
      </div>
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
