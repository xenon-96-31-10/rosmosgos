@extends('layouts.app')

@section('title')Поиск объекта недвижимости@endsection

@section('content')
<div class="container my-5">
  <div class="row rounded border shadow justify-content-center p-3">
    <div class="col-12 border-bottom mb-2">
      <h1>Уточните пожалуйста адрес</h1>
    </div>
    <div class="col-12">
      <form id="phoneticForm" method="post" class="needs-validation" novalidate>
        @csrf
        <input type="hidden" name="typeservices" id="typeservices" value="{{ $type }}">
        <div style="height: auto; overflow: auto; max-height: 300px">
          @foreach($objects as $object)
          <div class="form_radio border-bottom p-2">
            <input type="radio" id="{{$object['CADNOMER']}}" name="cadastrnumber" value="{{$object['CADNOMER']}}">
            <label for="{{$object['CADNOMER']}}">
              <span class="lead text-left">{{$object['ADDRESS']}}</span>

            </label>
            <small class="form-text text-muted">
              <span class="text-right">{{$object['CADNOMER']}}; Тип: {{$object['TYPE']}}</span>
            </small>
          </div>
          @endforeach
        </div>
        <br>
        <div class="row border-top p-2">
          <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show d-none mt-2" id="messageblock" role="alert">
              <span id="message"></span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <div class="col-12 col-sm-3 my-auto">
            <button type="submit" class="btn btn-block btn-lg btn-custom" id="phoneticbtn">
              <span class="spinner-grow spinner-grow-sm d-none" id="phoneticbtnspinner" role="status" aria-hidden="true"></span>
              Выбрать адрес
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/services.js') }}" type="text/javascript"></script>
@endsection
