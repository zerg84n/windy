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
			<form id="form-filter" class="filter-form">
                                {!! csrf_field() !!}
                                <input name="category" type="hidden"  value="{{$category->id}}">
				<p>Цена</p>
                                <input name="price_original[min]" type="hidden" id="price_original_min" readonly>
                                <input name="price_original[max]" type="hidden" id="price_original_max" readonly>
                                <input class="no-border"  type="text" id="price_original_range" readonly>
				<div id="slider-range-price_original" ></div>
				
                                @if ($category)
                                @foreach ($category->properties as $property)
				<p>{{$property->title}}</p>
                                   @if($property->getInputType()=='number')
                                    <input name="property[{{$property->id}}][min]" type="hidden" id="property{{$property->id}}_min" readonly>
                                    <input name="property[{{$property->id}}][max]" type="hidden" id="property{{$property->id}}_max" readonly>
                                    <input class="no-border"  type="text" id="property{{$property->id}}_range" readonly>
                                    <div id="slider-range-property{{$property->id}}" ></div>
                                   @elseif($property->getInputType()=='select')
                                    <ul>
                                        @foreach($property->getRange() as $value)
                                        <li><input class="uk-checkbox" type="checkbox" name="property[{{$property->id}}][]" value="{{$value->id}}">{{$value->value}}</li>
                                        @endforeach

                                    </ul>
                                   @elseif($property->getInputType()=='checkbox')
                                    <ul>
                                        @foreach($property->getRange() as $value)
                                        <li><input class="uk-checkbox" type="checkbox" name="property[{{$property->id}}][]" value="{{$value->value}}">{{$value->value?"Есть":"Нет"}}</li>
                                        @endforeach

                                    </ul>
                                   @else
                                    <ul>
                                        @foreach($property->getRange() as $value)
                                        <li><input class="uk-checkbox" type="checkbox" name="property[{{$property->id}}][]" value="{{$value->value}}">{{$value->value}}</li>
                                        @endforeach

                                    </ul>
                                   @endif
                                @endforeach
                                @endif
                                
                               
                                 <button onclick="loadData(); return false;" class="btn btn-primary">Применить фильтр</button>
			</form>
		</div>
			<p class="title">Контактная информация</p>
			<p>+7 (812) 123-45-78</p>
			<p>info@wendy.ru </p>
			<p>Мы работаем для Вас:<br>
			ПН-ПТ: 08:00 - 18:00<br>СБ: 10:00 - 16:00 </p>
		</div>
                <div  class="green uk-width-3-4 content" >
                    
			<div class="sort">
			<div class="uk-column-1-3 uk-column-divider">
				<div>Сортировать по цене: <a href="javascript:loadData('desc')" uk-icon="icon: arrow-down"></a> <a href="javascript:loadData('asc')" uk-icon="icon: arrow-up"></a></div>
				<div><form><input id="popular-filter" class="uk-checkbox" type="checkbox" name="popular" value="1"> Популярные товары</form></div>
				
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
              $('#popular-filter').change( function() {
               
                    loadData();
                   
                   
               
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
    
  $('.uk-pagination a').click( function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
			loadData('desc',page);
			//location.hash = page;
                        console.log(page);
                        
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