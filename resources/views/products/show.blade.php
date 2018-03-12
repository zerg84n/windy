@extends('layouts.main',['ceo_title'=>$ceo_title, 'ceo_description'=>$ceo_description])
@section('styles')
    <link rel="stylesheet" type="text/css" href="/css/slideshow.css" />
    <link rel="stylesheet" type="text/css" href="/css/slideshow.css" />
    <link rel="stylesheet" type="text/css" href="/css/tovar.css" />
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
                        $image_src = '/img/blank.png';
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
		<p>+7 (812) 926-53-82</p>
		<p>info@windytech.ru</p>
			<p>Мы работаем для Вас:<br>
			ПН-ПТ: с 10:00 до 18:00</p>
		</div>
		<div class="uk-width-3-4 content" ><p class="title">{{$product->title}}</p>
                  @if (Session::has('success'))
                                     
                           <div uk-alert>
                                <a class="uk-alert-close" uk-close></a>
                                {{ Session::get('success') }}
                            </div>
                       @endif
			<div class="card-info uk-grid-small uk-grid" >
				<div class="uk-text-center info  uk-width-1-3">
					
						<div data-uk-slideshow class="uk-slidenav-position foto">
							<ul class="uk-slideshow" uk-lightbox="animation: slide">
                                                            
                                                        @forelse($product->getMedia('photos') as $media)   
                                                            <li><a href="{{$media->getUrl()}}"><img src="{{$media->getUrl()}}" alt=""></a></li>
							@empty
                                                             <li><a href="/img/blank.png"><img src="/img/blank.png" alt=""></a></li>
															
                                                        @endforelse
															
                                                        </ul>
							<ul class="uk-flex-inline foto-nav uk-align-center">
                                                        @forelse($product->getMedia('photos') as $key=>$media)    
                                                            <li data-uk-slideshow-item="{{$key}}"><a href=""><img src="{{$media->getUrl()}}" alt=""></a></li>
							@empty
                                                             <li data-uk-slideshow-item="1"><a href=""><img src="/img/blank.png" alt=""></a></li>
                                                        @endforelse	
							</ul>
						</div>
				
				</div>	
				<div class="uk-text-left  uk-margin-bottom info uk-width-2-3">
                                    @if($product->price_sale == null)
					<p class="price">Цена: <span class="dark-green">{{$product->price_original}}<span> р.</p>
                                     @else
                                        <p class="price">Обычная цена: <span class="dark-green"><del>{{$product->price_original}}</del><span> р.</p>
                                        <p class="price-sale">Цена по акции: <span class="">{{$product->price_sale}}<span> р.</p>
                                     @endif
                                        <form id="addcart{{$product->id}}" class="add-cart" action="javascript:void(null);" onsubmit="cart_add({{$product->id}})">
                                              
                                               <input id='product_count' type="number" name="amount" value="{{Session::has('cart.'.$product->id)?Session::get('cart.'.$product->id):1}}" min="1" max="100" class="uk-form-width-mini uk-form-small">
                                             
                                                
                                                  <p><input type="submit" value="{{Session::has('cart.'.$product->id)?'В корзине':'Добавить'}}"></p>
                                                 
                                        </form>
                                      <form id="cart{{$product->id}}" data-title="{{$product->title}}" class="add-cart" action="javascript:void(null);" onsubmit="show_request_form({{$product->id}})">
                                                              
                                                                <p><input type="submit" value="@if(Session::has('exist.'.$product->id))Запрос отправлен@elseУточнить наличие@endif"></p>
                                    </form>
					<div class="charakter">
                                             <p>Производитель: <span>{{$product->brand->title or ''}}</span></p>
                                            <p>Артикул: <span>{{$product->articul or ''}}</span></p>
                                       @foreach($product->values() as $property_value_model)
					<p>{{$property_value_model->property->title}}: <span>{{$property_value_model->value}}</span></p>
                                       @endforeach
					</div>
				</div>
				
					
			
			</div>
			<div class="card-info uk-grid-small">
			<ul uk-tab>
				<li><a href="" class="uk-active">Описание</a></li>
				<li ><a href="">Технические характеристики</a></li>
				
				<li><a href="">Отзывы</a></li>
			</ul>
			<ul class="uk-switcher uk-margin uk-padding-small">
			<li>             {!!$product->description!!}
                                </li>
			<li class="uk-active uk-column-1-2 charakter">
                             @foreach($product->values() as $property_value_model)
					<p>{{$property_value_model->property->title}}: <span>{{$property_value_model->value}}</span></p>
                             @endforeach
			</li>
				
				<li class="">
				<div class="uk-column-1-2">
                               @foreach ($product->getPublishedReviews() as $review)
				<div class="otziv">
					<p class="otziv-name">{{$review->name}}</p>
					<p class="otziv-content">{{$review->text}}</p>
					<p class="otziv-date">{{$review->created_at}}</p>
				</div>
				@endforeach
                                </div>
                                @if(!Session::has('review.'.$product->id))
				<div id='review-wrapper' class="uk-margin">
				<p class="green">Оставьте свой отзыв</p>
                                    <form action="{{route('products-add-review')}}" class="otziv-form" method="POST">
                                        {!!csrf_field()!!}
                                        <input type="hidden" name="product_id" value="{{$product->id}}" />
                                        <p><input name="name" class="uk-input" type="text"  placeholder="Ваше имя" required/></p>
                                        <p><input  name="email"  class="uk-input" type="email"placeholder="Email"></p>
                                        <p><textarea name="text" class="uk-textarea" placeholder="Ваш отзыв" required></textarea></p>
                                       <p><input class="uk-button uk-button-default uk-button-small" type="submit" value="Отправить"></p>
                                    </form>
                                </div>
                                @else
                                    <p class="green">Спасибо за ваш отзыв! Он появится здесь после проверки модератором.</p>
                                @endif
				</li>
			</ul>
			</div>
                       @if($product->products->count()>0)
                       <p class="title">Рекомендуем обратить внимание</p>
                       <div class="last uk-child-width-1-3@m  uk-grid-small uk-grid-match uk-grid" >
                           @foreach($product->products as $child)
				<div class="  uk-margin-bottom">
					<div class="uk-card uk-card-default">
                                          
                                            @if ($child->popular == 1)
                                            <!--Выводить если товар популярный-->
                                            <div class="hit"><img src="/img/hit.png" alt=""></div>
                                            <!--   -->
                                            @endif
					
						<div class="uk-card-media-top uk-text-center">
                                                    <a href="{{route('products-show',$child)}}"><img src="{{$child->getFirstMediaUrl('photos')?$child->getFirstMediaUrl('photos'):'/img/blank.png'}}" alt=""></a>
						</div>
						<div class="uk-card-body uk-text-center">
							<h3 class="uk-card-title"><a href="{{route('products-show',$child)}}" target="_blank">{{$child->title}}</a></h3>
							
                                                         @if($child->price_sale == null)
                                                            <p class="price">Цена: <span class="dark-green">{{$child->price_original}}<span> р.</p>
                                                         @else
                                                            <p class="price">Цена: <span class="dark-green"><del>{{$child->price_original}}</del><span> р.</p>
                                                            <p class="price-sale">Акция: <span class="">{{$child->price_sale}}<span> р.</p>
                                                         @endif
							 <form id="cart{{$child->id}}" data-title="{{$child->title}}" class="add-cart" action="javascript:void(null);" onsubmit="show_request_form({{$child->id}})">
                                                              
                                                              <p><input type="submit" value="@if(Session::has('exist.'.$child->id))Запрос отправлен@elseУточнить наличие@endif"></p>
							 </form>
						</div>
					</div>
				</div>
                           @endforeach
                       </div>
                    @endif
		</div>
	</div>
</div>
@endsection

@section('scripts') 
<script src="/js/lightbox.min.js"></script>
<script src="/js/slideshow.js"></script>
<script src="/js/slideshow-fx.js"></script>    
<script>
         window.route_add_to_cart = '{{ route('products-cart-add') }}';
         window.route_del_from_cart = '{{ route('products-cart-del') }}';
           var modal = UIkit.modal("#exist-modal-form");
            function show_request_form(id){
           //
           title = $("#cart"+id).data('title');
           $('#product-title').html(title);
           $('#exist-form-product').val(id);
            modal.show();
       }  
         
       function cart_add(id) {
               
              var status = $('#addcart'+id+' input').last().val();
              var count = $('#product_count').val();
               console.log(status);
                 if(status == 'Добавить') {
                       $.get(window.route_add_to_cart,{ id: id, count:count})
                               .done(function( data ) {
                        $('#addcart'+data.id+' input').last().val('В корзине');
                        $('.cart_counters').html(data.cart_size);
                          $('#cart_title').addClass('cart_not_empty');
                      });
                    }else{
                        $.get(window.route_del_from_cart,{ id: id})
                               .done(function( data ) {
                        $('#addcart'+data.id+' input').last().val('Добавить');
                        $('.cart_counters').html(data.cart_size);
                         if (data.cart_size==0){
                             $('#cart_title').removeClass('cart_not_empty');
                        }
                      });
                    }
            }
    </script>
@endsection
