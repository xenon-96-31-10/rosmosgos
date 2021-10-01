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
            <div class="card mt-3">
                <div class="card-header text-custom b-left">
                  <h3>Новые заявки <span class="badge badge-secondary"></span></h3>
                </div>
                <div class="table-responsive text-left" style="height: auto; overflow: auto; max-height: 500px">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ФИО</th>
                        <th scope="col">Сертификат</th>
                        <th scope="col">Регион</th>
                        <th scope="col">Телефон</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($enginers as $ki)
                        @isset($ki->bio)
                          <tr>
                            <td>{{$ki->bio()->first()->familia}} {{$ki->bio()->first()->name}} {{$ki->bio()->first()->lastname}}</td>
                            <td>
                              {{$ki->bio()->first()->data()->first()->sertificate}}
                            </td>
                            <td>
                              {{$ki->bio()->first()->data()->first()->region}}
                            </td>
                            <td>
                              {{$ki->phone}}
                            </td>
                            <td>
                              <form method="POST" action="{{ route('admin.addapp') }}">
                                  @csrf
                                  <input type="hidden" name="id" value="{{ $ki->id }}">
                                  <button type="submit" class="btn btn-custom">Принять</button>
                              </form>
                            </td>
                          </tr>
                        @endisset
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
            @include('partials.admin.adminnav', [ 'active' => 'app'])
        </div>
    </div>
</div>
@endsection
