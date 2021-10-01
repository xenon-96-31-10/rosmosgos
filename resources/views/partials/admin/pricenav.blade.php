<div class="btn-toolbar justify-content-end" role="toolbar" aria-label="Toolbar with button groups">
  <span class="lead mr-2 my-auto">Услуга</span>
  <div class="btn-group mr-2" role="group" aria-label="Second group">
    <a href="{{ route('admin.price', ['type' => 'realty']) }}" type="button" class="btn btn-custom">1</a>
    <a href="{{ route('admin.price', ['type' => 'geo']) }}" class="btn btn-custom">2</a>
    <a href="{{ route('admin.price', ['type' => 'plot']) }}" class="btn btn-custom">3</a>
    <a href="{{ route('admin') }}" class="btn btn-custom">4</a>
  </div>
</div>
