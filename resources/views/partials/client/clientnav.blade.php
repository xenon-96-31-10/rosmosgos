<div class="list-group sticky-top">
  <a href="{{ route('client') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'orders') active @endif">
    Мои заказы
    <span class="badge badge-light badge-pill">{{count($orders)}}</span>
  </a>
  <a href="{{ route('personality') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'personality') active @endif">
    Персональные данные
    @if ($bio == "null")
    <span class="text-danger"><i class="fas fa-bell"></i></span>
    @endif
  </a>
  <a href="{{ route('pay') }}" class="list-group-item list-group-item-custom list-group-item-action @if($active == 'pay') active @endif">Оплата</a>
  <a href="{{ route('docs') }}" class="list-group-item list-group-item-custom list-group-item-action  @if($active == 'docs') active @endif">Документы</a>
</div>
