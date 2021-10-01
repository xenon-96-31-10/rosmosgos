@extends('layouts.app')

@section('title') ЛК инженера@endsection
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-sm-8 order-2 order-sm-1">
          <div class="card mt-3">
              <div class="card-header text-custom b-left">
                <h3>{{$type_title}}</h3>
              </div>
              <div class="table-responsive text-left" style="height: auto; overflow: auto; max-height: 500px">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Адрес</th>
                      <th scope="col">Цена</th>
                      <th scope="col">Услуга</th>
                      <th scope="col">Подробнее</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($myorders as $order)
                    @if($order->order()->first()->status == 'Закрыт')
                    <tr>
                      <th scope="row">{{$order->order()->first()->id}}</th>
                      <td>{{$order->order()->first()->rosreestr->adres}} </td>
                      <td>{{$order->order()->first()->cost}} &#8381;</td>
                      <td>
                        @if($order->order()->first()->data_type == 'App\Models\Realty')
                        Оформление построек
                        @elseif($order->order()->first()->data_type == 'App\Models\Geo')
                        Геодезические работы
                        @elseif($order->order()->first()->data_type == 'App\Models\Plot')
                        Оформление земельных участков
                        @endif
                      </td>
                      <td>
                        <a href="{{route('ki.myorder', ['id' => $order->order()->first()->id])}}" class="btn btn-custom">Открыть</a>
                      </td>
                    </tr>
                    @endif
                    @endforeach
                  </tbody>
                </table>
              </div>
          </div>
        </div>
        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
          @include('partials.kinav', [ 'active' => 'close'])
        </div>
    </div>
</div>
@endsection
