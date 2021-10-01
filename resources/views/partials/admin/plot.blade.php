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
            </label>
            <div class="mb-1" id="sqmezhblock" style="display: none">
              <p>Укажите пожалуйста примерную площадь земельного участка (в сотках)</p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="sqmezhprepend">Примерная площадь:</span>
                </div>
                <input type="number" class="form-control summa" id="sqmezh" name="sqmezh" step="1" placeholder="Площадь участка" value="" min="0" aria-describedby="sqmezhprepend" onclick="Summa()" onchange="Summa()">
              </div>
              <button type="button" name="sqmezhbtn" class="btn btn-custom my-2" id="sqmezhbtn" style="display:none;" onclick="BtnChange('sqmezh')">Изменить</button>
            </div>
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
            <label class="checkbox-other" for="mezhplot">
                <p>Раздел земельного участка</p>
            </label>
            <div class="mb-1" id="colpieblock" style="display: none">
              <p>Укажите количество частей, на которые будет разделен участок (от 2 и более)</p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="colpieprepend">Колличество частей:</span>
                </div>
                <input type="number" class="form-control summa" id="colpie" name="colpie" step="1" placeholder="Колличество частей" value="" min="2" aria-describedby="colpieprepend" onclick="Summa()" onchange="Summa()">
              </div>
              <button type="button" name="colpiebtn" class="btn btn-custom my-2" id="colpiebtn" style="display:none;" onclick="BtnChange('colpie')">Изменить</button>
            </div>
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
                <p><del><span id="priceservd">{{$discounts['Оформление сервитута']}}</span> руб.</del> <span style="color: red;" id="priceserv"></span><span style="color: red;">{{$costs['Оформление сервитута']}} руб.</span></p>
            </label>
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
            </label>
            <div class="mb-1" id="colpeaceblock" style="display: none">
              <p>Укажите количество участков (от 2 и более), которые будут объединены в один участок </p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="colpeaceprepend">Колличество частей:</span>
                </div>
                <input type="number" class="form-control summa" id="colpeace" name="colpeace" step="1" placeholder="Колличество частей" value="" min="2" aria-describedby="colpeaceprepend" onclick="Summa()" onchange="Summa()">
              </div>
              <button type="button" name="colpeacebtn" class="btn btn-custom my-2" id="colpeacebtn" style="display:none;" onclick="BtnChange('colpeace')">Изменить</button>
            </div>
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
                <p><del><span id="priceerplotd">{{$discounts['Исправление реестровой ошибки']}}</span> руб.</del> <span style="color: red;" id="priceerplot"></span><span style="color: red;">{{$costs['Исправление реестровой ошибки']}} руб.</span></p>
            </label>
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
                <p><del><span id="priceexpertplot">{{$discounts['Исправление реестровой ошибки']}}</span> руб.</del> <span style="color: red;" id="priceexpertplot"></span><span style="color: red;">{{$costs['Исправление реестровой ошибки']}} руб.</span></p>
            </label>
        </td>
    </tr>
  </table>


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
