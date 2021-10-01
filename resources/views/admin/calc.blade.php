@extends('layouts.app')

@section('title') ЛК администратора@endsection
@section('content')
<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-sm-8 order-2 order-sm-1">
      <div class="card">
          <div class="card-header text-custom b-left">
            <h3>{{ __('Калькулятор') }} |
              @if($type == 'realty')
              Оформление построек
              @elseif($type == 'geo')
              Геодезические работы
              @elseif($type == 'plot')
              Оформление земельных участков
              @endif
            </h3>
              @include('partials.admin.calcnav')
          </div>
          <div class="card-body">
            @if($type == 'realty')
              @include('partials.admin.realty')
            @elseif($type == 'geo')
              @include('partials.admin.geo')
            @elseif($type == 'plot')
              @include('partials.admin.plot')
            @endif
          </div>
      </div>
    </div>
    <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
        @include('partials.admin.adminnav', [ 'active' => 'calc'])
    </div>
  </div>

</div>
@endsection

@section('scripts')
<script src="{{ asset('js/ki.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/services.js') }}" type="text/javascript"></script>
<script>
$(document).ready(function () {

  var $element = $('#stopscroll');

    $(window).scroll(function() {
        var scroll = $(window).scrollTop() + $(window).height();
        //Если скролл до конца елемента
        //var offset = $element.offset().top + $element.height();
        //Если скролл до начала елемента
        var offset = $element.offset().top;

        if (scroll > offset) {
            $('#divscrolitog').removeClass('fixed-bottom');
        }
        if(offset > scroll+100){
            $('#divscrolitog').addClass('fixed-bottom');
        }
        if (scroll > offset) {
            $('#divscrolitog2').removeClass('fixed-bottom');
        }
        if(offset > scroll+100){
            $('#divscrolitog2').addClass('fixed-bottom');
        }
    });
  });
</script>
@endsection
