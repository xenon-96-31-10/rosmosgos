<div class="container rounded border bg-white shadow-sm p-3 my-3">
  <footer id="footer">
    <div id="infocom" class="row">
      <div class="col-12 col-sm-6 p-3">
        <h1 class="text-custom">Заявка на консультацию</h1>
        <form  method="post" action="{{ route('sendFeedback')}}">
          @csrf
          <div class="form-group">
            <label for="nameclient">Ваше Имя</label>
            <input type="text" class="form-control" id="nameclient" name="nameclient" placeholder="Иван">
          </div>
          <div class="form-group">
            <label for="nameclient">Ваш Телефон</label>
            <input type="text" class="form-control" id="phoneclient" name="phoneclient" placeholder="Ваш телефон">
          </div>
          <button type="submit" name="button" class="btn btn-custom btn-lg">Оправить заявку</button>
        </form>
        <hr class="d-block d-sm-none">
      </div>
      <div class="col-12 col-sm-6">
          <h4>Телефон для связи:</h4>
          <h4><a href="tel:+74951082461" style="color: #4F2915">+7 (495) 108-24-61</a></h4>
          <p><a href="privacy.php" target="_blank" style="color: #4F2915">Политика конфедициальности</a></p>
          <p class="small"><span>Общество с ограниченной ответственностью &laquo;АЗИМУТ&raquo;</span><br /><span>ИНН 5036059374</span><br /><span>КПП 503601001</span><br /><span>Юридический адрес:&nbsp;</span><span>142116, Московская обл.,&nbsp;</span><span>г.Подольск, Революционный проспект, д.23, пом.6</span></p>
          <p class="small"><span>ОГРН 1045007203636</span><br /><span>Р/с 40702810300000003997&nbsp;</span><span>в АО &laquo;Райффайзенбанк&raquo;&nbsp;</span>г.Москва<br /><span>БИК 044525700</span><br /><span>К/с 30101810200000000700</span><br /><span>Директор Самсонов Евгений Викторович</span></p>

      </div>
    </div>
    <div class="p-2 text-right">
        <span>&copy Все права защищены законом.</span>
    </div>
  </footer>
</div>
