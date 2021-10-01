@extends('layouts.app')

@section('title') ЛК администратора@endsection
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-sm-8 order-2 order-sm-1">
          @isset($response)
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <p><strong>{{$response}}</strong></p>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
          @endisset
          <div class="card">
                <div class="card-header text-custom b-left">
                  <h3>Прайс лист | "{{$type_title}}"</h3>
                </div>
                <div class="card-body text-center">
                  @include('partials.admin.pricenav')
                </div>
                <div class="table-responsive text-left">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Наименование</th>
                        <th scope="col">Цена Москва</th>
                        <th scope="col">Цена МО</th>
                        <th scope="col">Цена Регионы</th>
                        <th scope="col">Процент</th>
                        <th scope="col">Действие</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($prices as $price)
                      @include('partials.admin.pricetable')
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
            @include('partials.admin.adminnav', [ 'active' => 'price'])
        </div>
    </div>
</div>
@endsection
