@extends('layouts.main')
@section('styles') 
    
@endsection

@section('content')

<div class="uk-container">
	<div class="uk-grid">
		<div class="uk-width-1-4 left-col" >
		<p class="title">Контактная информация</p>
		<p>+7 (812) 123-45-78</p>
		<p>info@wendy.ru </p>
		<p>Мы работаем для Вас:<br>
		ПН-ПТ: 08:00 - 18:00<br>СБ: 10:00 - 16:00 </p>
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
                                 {{$product->pivot->count*$product->price_original}} р.
                                 @php
                                    $total += $product->pivot->count*$product->price_original;
                                @endphp
                                 </td>
                             </tr>
                            @endforeach
                        <td>
                            К оплате:
                        </td>
                        <td colspan="3">
                            {{$total}} р.
                        </td>
                        </tbody>
                    </table>
               @php
                $mrh_login = "windytechru";
                $mrh_pass1 = "llS52FX32hxB4SqrDnRo";
                $inv_id = $order->id;
                $inv_desc = "Оплата заказа №".$order->id;
                $def_sum = $total;
                $crc = md5("$mrh_login::$inv_id:$mrh_pass1");
               
            @endphp
                <form action='https://merchant.roboxchange.com/Index.aspx' method=POST">
                    <input type="hidden" name="IsTest" value="1"/>
                    <input type="hidden" name="MerchantLogin" value="{{$mrh_login}}"/>
                    <input type="hidden" name="InvoiceID" value="{{$inv_id}}"/>   
                    <input type="hidden" name="Description" value="{{$inv_desc}}"/> 
                    <input type="hidden" name="SignatureValue" value="{{$crc}}"/> 
                    <input type="hidden" name="FreeOutSum" class="form-control" value="{{$def_sum}}"/>
                    <input type="submit" class="btn btn-primary" value="Перейти к оплате">
            
                </form> 
		</div>
                  		
		</div>
	</div>	
</div>
@endsection

@section('scripts') 

    
@endsection

