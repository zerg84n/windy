@extends('layouts.main')
@section('styles') 
    <link rel="stylesheet" type="text/css" href="/css/slideshow.css" />
@endsection

@section('content')
<div class="uk-container slider">
<div data-uk-slideshow="{autoplay:true}" class="uk-slidenav-position">
    <ul class="uk-slideshow">
        @foreach($slider->getMedia('photos') as $media)
        <li><img src="{{$media->getUrl()}}"></li>
       
	@endforeach	
    </ul>
    <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
        <li data-uk-slideshow-item="0"><a href=""></a></li>
        <li data-uk-slideshow-item="1"><a href=""></a></li>
		<li data-uk-slideshow-item="2"><a href=""></a></li>
    </ul>
</div>
</div>
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
				@if($news->image_url)
                                <a href="{{$news->image_url or '#'}}"><img src="{{$image_src or ''}}" alt=""></a>
                                @else
                                    <img src="{{$image_src or ''}}" alt="">
                                @endif
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
		<div class="green uk-width-3-4 content" >
		<div class="seo">           {!!$ceo_head_text or ''!!}</div>
		<p class="title">Поcледние товары</p>
			<div class="last uk-child-width-1-3@m  uk-grid-small uk-grid-match uk-grid" >
                         
			@foreach($products as $product)
				
			
			
				<div class="{{$product->popular?"":"not-popular"}} uk-margin-bottom">
					<div class="uk-card uk-card-default">
                                        @if ($product->popular == 1)
					<!--Выводить если товар популярный-->
					<div class="hit"><img src="/img/hit.png" alt=""></div>
					<!--   -->
                                        @endif
                                        <form><input {{Session::has('compare.'.$product->id)?'checked':''}} class="uk-checkbox compare" type="checkbox" name="option1" value="{{$product->id}}" data-id="{{$product->id}}"/> 
                                            <a href="{{route('products-compare')}}">Сравнить(<span class="compare_count">{{count(Session::get('compare',[]))}}</span>)</a></form>
                                          
                                            @php
                                                $image = $product->getMedia('photos')->first();
                                                if($image){
                                                    $image_src = $image->getUrl();
                                                }
                                                else{
                                                $image_src = '/img/blank.png';
                                                } 
                                            @endphp
						<div class="uk-card-media-top uk-text-center">
                                                    <a href="{{route('products-show',$product)}}"><img src="{{$image_src}}" alt=""></a>
						</div>
						<div class="uk-card-body uk-text-center">
							<h3 class="uk-card-title"><a href="{{route('products-show',$product)}}">{{$product->title}}</a></h3>
							            
                                                         @if($product->price_sale == null)
                                                            <p class="price">Цена: <span class="dark-green">{{$product->price_original}}<span> р.</p>
                                                         @else
                                                            <p class="price">Цена: <span class="dark-green"><del>{{$product->price_original}}</del> <span> р.</p>
                                                             <p class="price-sale">Акция: <span class="">{{$product->price_sale}}<span> р.</p>
                                                         @endif
                                                         
                                                                    <form id="cart{{$product->id}}" data-title="{{$product->title}}" class="add-cart" action="javascript:void(null);" onsubmit="show_request_form({{$product->id}})">
                                                              
                                                               <p><input type="submit" value="@if(Session::has('exist.'.$product->id))Запрос отправлен@elseУточнить наличие@endif"></p>
							 </form>
						</div>
					</div>
				</div>
				
                        @endforeach
				
			</div>
            <div class="seo">         {!!$ceo_foot_text or ''!!}     </div>         
		</div>
		</div>
	</div>	
  
@endsection

@section('scripts') 
<script src="/js/slideshow.js"></script>
<script src="/js/slideshow-fx.js"></script>
  <script>
      
      var modal = UIkit.modal("#exist-modal-form");


         window.route_add_to_cart = '{{ route('products-cart-add') }}';
         window.route_del_from_cart = '{{ route('products-cart-del') }}';
         
       function show_request_form(id){
           //
           title = $("#cart"+id).data('title');
           $('#product-title').html(title);
           $('#exist-form-product').val(id);
            modal.show();
       }  
         
       function cart_add(id) {
           
              var status = $('#cart'+id+' input').first().val();
              // 
               console.log(status);
                 if(status == 'Добавить') {
                       $.get(window.route_add_to_cart,{ id: id})
                               .done(function( data ) {
                        $('#cart'+data.id+' input').first().val('В корзине');
                        $('.cart_counters').html(data.cart_size);
                        $('#cart_title').addClass('cart_not_empty');
                      });
                    }else{
                        $.get(window.route_del_from_cart,{ id: id})
                               .done(function( data ) {
                        $('#cart'+data.id+' input').first().val('Добавить');
                        $('.cart_counters').html(data.cart_size);
                        if (data.cart_size==0){
                             $('#cart_title').removeClass('cart_not_empty');
                        }
                      });
                    }
            }
            
         window.route_add_to_compare = '{{ route('products-compare-add') }}';
         window.route_del_from_compare = '{{ route('products-compare-del') }}';
               $('.compare').change( function() {
                var $this = $(this);
                if(this.checked) {
                       var count = $('.compare_count').first().html();
                       if (count<5)
                       {   
                            $.get(window.route_add_to_compare,{ id: $this.data('id')})
                                    .done(function( data ) {
                             $('.compare_count').html(data);

                           });
                      } else 
                      {
                          alert('Вы не можете сравнивать более 5 товаров.');
                          $(this).prop('checked',false);
                          
                      }
                    }else{
                        $.get(window.route_del_from_compare,{ id: $this.data('id')})
                               .done(function( data ) {
                        $('.compare_count').html(data);
                      });
                    }
               
            });
    </script>   
@endsection