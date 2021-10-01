@extends('layouts.app')

@section('title')Добро пожаловать@endsection

@section('content')
<div class="container mt-5">
    <div class="row rounded border shadow justify-content-center">
      <div class="col-12 text-center">
        <h1 class="border-bottom p-2">Выберите необходимую услугу</h1>
      </div>
      <div class="col-12 col-sm-3 text-center">
        <a class="services-link" href="{{ route('searchobj', ['type' => 'realty']) }}">
          <img src="{{Storage::url('img/Steelstan.svg')}}" width="150" height="150">
          <p class="lead">Оформление построек</p>
        </a>
      </div>
      <div class="col-12 col-sm-3 text-center">
        <a class="services-link" href="{{ route('searchobj', ['type' => 'geo']) }}">
          <img src="{{Storage::url('img/Tdsvet-05.svg')}}" width="150" height="150">
          <p class="lead">Геодезические работы</p>
        </a>
      </div>
      <div class="col-12 col-sm-3 text-center pointer">
        <a class="services-link" href="{{ route('searchobj', ['type' => 'plot']) }}">
          <img src="{{Storage::url('img/Steelstan2.svg')}}" width="150" height="150">
          <p class="lead">Оформление земельных участков</p>
        </a>
      </div>
      <!-- <div class="col-12 col-sm-3 text-center pointer"  onclick="error()">
        <img src="{{Storage::url('img/Tdsvet-02.svg')}}" width="150" height="150">
        <p class="lead">Юридические услуги</p>
      </div> -->

    </div>
</div>
@include('partials.mainpage.about')
@include('partials.mainpage.consult')
@include('partials.mainpage.counter')
@include('partials.mainpage.info')
@include('partials.mainpage.modalcontacts')
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function () {
  $("#phoneclient").inputmask({"mask": "+7(999)999-9999","autoUnmask" : true, "removeMaskOnSubmit" : true });
  $("#phoneclient2").inputmask({"mask": "+7(999)999-9999","autoUnmask" : true, "removeMaskOnSubmit" : true });
  });
</script>
@endsection
