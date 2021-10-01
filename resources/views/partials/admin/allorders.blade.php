<tr>
  <th scope="row">{{$order->id}}</th>
  <td>{{$order->rosreestr->adres}} </td>
  <td>{{$order->cost}} &#8381;</td>
  <td>
    @if($order->data_type == 'App\Models\Realty')
    Оформление построек
    @elseif($order->data_type == 'App\Models\Geo')
    Геодезические работы
    @elseif($order->data_type == 'App\Models\Plot')
    Оформление земельных участков
    @endif
  </td>
  <td>
    @if($order->status == 'Поиск кадастрового инженера')
    <span class="badge badge-info">{{$order->status}}</span>
    @elseif($order->status == 'Закрыт')
    <span class="badge badge-success">{{$order->status}}</span>
    @else
    <span class="badge badge-primary">{{$order->status}}</span>
    @endif
    <a href="{{route('admin.order', ['id' => $order->id])}}" class="btn btn-block btn-custom">Подробнее</a>
  </td>
</tr>
