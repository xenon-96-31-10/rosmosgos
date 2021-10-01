@extends('layouts.app')

@section('title') ЛК администратора@endsection
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-sm-8 order-2 order-sm-1">
          @isset($response)
              <div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
                  <p><strong>{{$response}}</strong></p>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
          @endisset
          <div class="card">
              <div class="card-header text-custom b-left">
                <h3>
                  @if($order->data_type == 'App\Models\Realty')
                  Закаказ № {{$order->id}} по услуге "Оформление построек"
                  @elseif($order->data_type == 'App\Models\Geo')
                  Закаказ № {{$order->id}} по услуге "Геодезические работы"
                  @endif
                </h3>
                <p class="lead">{{$order->rosreestr->adres}} | Регион: {{$order->region}}</p>
                <p class="lead">Статус для клиента: <span class="text-info">{{$order->status}}</span></p>
                <p class="lead">
                  <span class="text-success">{{$order->sposobpay}}</span> |
                  @if($order->statuspay == 'Не оплачен')
                  <span class="text-danger">{{$order->statuspay}}</span> |
                  @else
                  <span class="text-success">{{$order->statuspay}}</span> |
                  @endif
                  <span class="text-success">{{$order->cost}} &#8381;</span>
                </p>

              </div>
          </div>
          <div class="accordion" id="accordionExample">
            <div class="card  border-bottom mt-3">
              <div class="card-header b-left" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-lg btn-block text-dark" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Информация о заказе
                  </button>
                </h5>
              </div>

              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  <h5>Выбранные услуги: </h5>
                  <ul>
                    @foreach ($data as $item)
                      @if($item != " ")
                        <li>{{ $item }}</li>
                      @endif
                    @endforeach
                  </ul>
                  @if($order->data_type == 'App\Models\Realty')
                  <h5>Выбранная дата приезда Кадастрового Инженера: {{$info->dateki}}</h5>
                  <h5>Адрес доставки документов: {{$info->adresdostavki}}</h5>
                  @elseif($order->data_type == 'App\Models\Geo')
                  <h5>Выбранная дата приезда Кадастрового Инженера: {{$info->datespec}}</h5>
                  @endif
                  <hr>
                  <h5>{{$order->user()->first()->bio()->first()->familia ?? 'Клиент еще не заполнил персональные данные'}} {{$order->user()->first()->bio()->first()->name ?? '-'}} {{$order->user()->first()->bio()->first()->lastname ?? '-'}}</h5>
                  <h5>Телефон клиента: <a href="tel:+{{$order->user()->first()->phone}}">+{{$order->user()->first()->phone}}</a></h5>
                  <h5>Email: <a href="mailto:{{$order->user()->first()->email}}">{{$order->user()->first()->email}}</a></h5>
                </div>
              </div>
            </div>




            <div class="card border-bottom mt-3">
              <div class="card-header b-left" id="heading3">
                <h5 class="mb-0">
                  <button class="btn btn-lg btn-block text-dark" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    Заметки
                  </button>
                </h5>
              </div>

              <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
                <div class="card-body mb-2">
                  @foreach($order->quotes as $quote)
                  <div class="alert alert-info mt-2" role="alert">
                    {{$quote->text}}
                  </div>
                  @endforeach
                </div>

              </div>
            </div>

            <div class="card border-bottom mt-3">
              <div class="card-header b-left" id="heading4">
                <h5 class="mb-0">
                  <button class="btn btn-lg btn-block text-dark" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    Дополнительно
                  </button>
                </h5>
              </div>

              <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
                <div class="card-body mb-2">
                  @foreach($order->refuses as $refuse)
                  <div class="alert alert-danger mt-2" role="alert">
                    Отказ по причине: {{$refuse->refuse}}
                  </div>
                  @endforeach
                </div>

              </div>
            </div>

          </div>


          <div class="card border-bottom mt-3">
            <div class="card-header b-left">
              Документы
            </div>
            <div class="card-body">
              <h5 class="card-title">Клиента</h5>
              @foreach($client_files as $file)
              <li>
                <a href="{{$file}}" download>{{pathinfo($file)['filename']}}</a>
              </li>
              @endforeach
              <hr>
              @foreach($order_files as $file)
              <li>
                <a href="{{$file}}" download>{{pathinfo($file)['filename']}}</a>
              </li>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
          @include('partials.admin.adminnav', [ 'active' => 'null'])
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/ki.js') }}" type="text/javascript"></script>
@endsection
