@if($price->title != 'Список')
<form method="POST" action="{{route('admin.updateprice', ['type' => $type])}}">
  @csrf
  <input type="hidden" name="id" value="{{$price->id}}">
  <tr>
    <th scope="row">{{$price->title}}</th>
    <td>
      <input type="text" class="form-control" value="{{$price->price1}}" name="price1" required>
    </td>
    <td>
      <input type="text"  class="form-control" value="{{$price->price2}}" name="price2" required>
    </td>
    <td>
      <input type="text"  class="form-control" value="{{$price->price3}}" name="price3" required>
    </td>
    <td>
      <input type="text"  class="form-control" value="{{$price->percent}}" name="percent" required>
    </td>
    <td>
      <button type="submit" class="btn btn-block btn-custom" name="button">Обновить</button>
    </td>
  </tr>
</form>
@endif
