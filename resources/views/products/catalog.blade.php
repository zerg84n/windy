@extends('layouts.main')
@section('styles') 
   <link rel="stylesheet" href="/css/range.css">
		
@endsection

@section('content')
<div class="uk-container">
<p class="title-cat">@if ($category) {{$category->title}} @else Все товары @endif</p>
	<div class="uk-grid">
		<div class="uk-width-1-4 left-col" >
		<div class="filter">
			<p class="filter-title">Фильтр</p>
			<form class="filter-form">
				<p>Цена</p>
				<input type="text" id="amount" readonly>
				<div id="slider-range" ></div>
				<p>Производители</p>
				<ul>
				<li><input class="uk-checkbox" type="checkbox" name="option1" value="a1"> G-tex</li>
				<li><input class="uk-checkbox" type="checkbox" name="option1" value="a1"> G-tex</li>
				<li><input class="uk-checkbox" type="checkbox" name="option1" value="a1"> G-tex</li>
				<li><input class="uk-checkbox" type="checkbox" name="option1" value="a1"> G-tex</li></ul>
				<p>Мощность</p>
				<input type="text" id="amount-mosh" readonly>
				<div id="slider-range-mosh" ></div>
				<ul>
				<li><input class="uk-checkbox" type="checkbox" name="option1" value="a1"> Антивандальная защита</li>
				<li><input class="uk-checkbox" type="checkbox" name="option1" value="a1"> Автовыключение/включение</li>
				</ul>
			</form>
		</div>
			<p class="title">Контактная информация</p>
			<p>+7 (812) 123-45-78</p>
			<p>info@wendy.ru </p>
			<p>Мы работаем для Вас:<br>
			ПН-ПТ: 08:00 - 18:00<br>СБ: 10:00 - 16:00 </p>
		</div>
		<div class="green uk-width-3-4 content" >
			<div class="sort">
			<div class="uk-column-1-3 uk-column-divider">
				<div>Сортировать по цене: <a href="" uk-icon="icon: arrow-down"></a> <a href="" uk-icon="icon: arrow-up"></a></div>
				<div><form><input class="uk-checkbox" type="checkbox" name="option1" value="a1"> Популярные товары</form></div>
				<div><form><input class="uk-checkbox" type="checkbox" name="option1" value="a1"> Товары по акции</form></div>
			</div>
			</div>
			<div class="last uk-child-width-1-3@m  uk-grid-small uk-grid-match uk-grid" >
			
			@foreach($products as $product)
				
			
			
				<div class="  uk-margin-bottom">
					<div class="uk-card uk-card-default">
                                        @if ($product->popular == 1)
					<!--Выводить если товар популярный-->
					<div class="hit"><img src="/img/hit.png" alt=""></div>
					<!--   -->
                                        @endif
                                        <form><input {{Session::has('compare.'.$product->id)?'checked':''}} class="uk-checkbox compare" type="checkbox" name="option1" value="{{$product->id}}" data-id="{{$product->id}}"/> 
                                            <a href="{{route('products-compare')}}">Сравнить</a></form>
                                          
                                            @php
                                                $image = $product->getMedia('photos')->first();
                                                if($image){
                                                    $image_src = $image->getUrl();
                                                }
                                                else{
                                                $image_src = '/cat-img/8814-pw.jpg';
                                                } 
                                            @endphp
						<div class="uk-card-media-top uk-text-center">
							<img src="{{$image_src}}" alt="">
						</div>
						<div class="uk-card-body uk-text-center">
							<h3 class="uk-card-title"><a href="{{route('products-show',$product)}}">{{$product->title}}</a></h3>
							<p class="price">Цена: <span class="dark-green">{{$product->price_original}}<span> р.</p>
                                                           <form id="cart{{$product->id}}" class="add-cart" action="javascript:void(null);" onsubmit="cart_add({{$product->id}})">
                                                              
                                                               <p><input type="submit" value="{{Session::has('cart.'.$product->id)?'В корзине':'Добавить'}}"></p>
							 </form>
						</div>
					</div>
				</div>
				
                        @endforeach
			
				
				
			</div>
                    {{$products->render()}}
			
		</div>
		</div>
	</div>	
  
@endsection

@section('scripts') 
    <script src="/js/ini.js"></script>
    <script src="/js/uikit-icons.min.js"></script>
    <script>
         window.route_add_to_cart = '{{ route('products-cart-add') }}';
         window.route_del_from_cart = '{{ route('products-cart-del') }}';
         window.route_add_to_compare = '{{ route('products-compare-add') }}';
         window.route_del_from_compare = '{{ route('products-compare-del') }}';
       function cart_add(id) {
           
              var status = $('#cart'+id+' input').first().val();
              // 
               console.log(status);
                 if(status == 'Добавить') {
                       $.get(window.route_add_to_cart,{ id: id})
                               .done(function( data ) {
                        $('#cart'+data.id+' input').first().val('В корзине');
                        $('#cart_count').html(data.cart_size);
                      });
                    }else{
                        $.get(window.route_del_from_cart,{ id: id})
                               .done(function( data ) {
                        $('#cart'+data.id+' input').first().val('Добавить');
                        $('#cart_count').html(data.cart_size);
                      });
                    }
            }
            
      
      $('.compare').change( function() {
                var $this = $(this);
                if(this.checked) {
                       $.get(window.route_add_to_compare,{ id: $this.data('id')})
                               .done(function( data ) {
                        alert( "Товар добавлен в сравнение " + data );
                      });
                    }else{
                        $.get(window.route_del_from_compare,{ id: $this.data('id')})
                               .done(function( data ) {
                        alert( "Товар добавлен в сравнение " + data );
                      });
                    }
               
            });
    </script>
@endsection