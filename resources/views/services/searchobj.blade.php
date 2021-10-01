@extends('layouts.app')

@section('title')Поиск объекта недвижимости@endsection

@section('content')
<div class="container my-5">
  <div class="row rounded border shadow justify-content-center p-3 mb-3">
      <div class="col-4 col-sm-2 text-center">
          <a class="btn btn-outline-custom btn-block" href="{{ route('home') }}">Назад</a>
      </div>
      <div class="col-8 col-sm-10 my-auto">
          <div class="progress" style="height: 20px;">
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 30%;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Шаг 1</div>
          </div>
      </div>
  </div>
    <div class="row rounded border shadow justify-content-center p-3">
      <div class="col-12">
        <form id="searchobjForm" method="post" class="needs-validation" novalidate>
          @csrf
          <input type="hidden" name="typeservices" id="typeservices" value="{{ $type }}">
          <div class="form-row">
            <div class="col-12 col-sm-10 mb-2 mb-sm-0">
              <input class="form-control form-control-lg" type="text" id="datatosearchkn" name="datatosearchkn" value="" placeholder="Введите кадастровый номер или адрес объекта" autofocus>
            </div>
            <div class="col-12 col-sm-2 my-auto">
              <button type="submit" class="btn btn-custom btn-block" id="btnsearch">
                <span class="spinner-grow spinner-grow-sm d-none" id="btnsearchspinner" role="status" aria-hidden="true"></span>
                Поиск
              </button>
            </div>
            <div class="col-12 mt-2">
              @if(\Session::has('error-search'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <div class="alert alert-danger alert-dismissible fade show d-none mt-2" id="messageblock" role="alert">
                <span id="message"></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <p>Например, <span class="pointer" id="knexample" onclick="examplesearch('knexample')">50:27:0030710:493</span> или <span class="pointer" id="adresexample" onclick="examplesearch('adresexample')">г Москва, ул Кремль, д 1</span></p>
            </div>
            <div class="col-12 d-none" id="loadingblock">
              <span class="spinner-border text-custom" style="width: 1.5rem; height: 1.5rem;" role="status"></span>
              <span class="text-custom">Запрос может выполняться более 2-х минут</span>
            </div>
          </div>

        </form>
      </div>
    </div>
</div>
@include('partials.mainpage.consult')
@include('partials.mainpage.modalcontacts')
@endsection

@section('scripts')
<script src="{{ asset('js/services.js') }}" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $("#phoneclient").inputmask({"mask": "+7(999)999-9999","autoUnmask" : true, "removeMaskOnSubmit" : true });
    $("#phoneclient2").inputmask({"mask": "+7(999)999-9999","autoUnmask" : true, "removeMaskOnSubmit" : true });
    });
</script>
@endsection
