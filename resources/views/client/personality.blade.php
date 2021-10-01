@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-sm-8 order-2 order-sm-1">
          @isset($response)
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <p><strong>Договор сформирован!</strong></p>
                  <a href="{{asset('storage/users/'.$user->id.'/docs/dogovor.docx')}}" download>Скачать договор</a>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
          @endisset
          @if ($bio == "null")
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Пожалуйста, заполните персональные данные.</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="accordion" id="accordionExample">
              <div class="card border-bottom my-3">
                <div class="card-header b-left" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-lg text-dark @if(old('type')=='biopas' & old('type') != null )collapsed @else colapse @endif" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      {{ __('Заключить договор ФЛ по паспорту') }}
                    </button>
                  </h5>
                </div>

                <div id="collapseOne" class="collapse @if(old('type')=='biopas' & old('type') != null )show @else  @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    @include('partials.client.flform')
                  </div>
                </div>
              </div>

              <div class="card mt-3">
                <div class="card-header b-left" id="headingTwo">
                  <h5 class="mb-0">
                    <button class="btn btn-lg text-dark @if(old('type')=='biocom' & old('type') != null )collapsed @else colapse  @endif" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                      {{ __('Заключение договора на ЮЛ (ООО или ИП)') }}
                    </button>
                  </h5>
                </div>

                <div id="collapseTwo" class="collapse @if(old('type')=='biocom' & old('type') != null ) show @else @endif" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                    @include('partials.client.jlform')
                  </div>
                </div>
              </div>
            </div>
          @else
            <div class="card mt-3">
              <div class="card-header b-left">
                {{ __('Персональные данные') }}
              </div>
              <div class="card-body">
                @if($bio->data_type == 'App\Models\Biopas')
                  @include('partials.client.flform')
                @else
                  @include('partials.client.jlform')
                @endif
              </div>
            </div>
          @endif
        </div>

        <div class="col-sm-4 order-1 order-sm-2 mb-3 mb-sm-0">
          @include('partials.client.clientnav', [ 'active' => 'personality'])
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/client.js') }}" type="text/javascript"></script>
@endsection
