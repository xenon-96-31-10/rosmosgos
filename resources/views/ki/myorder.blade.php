@extends('layouts.app')

@section('title') ЛК инженера@endsection
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
                  Заказ № {{$order->id}} по услуге "Оформление построек"
                  @elseif($order->data_type == 'App\Models\Geo')
                  Заказ № {{$order->id}} по услуге "Геодезические работы"
                  @elseif($order->data_type == 'App\Models\Plot')
                  Заказ № {{$order->id}} по услуге "Оформление земельных участков"
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
                  <h5>Выбранная дата приезда Геодезиста: {{$info->datespec}}</h5>
                  @elseif($order->data_type == 'App\Models\Plot')
                  <h5>Выбранная дата приезда Специалиста: {{$info->datespec}}</h5>
                  @endif

                  <hr>
                  <h5>{{$order->user()->first()->bio()->first()->familia ?? 'Клиент еще не заполнил персональные данные'}} {{$order->user()->first()->bio()->first()->name ?? '-'}} {{$order->user()->first()->bio()->first()->lastname ?? '-'}}</h5>
                  <h5>Телефон клиента: <a href="tel:+{{$order->user()->first()->phone}}">+{{$order->user()->first()->phone}}</a></h5>
                  <h5>Email: <a href="mailto:{{$order->user()->first()->email}}">{{$order->user()->first()->email}}</a></h5>
                </div>
              </div>
            </div>

            @if($order->status != 'Закрыт')
              @if($order->ki()->first()->act != 'Создан')
              <div class="card mt-3">
                <div class="card-header b-left" id="headingTwo">
                  <h5 class="mb-0">
                    <button class="btn btn-lg btn-block text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                      Заполнить форму и сформировать акт
                    </button>
                  </h5>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                    <form class="" method="POST" action="{{ route('ki.makeAct', ['id' => $order->id]) }}">
                      @csrf
                      <div class="form-group mb-3">
                        <label for="familia">Фамилия</label>
                        <input type="text" class="form-control" id="familia" name="familia" value="{{ old('familia') ?? $order->user()->first()->bio()->first()->familia ?? '-'}}" placeholder="Иванов" required>
                        <label class="mt-1" for="name">Имя</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?? $order->user()->first()->bio()->first()->name ?? '-'}}" placeholder="Петр" required>
                        <label class="mt-1" for="lastname">Отчество</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') ?? $order->user()->first()->bio()->first()->lastname ?? '-'}}" placeholder="Михайлович" required>
                      </div>
                      <div class="form-group mb-3">
                        <label for="namebank">Телефон клиента</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('lastname') ?? $order->user()->first()->phone }}" placeholder="Телефон клиента" required/>
                      </div>

                      <div class="row mb-3">
                        <div class="col-sm-4">
                            <label for="nameobj">Наименование объекта</label>
                        </div>
                        <div class="col-sm-8">
                            <select class="mdb-select md-form" id="nameobj" name="nameobj">
                                <option value="Список" >Выберите из списка</option>
                                <option value="Баня" >Баня</option>
                                <option value="Гараж" >Гараж</option>
                                <option value="Дом" >Дом</option>
                                <option value="Сарай" >Сарай</option>
                                <option value="Бойлерная">Бойлерная</option>
                                <option value="Котельная">Котельная</option>
                                <option value="Другое">Другое</option>
                            </select>
                        </div>
                        <div class="col-12 my-1" id="drugoe" style="display: none">
                            <input name="nameobjdr" class="form-control" type="text" id="nameobjdr" value="" placeholder="Введите другое" >
                        </div>
                      </div>

                      <div class="row mb-3">
                        <div class="col-sm-4">
                            <label for="cadnumber1">Кадастровый номер 1</label>
                        </div>
                        <div class="col-sm-8">
                            <input name="cadnumber1" type="text" class="form-control" id="cadnumber1" value="{{ old('lastname') ?? $order->rosreestr()->first()->cadnomer }}" placeholder="Введите кадастровый номер 1" >
                        </div>
                      </div>
                      <br>
                      <div class="row mb-3">
                          <div class="col-sm-4">
                              <label for="cadnumber2">Кадастровый номер 2</label>
                          </div>
                          <div class="col-sm-8">
                              <input name="cadnumber2" class="form-control" type="text" id="cadnumber2" value="" placeholder="Введите кадастровый номер 2" >
                          </div>
                      </div>
                      <div id="inputkn0"></div>
                      <div class="row mb-3">
                          <div class="col-sm-4 "></div>
                          <div class="col-sm-4 ">
                              <p class="add" onclick="addInputkn()">+ кадастровый номер</p>
                          </div>
                          <div class="col-sm-4"></div>
                      </div>

                      <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="coordinata1">Координата 1</label>
                            </div>
                            <div class="col-sm-8">
                                <input name="coordinata1" type="text" class="form-control" id="coordinata1" value="{{ old('coordinata1') ?? $order->rosreestr()->first()->coordinata1 }}" placeholder="Введите Координату 1" >
                            </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="coordinata2">Координата 2</label>
                            </div>
                            <div class="col-sm-8">
                                <input name="coordinata2" type="text" class="form-control" id="coordinata2" value="{{ old('coordinata2') ?? $order->rosreestr()->first()->coordinata2 }}" placeholder="Введите Координату 2" >
                            </div>
                        </div>
                        <div id="inputcoordinata0"></div>
                        <div class="row mb-3">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <p class="add" onclick="addInputc()">+ координата</p>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-sm-4">
                              <label for="razmer1">Размер 1</label>
                          </div>
                          <div class="col-sm-8">
                              <input name="razmer1" type="text" class="form-control" id="razmer1" value="" placeholder="Введите размер 1" >
                          </div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="razmer2">Размер 2</label>
                            </div>
                            <div class="col-sm-8">
                                <input name="razmer2" type="text" class="form-control" id="razmer2" value="" placeholder="Введите размер 2" >
                            </div>
                        </div>
                        <div id="inputr0"></div>
                        <div class="row mb-3">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4">
                                <p class="add" onclick="addInputr()">+ размер</p>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <br>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label for="numberflat">Колличество этажей</label>
                            </div>
                            <div class="col-sm-8">
                                <input name="numberflat" type="number" class="form-control" id="numberflat" min="1" step="1" value="" placeholder="Введите колличество этажей" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-custom " name="save">Сформировать Акт</button>
                    </form>
                  </div>
                </div>
              </div>
              @endif

            <div class="card border-bottom mt-3">
              <div class="card-header b-left" id="heading3">
                <h5 class="mb-0">
                  <button class="btn btn-lg btn-block text-dark" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    Оставить заметки
                  </button>
                </h5>
              </div>

              <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
                <div class="card-body mb-2">
                  <form method="POST" action="{{ route('ki.createquote', ['id' => $order->id]) }}" >
                    @csrf
                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Ваша заметка</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" name="text" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-lg btn-custom">Создать</button>
                  </form>
                  @foreach($order->quotes as $quote)
                  <div class="alert alert-info mt-2" role="alert">
                    {{$quote->text}}
                  </div>
                  @endforeach
                </div>

              </div>
            </div>

          </div>

          <div class="card border-bottom mt-3">
            <div class="card-header b-left">
              Дополнительные действия
            </div>
            <div class="card-body">
              <h5 class="card-title">Отказ от заявки</h5>
              <form method="POST" action="{{ route('ki.createrefuse', ['id' => $order->id]) }}" >
                @csrf
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Причина отказа</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" name="refuse" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-lg btn-danger">Отказаться</button>
              </form>
              @role('admin')
                @foreach($order->refuses as $refuse)
                <div class="alert alert-danger mt-2" role="alert">
                  Отказ по причине: {{$refuse->refuse}}
                </div>
                @endforeach
              @endrole
              @if($order->status != 'Кадастровый инженер на объекте')
              <hr>
              <form method="POST" action="{{ route('ki.arivedtoobj', ['id' => $order->id]) }}" >
                @csrf
                <button type="submit" class="btn btn-lg btn-info text-white">Сообщить о приезде на объект</button>
              </form>
              <hr>
              @endif
              @if($order->sposobpay == 'Оплата наличными' & $order->statuspay == 'Не оплачен')
                <form method="POST" action="{{ route('ki.takepay', ['id' => $order->id]) }}" >
                  @csrf
                  <button type="submit" class="btn btn-lg btn-primary">Принять оплату</button>
                </form>
                <hr>
              @endif
              @if($order->ki()->first()->act == 'Создан' & $order->statuspay == 'Оплачен')
                <form method="POST" action="{{ route('ki.closeorder', ['id' => $order->id]) }}" >
                  @csrf
                  <button type="submit" class="btn btn-lg btn-custom">Закрыть заявку</button>
                </form>
                <hr>
              @else
              <div class="alert alert-warning" role="alert">
              Для закрытия заявки убедитесь, что заказ оплачен и Вы сформировали акт!
              </div>
              @endif
            </div>
            @endif
          </div>

          <div class="card border-bottom mt-3">
            <div class="card-header b-left">
              Документы
            </div>
            <div class="card-body">
              <h5 class="card-title">Клиента</h5>
              @foreach($client_files as $file)
                @if(pathinfo($file)['filename'] == 'dogovor')
                  <li>
                    <a href="{{$file}}" download>Договор</a>
                  </li>
                @elseif(pathinfo($file)['filename'] == 'скан_паспорта')
                  <li>
                    <a href="{{$file}}" download>Копия паспорта</a>
                  </li>
                @elseif(pathinfo($file)['filename'] == 'скан_доверенности')
                  <li>
                    <a href="{{$file}}" download>Копия доверенности</a>
                  </li>
                @endif
              @endforeach
              <hr>
              @foreach($order_files as $file)
              <li>
                <a href="{{$file}}" download>{{pathinfo($file)['filename']}}</a>
              </li>
              @endforeach
              <hr>
              <form method="post" action="{{route('ki.loaddoc', ['id' => $order->id])}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label for="name">Имя документа для клиента</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Имя документа для клиента" required>
                  <div class="text-right my-2">
                    <label class="custom-file-upload" data-toggle="tooltip" data-placement="right" title="Прикрепите необходимый документ">
                        <input type="file" name="doc" required/>
                        <i class="fas fa-paperclip"></i>
                    </label>
                    <button type="submit" class="btn btn-custom">Загрузить</button>
                  </div>
                </div>
              </form>
            </div>
          </div>


        </div>
        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
          @include('partials.kinav', [ 'active' => 'null'])
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/ki.js') }}" type="text/javascript"></script>
@endsection
