<div class="row fixed-bottom p-2 border bg-white" id="divscrolitog">
  <div class="col-12">
    <div class="alert alert-danger alert-dismissible fade show d-none mt-2" id="messageblock" role="alert">
      <span id="message"></span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  <div class="col-12 col-sm-4"></div>
  @if($type == 'realty')
  <div class="col-12 col-sm-2 my-auto">
    <button type="button" id="btnrealty" class="btn btn-block btn-lg btn-custom"  onclick="ValidationZakaz();">
      <span class="spinner-grow spinner-grow-sm d-none" id="btnrealtyspinner" role="status" aria-hidden="true"></span>
      Заказать
    </button>
  </div>
  @elseif($type == 'geo')
  <div class="col-12 col-sm-2 my-auto">
    <button type="button" id="btnrealty" class="btn btn-block btn-lg btn-custom"  onclick="ValidationZakaz2();">
      <span class="spinner-grow spinner-grow-sm d-none" id="btnrealtyspinner" role="status" aria-hidden="true"></span>
      Заказать
    </button>
  </div>
  @elseif($type == 'plot')
  <div class="col-12 col-sm-2 my-auto">
    <button type="button" id="btnrealty" class="btn btn-block btn-lg btn-custom"  onclick="ValidationZakaz3();">
      <span class="spinner-grow spinner-grow-sm d-none" id="btnrealtyspinner" role="status" aria-hidden="true"></span>
      Заказать
    </button>
  </div>
  @endif
  <div class="col-12 col-sm-6 text-center text-sm-left">
    <p class="h3">К оплате: <strong><span class="text-success" id="itogcost">0</span></strong> руб.</p>
    <p class="h4">Скидка: <span  class="text-danger" id="discount">0</span> руб.</p>
  </div>
</div>
<span id="stopscroll"></span>
