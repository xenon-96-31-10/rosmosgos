<div class="btn-toolbar justify-content-end" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group mr-2" role="group" aria-label="First group">
    <a href="{{ route('ki') }}" type="button" class="btn btn-custom">Все услуги</a>
  </div>
  <div class="btn-group mr-2" role="group" aria-label="Second group">
    <a href="{{ route('ki.orders', ['type' => 'realty']) }}" type="button" class="btn btn-custom">1</a>
    <a href="{{ route('ki.orders', ['type' => 'geo']) }}" class="btn btn-custom">2</a>
    <a href="{{ route('ki.orders', ['type' => 'plot']) }}" class="btn btn-custom">3</a>
    <a href="{{ route('ki') }}" class="btn btn-custom">4</a>
  </div>
  <div class="btn-group mt-1 mt-sm-0" role="group" aria-label="Third group">
    <a href="{{ route('ki.orders', ['type' => $bioki->region]) }}" type="button" class="btn btn-custom">По региону</a>
  </div>
</div>
