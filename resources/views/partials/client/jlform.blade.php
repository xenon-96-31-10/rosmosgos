<form method="POST" action="{{ route('personality') }}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="type" value="biocom">
  <div class="form-group mb-3">
    <input id="party" class="form-control" name="party" type="text" placeholder="Введите название, ИНН, ОГРН или адрес организации" />
  </div>
  <div class="form-group mb-3">
    <label for="inncom">ИНН/КПП организации или ИП</label>
    <input type="text" id="inncom" name="inncom" class="form-control" value="@if($bio != "null"){{ $data['inn']}} @else {{ old('inncom') }}@endif" placeholder="ИНН/КПП" required/>
  </div>

  <div class="form-group mb-3">
    <label for="namebank">Наименование банка</label>
    <input type="text" id="namebank" name="namebank" class="form-control" value="@if($bio != "null"){{ $data['bank']}} @else {{ old('namebank') }}@endif" placeholder="Наименование банка" required/>
  </div>

  <div class="form-group mb-3">
    <label for="bil">№ рассчетного счета</label>
    <input type="text" id="bil" name="bil" class="form-control" value="@if($bio != "null"){{ $data['bill']}} @else {{ old('bil') }}@endif" placeholder="№ рассчетного счета" required/>
  </div>

  <div class="form-group mb-3">
    <label for="fizsurnamec">Фамилия</label>
    <input type="text" class="form-control" id="fizsurnamec" name="fizsurnamec" value="@if($bio != "null"){{ $bio->familia}} @else {{ old('fizsurnamec') }}@endif" placeholder="Иванов" required>
    <label class="mt-1" for="fiznamec">Имя</label>
    <input type="text" class="form-control" id="fiznamec" name="fiznamec" value="@if($bio != "null"){{ $bio->name}} @else {{ old('fiznamec') }}@endif" placeholder="Петр" required>
    <label class="mt-1" for="fizlastnamec">Отчество</label>
    <input type="text" class="form-control" id="fizlastnamec" name="fizlastnamec" value="@if($bio != "null"){{ $bio->lastname}} @else {{ old('fizlastnamec') }}@endif" placeholder="Михайлович" required>
  </div>

  <div class="form-group mb-3">
    <label="numberdov">Номер доверенности</label>
    <input type="text" id="numberdov" name="numberdov" class="form-control" value="@if($bio != "null"){{ $data['numdov']}} @else {{ old('numberdov') }}@endif" placeholder="Номер доверенности" required/>
  </div>

  <div class="form-group mb-3">
    <label for="datedov">Дата выдачи доверенности</label>
    <input type="text" id="datedov" name="datedov" class="form-control" value="@if($bio != "null"){{ $data['datedov']}} @else {{ old('datedov') }}@endif" placeholder="Дата выдачи доверенности" required/>
  </div>

  @if($bio == "null")
  <div class="text-right my-2">
    <label class="custom-file-upload" data-toggle="tooltip" data-placement="right" title="Прикрепите копию доверенности">
        <input type="file" name="scandov"/>
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
