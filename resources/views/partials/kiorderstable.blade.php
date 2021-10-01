<tr>
  <th scope="row">{{$order->id}}</th>
  <td>{{$order->rosreestr->adres}} </td>
  <td>{{$order->cost}} &#8381;</td>
  <td>
    @if($order->data_type == 'App\Models\Realty')
    {{ $order->data()->first()->dateki}}
    @elseif($order->data_type == 'App\Models\Geo')
    {{ $order->data()->first()->datespec}}
    @elseif($order->data_type == 'App\Models\Plot')
    {{ $order->data()->first()->datespec}}
    @endif
  </td>
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
    <form method="POST" action="{{ route('ki.addmyorders') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $order->id }}">
        <button type="submit" class="btn btn-custom">Принять</button>
    </form>
  </td>
</tr>
