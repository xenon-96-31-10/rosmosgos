<div class="container mt-2">
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{Storage::url('img/logo.png')}}" width="200" height="200" alt="Логотип RosMosGos">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mx-auto">
          @guest
          <li class="nav-item">
              <a class="nav-link" href="#aboutus">О нас</a>
          </li>

          <li class="nav-item">
              <a class="nav-link" href="#services">Услуги</a>
          </li>

          <li class="nav-item">
              <a class="nav-link" href="#">Политика конфиденциальности</a>
          </li>

          <li class="nav-item">
              <a class="nav-link" href="#footer">Контакты</a>
          </li>
          @else
          <li class="nav-item">
              <a class="nav-link" href="/">Главная</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">Политика конфиденциальности</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">Контакты</a>
          </li>
          @endguest
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" data-toggle="tooltip" data-placement="bottom" title="Регистрация для Исполнителей">{{ __('Регистрация') }} <i class="fas fa-user-plus"></i></a>
                    </li>
                @endif

                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }} <i class="fas fa-sign-in-alt"></i></a>
                    </li>
                @endif
            @else
            @if(Route::is('home'))
              <li class="nav-item">
                <a class="nav-link" href="@role('client'){{ route('client')}}@endrole @role('ki'){{ route('ki')}}@endrole">
                  Личный кабинет
                  <i class="fas fa-sign-in-alt"></i>
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Выход') }}
                    <i class="fas fa-sign-out-alt"></i>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </li>
            @endguest
        </ul>
    </div>
  </nav>
</div>
