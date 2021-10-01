<div class="row rounded border b-left shadow justify-content-center p-3 mb-3">
  <div class="col-12">
    <h3 id="adresspan">{{$obj['ADDRESS']}}</h3>
    <p class="text-muted">Кадастровый номер: {{$obj['CADNOMER']}}</p>
    <div id="cdinfo" style="display: none">
      <p>Тип: <strong>{{$obj['TYPE']}}</strong></p>
      <p>Площадь: <strong>{{$obj['AREA']}}</strong></p>
      <p>Категория земель: <strong>{{$obj['CATEGORY']}}</strong></p>
    </div>
    <p id="morecdinfo" onclick="SM('cdinfo','morecdinfo','lesscdinfo')" class="text-left pointer">Об объекте недвижимости &#8595;</p>
    <p id="lesscdinfo" onclick="SL('cdinfo','morecdinfo','lesscdinfo')" class="text-left pointer" style="display: none">Об объекте недвижимости &#8593;</p>
  </div>
</div>
