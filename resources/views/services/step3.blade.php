@extends('layouts.app')

@section('title')Поиск объекта недвижимости@endsection

@section('content')
<div class="container my-5">
  <div class="row rounded border shadow justify-content-center p-3 mb-3">
      <div class="col-4 col-sm-2 text-center">
          <a class="btn btn-outline-custom btn-block" href="{{url()->previous()}}">Назад</a>
      </div>
      <div class="col-8 col-sm-10 my-auto">
          <div class="progress" style="height: 20px;">
              <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 90%;" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Шаг 3</div>
          </div>
      </div>
  </div>

  <div class="row justify-content-center p-3">
    <div class="col-12 col-sm-6 mb-2 mb-sm-0">
      <div class="card shadow">
          <div class="card-header">{{ __('Регистрация') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('register-order', ['type' => $type]) }}">
                @csrf
                <input type="hidden" id="type" name="type" value="{{$type}}"/>
                <div class="form-group row">
                    <label for="register_phone" class="col-md-4 col-form-label text-md-right">{{ __('Ваш телефон') }}</label>

                    <div class="col-md-6">
                        <input id="register_phone" type="text" class="form-control @error('register_phone') is-invalid @enderror" name="register_phone" value="{{ old('register_phone') }}" required autocomplete="register_phone" autofocus>

                        @error('register_phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="register_email" class="col-md-4 col-form-label text-md-right">{{ __('Ваш E-Mail') }}</label>

                    <div class="col-md-6">
                        <input id="register_email" type="email" class="form-control @error('register_email') is-invalid @enderror" name="register_email" value="{{ old('register_email') }}" required autocomplete="register_email">

                        @error('register_email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('Регистрация') }}
                        </button>
                    </div>
                </div>
            </form>
          </div>
      </div>
    </div>
    <div class="col-12 col-sm-6">
      <div class="card shadow">
          <div class="card-header">{{ __('Войдите в систему') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('login-order', ['type' => $type]) }}">
          @csrf
          <input type="hidden" id="type" name="type" value="{{$type}}"/>
          <div class="form-group row">
              <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Ваш телефон') }}</label>

              <div class="col-md-6">
                  <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                  @error('phone')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Ваш пароль') }}</label>

              <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
          </div>

          <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                      <label class="form-check-label" for="remember">
                          {{ __('Запомнить меня') }}
                      </label>
                  </div>
              </div>
          </div>

          <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-custom">
                      {{ __('Войти') }}
                  </button>

                  @if (Route::has('password.reset'))
                      <a class="btn btn-link" target="_blank" href="{{ route('password.reset') }}">
                          {{ __('Забыли свой пароль?') }}
                      </a>
                  @endif
              </div>
          </div>
      </form>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/services.js') }}" type="text/javascript"></script>
<script type="text/javascript">

</script>
@endsection
