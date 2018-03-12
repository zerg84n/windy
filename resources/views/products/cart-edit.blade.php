@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="/css/range.css">
    <link rel="stylesheet" href="/css/cart.css">
	<link rel="stylesheet" href="/css/jquery-clockpicker.min.css">
@endsection

@section('content')

<div class="uk-container">
    <div class="uk-grid">
		<div class="uk-width-1-4 left-col" >
		<p class="title">Новости</p>
		@foreach($news as $news)
		<div class="uk-card uk-margin-bottom uk-card-default uk-grid-collapse uk-grid" >
                    @php
                        $image = $news->getMedia('photos')->first();
                        if($image){
                            $image_src = $image->getUrl();
                        }
                        else{
                        $image_src = '/cat-img/8814-pw.jpg';
                        } 
                    @endphp
			<div class="uk-card-media-left uk-cover-container uk-width-1-3  ">
				<img src="{{$image_src or '#'}}" alt="" uk-cover>
			</div>
			<div class="uk-width-2-3">
				<div class="uk-card-body">
					<h3 class="uk-card-title">{{$news->title}}</h3>
					<p>{{$news->short}}</p>
				</div>
			</div>
			<div class="uk-card-footer uk-width-3-3">
			<p><img src="/img/clock.png" alt=""> {{$news->created_at}}</p>
			<a href="{{route('news-show',$news)}}" class="uk-button uk-button-text">Подробнее</a>
			</div>
		</div>
                @endforeach
		<a class="all-news uk-align-right" href="{{route('news-index')}}">Все новости</a>
		
		<p class="title">Контактная информация</p>
				<p>8 (800) 200-63-71 - звонок по России бесплатный!</p>
		<p>+7 (812) 667-86-97</p>
		<p>+7 (812) 926-53-82</p>
		<p>info@windytech.ru</p>
			<p>Мы работаем для Вас:<br>
			ПН-ПТ: с 10:00 до 18:00</p>
		</div>
		<div class="uk-width-3-4 content" ><p class="title">Корзина</p>
                    @if ($order->products->count()>0)
                    <form class="cart" action="{{route('products-cart-update',$order)}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
			
			<table class="cart-table">
				<tr>
					<th>Наименование товара</th>
					<th></th>
					<th>Цена</th>
					<th>Количество</th>
					<th>Стоимость</th>
					<th></th>
				</tr>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($order->products as $product)
                                @php
                                    $total += $product->getCurrentPrice()* $product->pivot->count;
                                @endphp
								@php
                                                $image = $product->getMedia('photos')->first();
                                                if($image){
                                                    $image_src = $image->getUrl();
                                                }
                                                else{
                                                $image_src = '/img/blank.png';
                                                } 
                                            @endphp
				<tr id="product{{$product->id}}">
                                    
					<td>
					<a href="{{route('products-show',$product)}}"><img src="{{$image_src}}" alt=""></a>
					</td>
					<td><a href="{{route('products-show',$product)}}">{{$product->title}}</a></td>
					<td>{{$product->getCurrentPrice()}}</td>
					<td>
                                            <input data-id="{{$product->id}}" data-price="{{$product->getCurrentPrice()}}" type="number" name="product_count[{{$product->id}}]" value="{{$product->pivot->count}}" min="1" max="100" class="product-count uk-form-width-mini uk-form-small">
					</td>
					<td id="price{{$product->id}}">{{$product->getCurrentPrice()*$product->pivot->count}}</td>
					<td>
                                            <a  data-id="{{$product->id}}" class="remove-product" href="javascript:void(0)" uk-icon="icon: close"></a>
					</td>
				</tr>
                                @endforeach
				<tr>
                                    <td colspan="6" class="footer">Итого: <span id='total'>{{$total}}</span> р.(Без учета стоимости доставки)</td>
				</tr>
			</table>
			<div class="cart-contact">
			<p class="cart-title">Контактная информация</p> 
				<p><span>Контактное лицо*</span> 
                                    <input type="text" name="name" value="{{$order->name or ''}}" required class="uk-input uk-form-width-medium uk-form-small"></p>
                                   @if($errors->has('name'))
                                        <p class="uk-form-danger">
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif
				<p><span>Телефон*</span> 
                                    <input type="phone" name="phone" value="{{$order->phone or ''}}" required class="uk-input uk-form-width-medium uk-form-small"></p>
                                   @if($errors->has('phone'))
                                        <p class="uk-form-danger">
                                            {{ $errors->first('phone') }}
                                        </p>
                                    @endif
				<p><span>E-mail*</span>
                                    <input type="email" name="email"  value="{{$order->email or ''}}" required class="uk-input uk-form-width-medium uk-form-small"></p>
				
                                       @if($errors->has('email'))
                                            <p class="uk-form-danger">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                      <p>  <input class="uk-checkbox" type="checkbox" name="agreement" value="1"  checked> Даю согласие на обработку персональных данных</p>
                                         @if($errors->has('agreement'))
                                            <p class="uk-form-danger">
                                                {{ $errors->first('agreement') }}
                                            </p>
                                        @endif
                                        <p> <input type='radio' name ="is_ur" value="1" class="uk-radio client-type" id="urid" {{$order->is_ur?"checked":""}}/>
                                Я юридическое лицо</p>
                                <p><input type='radio' name ="is_ur" value="0" class="uk-radio client-type" id="fizid" {{$order->is_ur?"":"checked"}}/>
                                Я частное лицо</p>
			</div>
		
			
                           <div id="dostavka-container" >
                        <div  class="cart-contact" >
                         
			<p class="cart-title">Доставка</p> 
		
                        <p><label><input class="uk-radio" type="hidden" name="delivery" value="0" id="vivoz" disabled ></label></p>
				<p>
                                    <label>
                                        <input  class="uk-radio" type="radio" name="delivery" value="1" id="dostavka" {{$order->delivery=="1"?"checked":""}}> Доставка по Санкт-Петербургу ({{Config::get('site.delivery_price')}} р. При заказе свыше {{Config::get('site.free_delivery_sum')}}р. доставка бесплатна.)
                                    </label>
                                  </p>
                                  <p>
                                    <label>
                                        <input class="uk-radio" type="radio" name="delivery" value="2" id="dostavka-russia" {{$order->delivery=="2"?"checked":""}} >Доставка по России (до терминала транспортных компаний «Деловые линии» или «Возовоз» 
осуществляется бесплатно 
                                    </label>
                                  </p>
				
                                        <div class="dostavka">
                                            <p><span>Адрес</span> <input value="{{$order->address}}" type="text" name="address" required  class="uk-input uk-form-width-medium uk-form-small"></p>
                                
				
				<p>Доставка с 10:00 до 18:00, иное время согласуется индивидуально при оформлении заказа.</p>
				<p>Доставка по России (до терминала транспортных компаний «Деловые линии» или «Возовоз») осуществляется бесплатно.</p>
				<!--<div class="clockpicker" data-placement="left" data-align="top" data-autoclose="true" style="display: inline-block;">
                                    <input name="time" type="text" class="uk-input uk-form-width-medium uk-form-small" value="13:14">
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-time"></span>
					</span>
				</div>-->               
								   
				 @if($errors->has('time'))
                                            <p class="uk-form-danger">
                                                {{ $errors->first('time') }}
                                            </p>
                                        @endif
				</div>
                              
			</div>
                         {!!csrf_field()!!}
                         
                          </div>   
                        <div class="cart-contact">
                        <div id="fiz-client">
			<p class="cart-title">Оплата</p> 
				
                               
                                <p>  <input id="card" name="payment_type" type="radio" value="Картой" {{$order->payment_type=="Картой"?"checked":""}}/>Оплатить сейчас (электронные кошельки, пластиковые карты)</p>
                                  <p>  <input id="nalik"  name="payment_type" type="radio" value="Наличными курьеру" {{$order->payment_type=="Наличными курьеру"?"checked":""}}/>Наличными курьеру при получении товара</p>       
                                        
			</div>	
				<div id="ur-client" class="urid">
				<p><span>Прикрепить реквизиты</span>
                                   
                               
                                {!! Form::file('attachment', ['class' => 'uk-input uk-form-small uk-form-width-large','disabled'=>'disabled']) !!}
                                {!! Form::hidden('attachment_max_size', 8) !!}
                                <p class="uk-form-danger"></p>
                                @if($errors->has('attachment'))
                                    <p class="uk-form-danger">
                                        {{ $errors->first('attachment') }}
                                    </p>
                                @endif
				<p>Или скопируйте реквизиты в поле:</p>
				<textarea disabled="disabled" name="ur_name" class="uk-textarea">Ваши реквизиты</textarea>
                                   @if($errors->has('ur_name'))
                                            <p class="uk-form-danger">
                                                {{ $errors->first('ur_name') }}
                                            </p>
                                   @endif
				
				</div>
                            <p class="cart-title">Комментарий к заказу</p> 
                         <textarea  name="comment" class="uk-textarea" placeholder="Ваш комментарий к заказу">{{$order->comment or ''}}</textarea>
			</div>
			<p class="pay btn"><input type="submit" value="Оформить заказ"></p>	
                <div style="clear:both;">			
		</div>
            </form>
                    @else
                    <p>Вы еще не добавили товаров в корзину! Добавьте нужные вам товары и возвращайтесь!</p>
                    @endif
                    
	</div>
    </div>
</div>


@endsection

@section('scripts') 
    <script src="/js/ini.js"></script>
    <script src="/js/uikit-icons.min.js"></script>
	<script src="/js/jquery-clockpicker.min.js"></script>
    <script>
         window.route_del_from_cart = '{{ route("products-cart-del") }}';
         
          //dostavka-oplata logic
          if($("#dostavka-russia").prop('checked')){
                  $('#nalik').prop('disabled',true);
                 $('#card').prop('checked',true);
                 
             }else{
                 $('#nalik').prop('disabled',false);
             }
         $(".delivery").change(function(){
            
             if($("#dostavka-russia").prop('checked')){
                  $('#nalik').prop('disabled',true);
                 $('#card').prop('checked',true);
                 
             }else{
                 $('#nalik').prop('disabled',false);
             }
         });
         
        $('#dostavka-container').hide();
       
          if ($( "#urid" ).prop( "checked") == true){
		$( ".uk-textarea" ).prop( 'disabled', false );
                $( ".urid input" ).prop( "disabled", false );
                $("#ur-client").show();
                  $("#pay-select").prop( "disabled", true );
                   $('#dostavka-container').show();
        }else{
             $("#ur-client").hide();
           $("#pay-select").prop( "disabled", false );
           $('#dostavka-container').show();
        }
         if ($( "#fizid" ).prop( "checked") == true){
                console.log('fiz');
		$( ".uk-textarea" ).prop( 'disabled', false );
                $( ".urid input" ).prop( "disabled", true );
                $("#fiz-client").show();
                  $("#pay-select").prop( "disabled", false );
                  $('#dostavka-container').show();
        }else{
             $("#fiz-client").hide();
               $("#pay-select").prop( "disabled", true );
               $('#dostavka-container').show();
        }
        
        
        $(".product-count").change(function(){
           
           
            total = 0;
             $(".product-count").each(
                     function(){
                         var id = $(this).data('id');
                         var price = $(this).val()*$(this).data('price');
                         total += price;
                         $("#price"+id).html(price);
                     }  );
            
            $("#total").html(total);
        });


      $( ".remove-product" ).on( "click", function() {
          var id = $(this).data('id');
          
                
          
          
               $("#product"+id).remove();
               
                total = 0;
             $(".product-count").each(
                     function(){
                         var id = $(this).data('id');
                         var price = $(this).val()*$(this).data('price');
                         total += price;
                         $("#price"+id).html(price);
                     }  );
            
            $("#total").html(total);
            if (total == 0 ){
                $('#cart_title').removeClass('cart_not_empty');
            }
            
            $.get(window.route_del_from_cart,{ id: id})
                               .done(function( data ) {
                       
                      });
        });
        
        
        $( "#dostavka" ).on( "click", function() {
                $( ".dostavka input" ).prop( "disabled", false );
        });
        $( "#vivoz" ).on( "click", function() {
                $( ".dostavka input" ).prop( "disabled", true );
        });

        $("#ussrid").click(function() {
         if ($( "#urid" ).prop( "checked") == true){
				$( ".uk-textarea" ).prop( 'disabled', false );
                $( ".urid input" ).prop( "disabled", false );
               
        }
        else {$( ".urid input" ).prop( "disabled", true );
		$( ".uk-textarea" ).prop( 'disabled', true );}
        ;

        });
        $(".client-type").change(function(){
             $('#dostavka-container').show();
              if ($( "#urid" ).prop( "checked") == true){
				$( ".uk-textarea" ).prop( 'disabled', false );
                $( ".urid input" ).prop( "disabled", false );
                $("#ur-client").show();
                  $("#pay-select").prop( "disabled", true );
        }else{
             $("#ur-client").hide();
               $("#pay-select").prop( "disabled", false );
        }
         if ($( "#fizid" ).prop( "checked") == true){
				$( ".uk-textarea" ).prop( 'disabled', true );
                $( ".urid input" ).prop( "disabled", true );
                $("#fiz-client").show();
                  $("#pay-select").prop( "disabled", false );
        }else{
             $("#fiz-client").hide();
               $("#pay-select").prop( "disabled", true );
        }
        });



</script>
<script type="text/javascript">
/*$('.clockpicker').clockpicker();*/
</script>
@endsection


