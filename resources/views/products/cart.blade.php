@extends('layouts.main')
@section('styles')
    <link rel="stylesheet" href="/css/range.css">
    <link rel="stylesheet" href="/css/cart.css">
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
		<p>+7 (812) 123-45-78</p>
		<p>info@wendy.ru </p>
		<p>Мы работаем для Вас:<br>
		ПН-ПТ: 08:00 - 18:00<br>СБ: 10:00 - 16:00 </p>
		</div>
		<div class="uk-width-3-4 content" ><p class="title">Корзина</p>
                    <form class="cart" action="{{route('products-cart-store')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
			
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
                                @foreach($products as $product)
                                @php
                                    $total += $product->price_original* $cart[$product->id];
                                @endphp
				<tr>
                                    
					<td><img src="/cat-img/8814-pw.jpg" alt=""></td>
					<td><a href="#">{{$product->title}}</a></td>
					<td>{{$product->price_original}}</td>
					<td>
                                            <input type="number" name="product_count[{{$product->id}}]" value="{{$cart[$product->id]}}" min="1" max="100" class="uk-form-width-mini uk-form-small">
					</td>
					<td>{{$product->price_original*$cart[$product->id]}}</td>
					<td>
						<a href="" uk-icon="icon: close"></a>
					</td>
				</tr>
                                @endforeach
				<tr>
					<td colspan="6" class="footer">Итого: {{$total}} р.</td>
				</tr>
			</table>
			<div class="cart-contact">
			<p class="cart-title">Контактная информация</p> 
				<p><span>Контактное лицо*</span> 
                                    <input type="text" name="name" required class="uk-input uk-form-width-medium uk-form-small"></p>
				<p><span>Телефон*</span> 
                                    <input type="phone" name="phone" required class="uk-input uk-form-width-medium uk-form-small"></p>
				<p><span>E-mail*</span>
                                    <input type="email" name="email" required class="uk-input uk-form-width-medium uk-form-small"></p>
				<p>
                                    <input class="uk-checkbox" type="checkbox" name="agreement" value="1" checked> Даю согласие на обработку персональных данных</p>
			</div>
			<div class="cart-contact">
			<p class="cart-title">Доставка</p> 
		
                        <p><label><input class="uk-radio" type="hidden" name="delivery" value="0" id="vivoz" disabled ></label></p>
				<p><label>
                                        <input class="uk-radio" type="radio" name="delivery" value="1" id="dostavka" checked> Доставка по Санкт-Петербургу</label></p>
				<div class="dostavka">
				<p><span>Адрес</span> <input type="text" name="address" required  class="uk-input uk-form-width-medium uk-form-small"></p>
				
				<p><span>Удобное время</span> <input type="time" name="time" required  class="uk-input uk-form-width-medium uk-form-small"></p>
				</div>
			</div>
			<div class="cart-contact">
			<p class="cart-title">Оплата</p> 
				<p><span>Способ оплаты</span>
                                    <select name="payment_type" class="uk-select">
                                        <option value="0">Картой</option>
                                        <option value="1">Наличными курьеру</option>
				</select></p>
				<p>
                                    <input class="uk-checkbox" type="checkbox" name="is_ur" value="1" id="urid"> Я юридическое лицо</p>
				<div class="urid">
				<p><span>Прикрепить реквизиты</span>
                                   
                               
                                {!! Form::file('attachment', ['class' => 'uk-input uk-form-small uk-form-width-large']) !!}
                                {!! Form::hidden('attachment_max_size', 8) !!}
                                <p class="help-block"></p>
                                @if($errors->has('attachment'))
                                    <p class="help-block">
                                        {{ $errors->first('attachment') }}
                                    </p>
                                @endif
				<p>Или заполните поля</p>
				<p><span>Название организации</span> <input disabled type="text" name="ur_name" class="uk-input uk-form-width-medium uk-form-small"></p>
				<p><span>ИНН</span> <input disabled type="text" name="ur_inn" class="uk-input uk-form-width-medium uk-form-small"></p>
				<p><span>Номер лицевого счета</span> <input disabled type="text" name="ur_nls" class="uk-input uk-form-width-medium uk-form-small"></p>
				</div>
			</div>
                         {!!csrf_field()!!}
			<p class="pay"><input type="submit" value="Оплатить"></p>	
			<div style="clear:both;">			
		</div>
            </form>
	</div>
    </div>
</div>


@endsection

@section('scripts') 
    <script src="/js/ini.js"></script>
    <script src="/js/uikit-icons.min.js"></script>
    <script>

        $( "#dostavka" ).on( "click", function() {
                $( ".dostavka input" ).prop( "disabled", false );
        });
        $( "#vivoz" ).on( "click", function() {
                $( ".dostavka input" ).prop( "disabled", true );
        });

        $("#urid").click(function() {
         if ($( "#urid" ).prop( "checked") == true){

                $( ".urid input" ).prop( "disabled", false );
        }
        else {$( ".urid input" ).prop( "disabled", true );}
        ;

        });




</script>
@endsection


