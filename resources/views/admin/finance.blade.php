@extends('layouts.app')

@section('title') ЛК администратора@endsection
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-sm-8 order-2 order-sm-1">
            <div class="card">
                <div class="card-header text-custom b-left">
                  <h3>Финансовый отчет | Заказов на сайте: <span class="badge badge-secondary">{{$finance['Всего заказов']}}</span></h3>
                </div>
                <div class="card-body">
                  <h4 class="title">Оплата банковской картой</h4>
                  <p class="lead">Всего заказов: <span class="badge badge-info text-white">{{$finance['Оплата банковской карточкой']['Всего заказов']}}</span> </p>
                  <p class="lead">Общая стоимость: <span class="badge badge-primary text-white">{{$finance['Оплата банковской карточкой']['Общая стоимость']}} &#8381;</span> </p>
                  <p class="lead">Оплачено и выполнено: <span class="badge badge-success text-white">{{$finance['Оплата банковской карточкой']['Оплачено и выполнено']}} &#8381;</span> </p>
                  <p class="lead">Оплачено и не выполнено: <span class="badge badge-danger text-white">{{$finance['Оплата банковской карточкой']['Оплачено и не выполнено']}} &#8381;</span> </p>
                  <p class="lead">Не оплачено и не выполнено: <span class="badge badge-danger text-white">{{$finance['Оплата банковской карточкой']['Не оплачено и не выполнено']}} &#8381;</span> </p>
                  <hr>
                  <h4 class="title">Оплата наличными</h4>
                  <p class="lead">Всего заказов: <span class="badge badge-info text-white">{{$finance['Оплата наличными']['Всего заказов']}}</span> </p>
                  <p class="lead">Общая стоимость: <span class="badge badge-primary text-white">{{$finance['Оплата наличными']['Общая стоимость']}} &#8381;</span> </p>
                  <p class="lead">Оплачено и выполнено: <span class="badge badge-success text-white">{{$finance['Оплата наличными']['Оплачено и выполнено']}} &#8381;</span> </p>
                  <p class="lead">Оплачено и не выполнено: <span class="badge badge-danger text-white">{{$finance['Оплата наличными']['Оплачено и не выполнено']}} &#8381;</span> </p>
                  <p class="lead">Не оплачено и не выполнено: <span class="badge badge-danger text-white">{{$finance['Оплата наличными']['Не оплачено и не выполнено']}} &#8381;</span> </p>
                  <hr>
                  <h4 class="title">Оплата переводом</h4>
                  <p class="lead">Всего заказов: <span class="badge badge-info text-white">{{$finance['Оплата переводом']['Всего заказов']}}</span> </p>
                  <p class="lead">Общая стоимость: <span class="badge badge-primary text-white">{{$finance['Оплата переводом']['Общая стоимость']}} &#8381;</span> </p>
                  <p class="lead">Оплачено и выполнено: <span class="badge badge-success text-white">{{$finance['Оплата переводом']['Оплачено и выполнено']}} &#8381;</span> </p>
                  <p class="lead">Оплачено и не выполнено: <span class="badge badge-danger text-white">{{$finance['Оплата переводом']['Оплачено и не выполнено']}} &#8381;</span> </p>
                  <p class="lead">Не оплачено и не выполнено: <span class="badge badge-danger text-white">{{$finance['Оплата переводом']['Не оплачено и не выполнено']}} &#8381;</span> </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
            @include('partials.admin.adminnav', [ 'active' => 'finance'])
        </div>
    </div>
</div>
@endsection
