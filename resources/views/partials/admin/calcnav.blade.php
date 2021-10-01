<div class="btn-toolbar justify-content-end mb-1" role="toolbar" aria-label="Toolbar with button groups">
  <span class="lead mr-2 my-auto">Услуга</span>
  <div class="btn-group mr-2" role="group" aria-label="Second group">
    <a href="{{ route('admin.showcalc', ['type' => 'realty', 'region' => 'Москва' ]) }}" type="button" class="btn btn-custom">1</a>
    <a href="{{ route('admin.showcalc', ['type' => 'geo', 'region' => 'Москва' ]) }}" class="btn btn-custom">2</a>
    <a href="{{ route('admin.showcalc', ['type' => 'plot', 'region' => 'Москва' ]) }}" class="btn btn-custom">3</a>
    <a href="{{ route('admin.showcalc', ['type' => 'realty', 'region' => 'Москва' ]) }}" class="btn btn-custom">4</a>
  </div>
  <span class="lead mr-2 my-auto">Регион</span>
  <div class="btn-group mr-2" role="group" aria-label="Second group">
    <a href="{{ route('admin.showcalc', ['type' => $type, 'region' => 'Москва' ]) }}" type="button" class="btn btn-custom">Москва</a>
    <a href="{{ route('admin.showcalc', ['type' => $type, 'region' => 'Московская область' ]) }}" class="btn btn-custom">МО</a>
    <a href="{{ route('admin.showcalc', ['type' => $type, 'region' => 'Регионы' ]) }}" class="btn btn-custom">Регионы</a>
  </div>
</div>
