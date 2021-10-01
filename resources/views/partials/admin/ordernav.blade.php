<div class="btn-toolbar justify-content-end" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-2" role="group" aria-label="First group">
    <a href="{{ route('admin') }}" type="button" class="btn btn-custom">Все услуги</a>
  </div>
  <div class="btn-group mr-2" role="group" aria-label="Second group">
    <a href="{{ route('admin.orders', ['type' => 'realty']) }}" type="button" class="btn btn-custom">1</a>
    <a href="{{ route('admin.orders', ['type' => 'geo']) }}" class="btn btn-custom">2</a>
    <a href="{{ route('admin.orders', ['type' => 'plot']) }}" class="btn btn-custom">3</a>
    <a href="{{ route('admin') }}" class="btn btn-custom">4</a>
  </div>
  <div class="btn-group mt-1 mt-sm-0" role="group" aria-label="Third group">
    <a href="{{ route('admin.orders', ['type' => 'in-procces'])}}" type="button" class="btn btn-custom">В работе</a>
  </div>
</div>
