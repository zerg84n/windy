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
		<div class="green uk-width-3-4 content" ><p class="title">Поcледние товары</p>
			<div class="last uk-child-width-1-3@m  uk-grid-small uk-grid-match uk-grid" >
                            @foreach($products as $product)
                            @php
                                $image = $product->getMedia('photos')->first();
                                if($image){
                                    $image_src = $image->getUrl();
                                }
                                else{
                                $image_src = '/cat-img/8814-pw.jpg';
                                } 
                            @endphp
				<div class="  uk-margin-bottom">
					<div class="uk-card uk-card-default">
					 <form><input {{Session::has('compare.'.$product->id)?'checked':''}} class="uk-checkbox compare" type="checkbox" name="option1" value="{{$product->id}}" data-id="{{$product->id}}"/> 
						  <a href="{{route('products-compare')}}">Сравнить(<span class="compare_count">{{count(Session::get('compare',[]))}}</span>)</a></form>
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
			<a class="all-news uk-align-right" href="{{route('products-catalog')}}">Посмотреть все товары</a>
		</div>
		</div>
	</div>	
  
@endsection

@section('scripts') 
<script src="/js/slideshow.js"></script>
<script src="/js/slideshow-fx.js"></script>
  <script>
         window.route_add_to_cart = '{{ route('products-cart-add') }}';
         window.route_del_from_cart = '{{ route('products-cart-del') }}';
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
            
         window.route_add_to_compare = '{{ route('products-compare-add') }}';
         window.route_del_from_compare = '{{ route('products-compare-del') }}';
             $('.compare').change( function() {
                var $this = $(this);
                if(this.checked) {
                       $.get(window.route_add_to_compare,{ id: $this.data('id')})
                               .done(function( data ) {
                       $('.compare_count').html(data);
                      });
                    }else{
                        $.get(window.route_del_from_compare,{ id: $this.data('id')})
                               .done(function( data ) {
                      $('.compare_count').html(data);
                      });
                    }
               
            });
    </script>   
@endsection