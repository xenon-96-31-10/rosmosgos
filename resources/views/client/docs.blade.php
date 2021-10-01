@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-sm-8 order-2 order-sm-1">
          @if (session('status'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Вы успешно зарегистрировались!</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
          @endif
          @if ($bio == "null")
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Пожалуйста, заполните <a class="text-danger" href="{{ route('personality') }}">персональные данные</a>.</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
          @endif


          <div class="card rounded border shadow">
            <div class="card-header">
              <h1 class="card-title text-custom">Документы</h1>
            </div>
            <div class="card-body">
              <ul>
                @foreach($files as $file)
                  @if(pathinfo($file)['filename'] == 'dogovor')
                    <li>
                      <a href="{{Storage::url($file)}}" download>Договор</a>
                    </li>
                  @elseif(pathinfo(Storage::url($file))['filename'] == 'скан_паспорта')
                    <li>
                      <a href="{{Storage::url($file)}}" download>Копия паспорта</a>
                    </li>
                  @else
                    <li>
                      <a href="{{Storage::url($file)}}" download>Копия доверенности</a>
                    </li>
                  @endif
                @endforeach
                @foreach($orders as $order)
                  <hr>
                  <h3>Заказ № {{$order->id}}</h3>
                  @foreach($order->docs()->get() as $file)
                  <li>
                    <a href="{{Storage::url($file->path)}}" download>{{$file->name}}</a>
                  </li>
                  @endforeach
                  @if(count($order->docs()->get())== 0)
                  <li>Нет доступных документов</li>
                  @endif
                @endforeach
              </ul>

            </div>
          </div>

        </div>
        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
          @include('partials.client.clientnav', [ 'active' => 'docs'])
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/client.js') }}" type="text/javascript"></script>
@endsection
