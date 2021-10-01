<form method="POST" action="{{ route('personality') }}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="type" value="biopas">
  <div class="form-group mb-3">
    <label for="familia">Фамилия</label>
    <input type="text" class="form-control" id="familia" name="familia" value="@if($bio != "null"){{ $bio->familia}} @else {{ old('familia') }}@endif" placeholder="Иванов" required>
    <label class="mt-1" for="name">Имя</label>
    <input type="text" class="form-control" id="name" name="name" value="@if($bio != "null"){{ $bio->name}} @else {{ old('name') }}@endif" placeholder="Петр" required>
    <label class="mt-1" for="lastname">Отчество</label>
    <input type="text" class="form-control" id="lastname" name="lastname" value="@if($bio != "null"){{ $bio->lastname}} @else {{ old('lastname') }}@endif" placeholder="Михайлович" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="snils-prepend">СНИЛС</span>
    </div>
    <input type="text" class="form-control" id="snils" name="snils" value="@if($bio != "null"){{ $data->snils}}@else {{ old('snils') }}@endif" aria-label="Default" aria-describedby="snils-prepend" required>
  </div>

  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text" id="pass-prepend">Паспортные данные</span>
    </div>
    <input type="text" class="form-control" id="pass-seria" name="pass-seria" value="@if($bio != "null") @if($bio->data_type == 'App\Models\Biopas'){{ $pass[0]}}@endif @else{{ old('pass-seria') }}@endif" placeholder="Серия" required>
    <input type="text" class="form-control" id="pass-nomer" name="pass-nomer" value="@if($bio != "null")@if($bio->data_type == 'App\Models\Biopas'){{ $pass[1]}}@endif @else {{ old('pass-nomer') }}@endif" placeholder="Номер" required>
  </div>

  <div class="row mb-3">
    <div class="col-12 col-sm-6">
      <label for="codepass">Код подразделения:</label>
      <input type="text" class="form-control" id="codepass" name="codepass" value="@if($bio != "null"){{ $data->codepass}}@else {{ old('codepass') }}@endif" placeholder="Код подразделения" required>
    </div>
    <div class="col-12 col-sm-6 mt-2 mt-sm-0">
      <label for="datepass">Когда выдан:</label>
      <input type="text" class="form-control" id="datepass" name="datepass" value="@if($bio != "null"){{ $data->datepass}}@else {{ old('datepass') }}@endif" placeholder="Когда выдан" required>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-12 col-sm-8">
      <label for="kempass">Кем выдан:</label>
      <input type="text" class="form-control" id="kempass" name="kempass" value="@if($bio != "null"){{ $data->kempass}}@else {{ old('kempass') }}@endif" placeholder="Кем выдан" required>
    </div>
    <div class="col-12 col-sm-4 mt-2 mt-sm-0">
      <label for="datebirth">Дата Рождения:</label>
      <input type="text" class="form-control" id="datebirth" name="datebirth" value="@if($bio != "null"){{ $data->datebirth}}@else {{ old('datebirth') }}@endif" placeholder="Дата Рождения" required>
    </div>
  </div>
  @if($bio == "null")
  <div class="text-right my-2">
    <label class="custom-file-upload" data-toggle="tooltip" data-placement="right" title="Прикрепите копию паспорта">
        <input type="file" name="scanpass"/>
        <i class="fas fa-paperclip"></i>
    </label>
  </div>
  @endif

  @if($bio != "null")
    <button type="submit" class="btn btn-custom" disabled>Договор заключен</button>
  @else
    <button type="submit" class="btn btn-custom">Заключить договор</button>
  @endif
  </form>
