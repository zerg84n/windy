@extends('layouts.main')
@section('styles') 
   <link rel="stylesheet" href="/css/range.css">
		
@endsection

@section('content')
<div class="uk-container">
<p class="title-cat">@if ($category) {{$category->title}}. @else Все товары. @endif {{$filter or ''}}</p>
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
                <div  class="green uk-width-3-4 content" >
                    
			
			<div class="sort">
			<div class="uk-column-1-3 uk-column-divider">
				
                                  @php
                                    $input = Request::all();
                                   if (Request::has('popular')){

                                       unset($input['popular']);

                                   } else {
                                       $input['popular'] = 1;
                                   }
                                 
                                 @endphp
                                 <div>Сортировать по цене: 
                                     <a href="{{route('products-catalog-alias',array_merge(Request::all(),['sort'=>'desc']))}}" uk-icon="icon: arrow-down"></a> 
                                     <a href="{{route('products-catalog-alias',array_merge(Request::all(),['sort'=>'asc']))}}" uk-icon="icon: arrow-up"></a>
                                 </div>
                                <div>
                                    @if (Request::has('popular'))
                                        <a href="{{route('products-catalog-alias',array_merge($input,['page'=>1]))}}">Все</a>
                                    @else
                                    <a href="{{route('products-catalog-alias',array_merge($input,['page'=>1]))}}">Только популярные</a>
                                    @endif
                                </div>
				
			</div>
			</div>
			
                  <div id="products-wrapper" >  
                      @include('products.partials.products')
                      		
		</div>	
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
      $('#popular-filter').change( function() {
               
            
                
                window.location = "{{route('products-catalog-alias',$input)}}";
                   
                   
               
            });
            
     $( function() {
                  @php
                    $min = $products->min('price_original');
                    $max = $products->max('price_original');
                  @endphp
                  $( "#slider-range-price_original" ).slider({
                      range: true,
                      min: {{$min}},
                      max: {{$max}},
                      values: [ {{$min}}, {{$max}} ],
                      slide: function( event, ui ) {
                        $( "#price_original_min" ).val( ui.values[ 0 ]);
                         $( "#price_original_max" ).val(ui.values[ 1 ]);
                         
                         $( "#price_original_range" ).val('от '+ui.values[ 0 ]+' до '+ui.values[ 1 ]);
                      }
                    });
                    $( "#price_original_min" ).val(  $( "#slider-range-price_original" ).slider( "values", 0 ));
                     $( "#price_original_max" ).val(  $( "#slider-range-price_original" ).slider( "values", 1 ));
                       $( "#price_original_range" ).val('от '+$( "#slider-range-price_original" ).slider( "values", 0 )+' до '+$( "#slider-range-price_original" ).slider( "values", 1 ));
                    
                  
                  
                  @foreach ($category->properties as $property)
                  @if ($property->getInputType()=='number')
                  @php
                    $range = $property->getRange();
                    $min = $range->first()->value;
                    $max = $range->last()->value;
                    if(!$min) $min = 0;
                  @endphp
                    $( "#slider-range-property{{$property->id}}" ).slider({
                      range: true,
                      min: {{$min}},
                      max: {{$max}},
                      values: [ {{$min}}, {{$max}} ],
                      slide: function( event, ui ) {
                        $( "#property{{$property->id}}_min" ).val( ui.values[ 0 ]);
                         $( "#property{{$property->id}}_max" ).val(ui.values[ 1 ]);
                         
                         $( "#property{{$property->id}}_range" ).val('от '+ui.values[ 0 ]+' до '+ui.values[ 1 ]);
                      }
                    });
                    $( "#property{{$property->id}}_min" ).val(  $( "#slider-range-property{{$property->id}}" ).slider( "values", 0 ));
                     $( "#property{{$property->id}}_max" ).val(  $( "#slider-range-property{{$property->id}}" ).slider( "values", 1 ));
                       $( "#property{{$property->id}}_range" ).val('от '+$( "#slider-range-property{{$property->id}}" ).slider( "values", 0 )+' до '+$( "#slider-range-property{{$property->id}}" ).slider( "values", 1 ));
                    
                 @endif
              @endforeach
    });    
    

    
       function loadData(sortBy, page){
       
        var fields = $('#form-filter').serialize();
        if (sortBy){
            fields = fields+"&sort="+sortBy;
        }
         if (page){
            fields = fields+"&page="+page;
        }
        if( $('#popular-filter').prop('checked')){
             fields = fields+"&popular=1";
        }
       
        $.ajax({
            type: 'POST',
            url: '{{route("products-filter")}}',
            data: fields,
            beforeSend: function(){
               console.log('waiting...');
               
            },
            success: function(data){
                $('#products-wrapper').html(data);
                 
               
                 $('.uk-pagination a').click( function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			loadData('desc',page);
			//location.hash = page;
                        console.log(page);
                        
		});  
                
            },
            error: function(xhr,str){
                console.log('error');
            }
        });
    }
    
    
    </script>
    
    
@endsection