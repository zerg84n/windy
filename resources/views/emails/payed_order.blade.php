<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $title }}</h2>
                <p>Поступила оплата заказа № {{$order->id}}</p>
                <p>Детали заказа № {{$order->id}}</p>
               
                <div class="row">
                    <table class="table table-bordered table-striped">
                         <tr>
                            <th>Дата заказа</th>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Имя покупателя</th>
                            <td>{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.email')</th>
                            <td>{{ $order->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.phone')</th>
                            <td>{{ $order->phone }}</td>
                        </tr>
                        <tr>
                            <th>Доставка</th>
                            @if($order->delivery == 0)
                            Самовывоз
                            @elseif($order->delivery == 1)
                            Доставка по СПб
                            @elseif($order->delivery == 2)
                            Доставка по России до терминала
                            @endif
                            <td></td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.address')</th>
                            <td>{{ $order->address }}</td>
                        </tr>
                     
                        
                            
                            @if($order->attachment)
                             <tr>
                            <th>Реквизиты в файле</th>
                            <td>
                            <a href="{{ asset('uploads/' . $order->attachment) }}" target="_blank">Реквизиты в файле</a>
                             </td>
                             </tr>
                            @endif
                       
                                            
                        
                    </table>
                </div>
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID Товара</th>
                                <th>Артикул</th>
                                <th>Наименование</th>
                                <th>Количество</th>
                                <th>Стоимость</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                             @foreach($order->products as $product)
                            <tr>
                                <td>
                                 {{$product->id}}
                                 </td>
                                 <td >{{$product->articul or 'не указан'}}</td>
                                 <td>
                                     <a href="{{route('products-show',$product)}}" target="_blank">{{$product->title}}</a>
                                 </td>
                                 <td>
                                 {{$product->pivot->count}}
                                 </td>
                                 <td>
                                 {{$product->pivot->count*$product->getCurrentPrice()}} р.
                                 @php
                                    $total += $product->pivot->count*$product->getCurrentPrice();
                                @endphp
                                 </td>
                             </tr>
                            @endforeach
                        <td>
                            Итого:
                        </td>
                        <td colspan="3">
                         @if ($order->delivery!=1 || $total > Config::get('site.free_delivery_sum'))
                            {{$total }} р. Доставка бесплатно.
                         @else
                             {{$total }} р. + Доставка {{Config::get('site.delivery_price')}} р. = {{ $total+Config::get('site.delivery_price')}} р.
                         @endif
                        </td>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <a href="{{route('admin.orders.show',$order->id)}}">Посмотреть заказ в админке</a>
                </div>
	</body>
</html>
