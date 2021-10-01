<div class="list-group sticky-top">
  <a href="{{ route('ki') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'orders') active @endif">
    Все заявки
    @isset($orders)
    <span class="badge badge-light badge-pill">{{count($orders)}}</span>
    @endisset
  </a>
  <a href="{{ route('ki.myorders') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'myorders') active @endif">
    Мои заявки в работе
  </a>
  <a href="{{ route('ki.mycloseorders') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'close') active @endif">
    Закрытые заявки
  </a>
  <a href="{{ route('ki.personality') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'personality') active @endif">
    Профиль
  </a>
  @if(auth()->user()->hasRole('admin'))
  <a href="{{ route('admin') }}" class="list-group-item list-group-item-custom list-group-item-action d-flex justify-content-between align-items-center @if($active == 'personality') active @endif">
    Панель администратора
  </a>
  @endif
</div>
