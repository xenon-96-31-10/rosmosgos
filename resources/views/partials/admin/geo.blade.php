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
            </label>
            <div class="mb-1" id="sqzemuchblock" style="display: none">
              <p>Укажите пожалуйста примерную площадь земельного участка (в сотках)</p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="sqzemuchprepend">Примерная площадь:</span>
                </div>
                <input type="number" class="form-control summa" id="sqzemuch" name="sqzemuch" step="1" placeholder="Площадь участка" value="" min="0" aria-describedby="sqzemuchprepend" onclick="Summa()" onchange="Summa()">
              </div>
            </div>
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
            </label>
            <div class="mb-1" id="vinosgranicblock" style="display: none">
              <p>Укажите пожалуйста количество межевых знаков</p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="colznakovprepend">Количество знаков:</span>
                </div>
                <input type="number" class="form-control summa" id="colznakov" name="colznakov" step="1" placeholder="Количество знаков" value="" min="0" aria-describedby="colznakovprepend" onclick="Summa()" onchange="Summa()">
              </div>
            </div>
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
            </label>
            <div class="mb-1" id="semkacommblock" style="display: none">
              <p>Укажите пожалуйста предполагаемую протяженность трассы (в метрах)</p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="prottrassprepend">Протяженность трассы:</span>
                </div>
                <input type="number" class="form-control summa" id="prottrass" name="prottrass" step="1" placeholder="Протяженность трассы" value="" min="0" aria-describedby="prottrassprepend" onclick="Summa()" onchange="Summa()">
              </div>
            </div>
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

            </label>
            <div class="mb-1" id="razbivkaosblock" style="display: none">
              <p>Укажите пожалуйста предполагаемое количество осей</p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="coloseyprepend">Количество осей:</span>
                </div>
                <input type="number" class="form-control summa" id="colosey" name="colosey" step="1" placeholder="Количество осей" value="" min="0" aria-describedby="coloseyprepend" onclick="Summa()" onchange="Summa()">
              </div>
            </div>
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
            </label>
            <div class="mb-1" id="cadsemzublock" style="display: none">
              <p>Укажите пожалуйста примерную площадь земельного участка (в сотках) </p>
              <div class="input-group" >
                <div class="input-group-prepend">
                  <span class="input-group-text" id="sqzemuccsprepend">Площадь участка:</span>
                </div>
                <input type="number" class="form-control summa" id="sqzemuccs" name="sqzemuccs" step="1" placeholder="Площадь участка" value="" min="0" aria-describedby="sqzemuccsprepend" onclick="Summa()" onchange="Summa()">
              </div>
            </div>
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
