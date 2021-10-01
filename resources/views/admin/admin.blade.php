@extends('layouts.app')

@section('title') ЛК администратора@endsection
@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-sm-8 order-2 order-sm-1">
            <div class="card">
                <div class="card-header text-custom b-left">
                  <h3>{{ __('Добро пожаловать в личный кабинет администратора, '.$bio->name.'!') }}</h3>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header text-custom b-left">
                  <h3>{{ $type_title }} | <span class="badge badge-secondary">{{count($orders)}}</span></h3>
                </div>
                <div class="card-body text-center">
                  @include('partials.admin.ordernav')
                </div>
                <div class="table-responsive text-left" style="height: auto; overflow: auto; max-height: 500px">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Адрес</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Услуга</th>
                        <th scope="col">Статус</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($orders as $order)
                      @include('partials.admin.allorders')
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
            @include('partials.admin.adminnav', [ 'active' => 'adminpanel'])
        </div>
    </div>
</div>
@endsection
