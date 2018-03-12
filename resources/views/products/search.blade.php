@extends('layouts.main')
@section('styles') 
   
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
		<div class="green uk-width-3-4 content" ><p class="title">Результаты поиска</p>
			   @include('products.partials.products')
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