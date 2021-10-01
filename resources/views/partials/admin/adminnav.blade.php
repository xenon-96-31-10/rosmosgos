<div class="list-group sticky-top">
  <a href="{{ route('admin') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'adminpanel') active @endif">
    Панель администратора
  </a>
  <a href="{{ route('admin.finance') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'finance') active @endif">
    Финансовый отчет
  </a>
  <a href="{{ route('ki') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'close') active @endif">
    Кабинет КИ
  </a>
  <a href="{{ route('admin.price', ['type' => 'realty']) }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'price') active @endif">
    Прайс-лист
  </a>
  <a href="{{ route('admin.showcalc', ['type' => 'realty', 'region' => 'Москва']) }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'calc') active @endif">
    Калькулятор
  </a>
  <a href="{{ route('admin.app') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'app') active @endif">
    Заявки от КИ
  </a>
</div>
