@extends('layouts.main')
@section('styles') 
   <link rel="stylesheet" href="/css/range.css">
		
@endsection

@section('content')
<div class="uk-container">
<p class="title-cat">@if ($category) {{$category->title}}  @else Все товары @endif</p>
	<div class="uk-grid">
		<div class="uk-width-1-4 left-col" >
		<div class="filter">
			<p class="filter-title">Фильтр</p>
			<form id="form-filter" class="filter-form">
                                {!! csrf_field() !!}
                                <input  name="category" type="hidden"  @if(!$category) disabled  @endif   value="{{$category?$category->id:''}}">
                                <input id="sort-price" type="hidden"/>
                               <p>Цена</p>
                                <input name="price_original[min]" type="hidden" id="price_original_min" readonly>
                                <input name="price_original[max]" type="hidden" id="price_original_max" readonly>
                                <input class="no-border"  type="text" id="price_original_range" readonly>
				<div id="slider-range-price_original" ></div>
				
                               
                                @foreach ($properties as $property)
				
                                   @if($property->getInputType()=='number' || $property->getInputType()=='float')
                                   <p>{{$property->title}}</p>
                                    <input name="property[{{$property->id}}][min]" type="hidden" id="property{{$property->id}}_min" readonly>
                                    <input name="property[{{$property->id}}][max]" type="hidden" id="property{{$property->id}}_max" readonly>
                                    <input class="no-border"  type="text" id="property{{$property->id}}_range" readonly>
                                    <div id="slider-range-property{{$property->id}}" ></div>
                                   @elseif($property->getInputType()=='select')
                                   <p>{{$property->title}}</p>
                                    <ul>
                                        @foreach($property->getRange() as $value)
                                        <li><input class="uk-checkbox" type="checkbox" name="property[{{$property->id}}][]" value="{{$value->id}}">{{$value->value}}</li>
                                        @endforeach

                                    </ul>
                                   @elseif($property->getInputType()=='checkbox')
                                   <p>{{$property->title}}</p>
                                    <ul>
                                       
                                        @foreach($property->getRange() as $value)
                                        <li><input class="uk-checkbox" type="checkbox" name="property[{{$property->id}}][]" value="{{$value->getOriginal('value')?$value->getOriginal('value'):'0'}}">{{$value->value}}</li>
                                        @endforeach

                                    </ul>
                                                                     
                                   @endif
                                @endforeach
                               
                              
                                
                               
                                 <button onclick="loadData(); return false;" class="btn btn-primary">Применить фильтр</button>
			</form>
		</div>
			<p class="title">Контактная информация</p>
				<p>8 (800) 200-63-71 - звонок по России бесплатный!</p>
		<p>+7 (812) 667-86-97</p>
		<p>+7 (812) 926-53-82</p>
		<p>info@windytech.ru</p>
			<p>Мы работаем для Вас:<br>
			ПН-ПТ: с 10:00 до 18:00</p>
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
    
    <script src="/js/uikit-icons.min.js"></script>
    <script>
         window.route_add_to_cart = '{{ route('products-cart-add') }}';
         window.route_del_from_cart = '{{ route('products-cart-del') }}';
         window.route_add_to_compare = '{{ route('products-compare-add') }}';
         window.route_del_from_compare = '{{ route('products-compare-del') }}';
         
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
               
                    loadData();
                   
                   
               
            });
            
     $( function() {
                  @php
                  //min-max price fix
                    if ($category){
                        $all_products = $category->products;
                    } else {
                       $all_products = App\Product::all();
                    }
                    $min = $all_products->min('price_original');
                    $max = $all_products->max('price_original');
                    //end fix
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
                    
                  
                  
                  @foreach ($properties as $property)
                  @if ($property->getInputType()=='number' || $property->getInputType()=='float')
                  @php
                    $range = $property->getRange();
                    if ($range){
                        if ($property->getInputType()=='float'){
                              $min = round($range->first()->value);
                              $max = round($range->last()->value);
                        } else {
                         $min = $range->first()->value;
                        $max = $range->last()->value;
                        }
                        
                    } else {
                        $min = 0;
                        $max = 0;
                    }  
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
    
  $('.uk-pagination a').click( function(e){
			e.preventDefault();
			var page = $(this).attr('href').split('page=')[1];
                        if ($('#sort-price').val()){
                            loadData($('#sort-price').val(),page);
                        } else {
                             loadData(false,page);
                        }
			
			//location.hash = page;
                        console.log(page);
                        
		});
    
       function loadData(sortBy, page){
       
        var fields = $('#form-filter').serialize();
        if (sortBy){
            fields = fields+"&sort="+sortBy;
            $('#sort-price').val(sortBy);
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
			if ($('#sort-price').val()){
                            loadData($('#sort-price').val(),page);
                        } else {
                             loadData(false,page);
                        }
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