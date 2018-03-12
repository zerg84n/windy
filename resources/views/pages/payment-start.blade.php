@extends('layouts.main')
@section('styles') 
    
@endsection

@section('content')

<div class="uk-container">
	<div class="uk-grid">
		<div class="uk-width-1-4 left-col" >
		<p class="title">Контактная информация</p>
		<p>8 (800) 200-63-71 - звонок по России бесплатный!</p>
		<p>+7 (812) 667-86-97</p>
		<p>+7 (812) 926-53-82</p>
		<p>info@windytech.ru</p>
			<p>Мы работаем для Вас:<br>
			ПН-ПТ: с 10:00 до 18:00</p>
		</div>
		<div class="uk-width-3-4 content" ><p class="title">Ваш заказ</p>
		<div class="news-content">	
                    
                        <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                               
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
                          @if ($order->delivery!=1 || $total > Config::get('site.free_delivery_sum'))
                          <tr>
                              <td>Доставка</td>
                              <td>{{$order->address}}</td>
                              <td>Бесплатно</td>
                          </tr>
                          @else
                             <tr>
                              <td>Доставка</td>
                              <td></td>
                              <td>{{Config::get('site.delivery_price')}} р.</td>
                          </tr>
                          @endif
                        <tr>    
                        <td>
                            К оплате:
                        </td>
                        <td colspan="2">
                          
                           {{$order->getFullSum()}} р.
                        </td>
                      </tr>
                        </tbody>
                    </table>
                    
                    <p>Контактное лицо: {{$order->name or ''}}, {{$order->phone or ''}}, {{$order->email or ''}}</p>
                    <p>Адрес доставки: {{$order->address}}</p>
                    <p>
                    @if($order->payment_type == "Картой")
                        Электронный способ оплаты.
                    @endif
                    @if($order->payment_type == "Наличными курьеру")
                    Оплата наличными курьеру.
                    @endif
                    @if($order->payment_type == "По счету")
                    Выставить счет в соответствии с реквизитами.
                    @endif
                    </p>
               @php
                $mrh_login = "windytechru";
                
                $mrh_pass1 = env('ROBOKASSA_KEY1', 'llS52FX32hxB4SqrDnRo');
                $inv_id = $order->id;
                $inv_desc = "Оплата заказа №".$order->id;
                $def_sum = $total;

                $crc = md5("$mrh_login::$inv_id:$mrh_pass1");
               
            @endphp
            @if($order->payment_type == "Картой")
                <form id="pay-form" action='https://merchant.roboxchange.com/Index.aspx' method=POST">
                   
                    <input type="hidden" name="MerchantLogin" value="{{$mrh_login}}"/>
                    <input type="hidden" name="InvoiceID" value="{{$inv_id}}"/>   
                    <input type="hidden" name="Description" value="{{$inv_desc}}"/> 
                    <input type="hidden" name="SignatureValue" value="{{$crc}}"/> 
                    <input type="hidden" name="FreeOutSum" class="form-control" value="{{$def_sum}}"/>
                    
                    <button onclick="sendNotify(); return false;"  class="btn btn-primary c-edit">Подтверждаю</button>
                </form> 
            
            @else
                  <form action="{{route('order-finish')}}" method="GET">
                       <input type="submit" class="c-edit btn btn-primary" value="Подтверждаю"/>
                  </form>
            @endif
            <form action="{{route('products-cart-edit')}}" method="GET">
                        <input type="submit" class="c-edit btn btn-primary" value="Назад"/>
                  </form>
		</div>
                  		
		</div>
	</div>	
</div>
@endsection

@section('scripts') 
<script>
    function sendNotify(){
        console.log('sending...');
        $.get( "{{route('payment-start')}}")
            .done(function( data ) {
             $('#pay-form').submit();
        });
    }
    </script>
@endsection

