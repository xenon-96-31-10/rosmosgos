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
                  <strong>Пожалуйста, заполните <a class="text-danger" href="{{ route('personality') }}">персональные данные</a> для заключения договора.</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
          @endif

          @foreach($orders as $order)
          <div class="card rounded border shadow mb-2">
            <div class="card-header">
              <h4 class="text-custom">Заказ № {{$order->id}}</h4>
              <h5> Статус: <span class="text-success">{{$order->status}}</span></h5>
            </div>
            <div class="card-body">
              <h5 class="card-title">
                @if($order->data_type == 'App\Models\Realty')
                Услуга: Оформление строений
                @elseif($order->data_type == 'App\Models\Geo')
                Услуга: Геодезические работы
                @elseif($order->data_type == 'App\Models\Plot')
                Услуга: Оформление земельных участков
                @endif
              </h5>
              <div id="{{$order->id}}descr" style="display: none">
                <ul>
                  @foreach ( explode('|', $order->data()->first()->services) as $item)
                    @if($item != " ")
                      <li>{{ $item }}</li>
                    @endif
                  @endforeach
                </ul>
              </div>
              <p class="card-text">Сумма заказа: <span class="text-success">{{$order->cost}}  руб.</span></p>
              <p class="card-text">Способ оплаты: <span class="text-success">{{$order->sposobpay}}</span></p>              
              <p id="more{{$order->id}}"  style="cursor: pointer" class="text-right" onclick="SM('{{$order->id}}descr','more{{$order->id}}','less{{$order->id}}')" >Подробнее &#8595;</p>
              <p id="less{{$order->id}}" onclick="SL('{{$order->id}}descr','more{{$order->id}}','less{{$order->id}}')" class="text-right" style="cursor: pointer; display: none">Скрыть &#8593;</p>

              @if($order->statuspay == 'Не оплачен')
                <p class="text-danger">Заказ: {{$order->statuspay}}</p>
                <a href="#" class="btn btn-custom">Оплатить</a>
              @endif
            </div>
          </div>
          @endforeach
        </div>
        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
          @include('partials.client.clientnav', [ 'active' => 'orders'])
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/client.js') }}" type="text/javascript"></script>
@endsection
