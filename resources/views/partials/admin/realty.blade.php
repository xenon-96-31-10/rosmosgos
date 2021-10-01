<form id="orderRealty" method="post" class="needs-validation" novalidate>
  @csrf
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
                <p><del><span id="priceregpravald">{{$discounts['Оформление права собственности на жилой дом']}}</span> руб.</del> <span style="color: red;" id="priceregpraval"></span><span style="color: red;">{{$costs['Оформление права собственности на жилой дом']}} руб.</span></p>
            </label>
            <div class="mb-3" id="regpravalareablock" style="display: none;">
              <p>При выборе данного строения собственнику необходимо указать примерную площадь.</p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="regpravalareaprepend">Примерная площадь:</span>
                </div>
                <input type="text" class="form-control" id="regpravalarea" name="regpravalarea" aria-describedby="regpravalareaprepend">
              </div>
            </div>
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
                <p><del><span id="priceegrnd">{{$discounts['Постановка на учет (ранее зарегистрированного строения)']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Постановка на учет (ранее зарегистрированного строения)']}} руб.</span></p>
            </label>
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
              <p>При выборе данного строения собственнику необходимо указать примерную площадь.</p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="livinghouseareaprepend">Примерная площадь:</span>
                </div>
                <input type="text" class="form-control" id="livinghousearea" name="livinghousearea" aria-describedby="livinghouseareaprepend">
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
                <p><del><span id="priceegrnd">{{$discounts['Получение официальной выписки из ЕГРН']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Получение официальной выписки из ЕГРН']}} руб.</span></p>
            </label>
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
              <p><del><span id="priceegrnd">{{$discounts['Справка о кадастровой стоимости']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Справка о кадастровой стоимости']}} руб.</span></p>
          </label>
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
              <p><del><span id="priceegrnd">{{$discounts['Проверка объекта на арест']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Проверка объекта на арест']}} руб.</span></p>
          </label>
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
              <p><del><span id="priceegrnd">{{$discounts['Выписка из ЕГРП о переходе прав']}}</span> руб.</del> <span style="color: red;" id="priceegrn"></span><span style="color: red;">{{$costs['Выписка из ЕГРП о переходе прав']}} руб.</span></p>
          </label>
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
                    <p><del><span id="pricegpd">{{$discounts['Госпошлина за жилой дом']}}</span> руб.</del> <span style="color: red;" id="pricegp">{{$costs['Госпошлина за жилой дом']}}</span><span style="color: red;"> руб.</span></p>
                </label>
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
                    <p><del><span id="pricegpnd">{{$discounts['Госпошлина за нежилое строение']}}</span> руб.</del> <span style="color: red;" id="pricegpn">{{$costs['Госпошлина за нежилое строение']}}</span><span style="color: red;"> руб.</span> x <span id="countnlh"></span></p>
                </label>
        </tr>
    </table>
  </div>

  <div id="sposob1" style="display: none">
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
                        <p><del><span id="pricerted">{{$discounts['Получить результаты на email']}}</span> руб.</del> <span style="color: red;" id="pricerte">{{$costs['Получить результаты на email']}}</span><span style="color: red;"> руб.</span></p>
                    </label>
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
                        <p><del><span id="pricebvkd">{{$discounts['Курьером в бумажном виде']}}</span> руб.</del> <span style="color: red;" id="pricebvk">{{$costs['Курьером в бумажном виде']}}</span><span style="color: red;"> руб.</span></p>
                    </label>
            </tr>
        </table>
    </div>
  </div>

  <div id="sposob2" style="display: none">
    <div class="my-2 border-bottom" >
        <table width="100%" cellspacing="0" cellpadding="5">
            <tr>
                <td width="10%" valign="top">
                    <div class="checkbox-other">
                        <input type="checkbox" value="Запись тех паспорта на CD" id="zapistpnacd" name="zapistpnacd" class="summa" onclick="Summa()">
                    </div>
                </td>
                <td valign="top">
                    <label class="checkbox-other" for="zapistpnacd">
                        <p>Запись тех. паспорта на CD</p>
                        <p><del><span id="pricepcdd">{{$discounts['Запись тех паспорта на CD']}}</span> руб.</del> <span style="color: red;" id="pricepcd">{{$costs['Запись тех паспорта на CD']}}</span><span style="color: red;"> руб.</span></p>
                    </label>
                </td>
            </tr>
        </table>
    </div>
    <div class="my-2 border-bottom" >
        <table width="100%" cellspacing="0" cellpadding="5">
            <tr>
                <td width="10%" valign="top">
                    <div class="checkbox-other">
                        <input type="checkbox" value="Доставка тех паспорта курьером" id="tpkurierom" name="tpkurierom" class="summa" onclick="Summa()">
                    </div>
                </td>
                <td valign="top">
                    <label class="checkbox-other" for="tpkurierom">
                        <p>Доставка тех. паспорта курьером</p>
                        <p><del><span id="pricetpkd">{{$discounts['Доставка тех паспорта курьером']}}</span> руб.</del> <span style="color: red;" id="pricetpk">{{$costs['Доставка тех паспорта курьером']}}</span><span style="color: red;"> руб.</span></p>
                    </label>
                </td>
            </tr>
        </table>
    </div>
  </div>



  <div class="form-group p-2 border bg-white" id="divscrolitog">
    <div class="text-center text-sm-left">
      <input type="hidden" id="cost" name="cost" value=""/>
      <input type="hidden" id="type" name="type" value="{{$type}}"/>

      <p class="h3">К оплате: <strong><span class="text-success" id="itogcost">0</span></strong> руб.</p>
      <p class="h4">Скидка: <span  class="text-danger" id="discount">0</span> руб.</p>
    </div>
  </div>
  <span id="stopscroll"></span>

</form>
