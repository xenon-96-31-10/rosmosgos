@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-sm-8 order-2 order-sm-1">
          @if($bio== 'null')
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Пожалуйста, заполните персональные данные для отправки заявки на рассмотрение.</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <div class="card">
              <div class="card-header text-center text-custom">
                <h3>{{ __('Персональные данные') }}</h3>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('ki.savebio') }}">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group mb-3">
                      <label for="familia">Фамилия</label>
                      <input type="text" class="form-control" id="familia" name="familia" value="{{ old('familia') }}" placeholder="Иванов" required>
                      <label class="mt-1" for="name">Имя</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Петр" required>
                      <label class="mt-1" for="lastname">Отчество</label>
                      <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}" placeholder="Михайлович" required>
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="sertificate-prepend">Аттестат</span>
                      </div>
                      <input type="text" class="form-control" id="sertificate" name="sertificate" value="{{ old('sertificate') }}" aria-label="Default" aria-describedby="snils-prepend" required>
                    </div>

                    <div class="form-group mb-3">
                      <label for="region">Регион</label>
                      <input type="text" class="form-control" id="region" name="region" value="{{ old('region') }}" aria-label="Default" required>
                      <small id="regionHelp" class="form-text text-muted">Вводите без области/края/республики, как предлагает подсказка.</small>

                    </div>

                    <button type="submit" class="btn btn-custom">Отправить на проверку</button>

                </form>
              </div>
          </div>
          @else
          @isset($response)
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <p><strong>{{$response}}</strong></p>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
          @endisset
          <div class="card">
              <div class="card-header text-center text-custom">
                <h3>{{ __('Персональные данные') }}</h3>
              </div>
              <div class="card-body">
                <ul>
                  <li>ФИО: {{$bio->familia}} {{$bio->name}} {{$bio->lastname}}</li>
                  <li>Сертификат: {{$bioki->sertificate}}</li>
                  <li>Регион: {{$bioki->region}}</li>
                </ul>
              </div>
          </div>
          @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/ki.js') }}" type="text/javascript"></script>
@endsection
