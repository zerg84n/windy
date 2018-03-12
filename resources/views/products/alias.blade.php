@extends('layouts.main',['ceo_title'=>$ceo_title, 'ceo_description'=>$ceo_description])
@section('styles') 
   <link rel="stylesheet" href="/css/range.css">
		
@endsection

@section('content')
<div class="uk-container">
    
<p class="title-cat">@if ($category) {{$category->title}}. @else Все товары. @endif  @forelse($brand_list as $brand) {{$brand}},   @empty Все производители, @endforelse  {{$filter or ''}} Найдено {{$products->total()}}.</p>
	<div class="uk-grid">
		<div class="uk-width-1-4 left-col" >
                    @if ($category && $category->menu)
                    <div class="filter">
                        <p class="filter-title">Меню</p>
                        <ul>
                             @forelse($category->menu->items as $item) 
                             <li><a href="{{$item->url}}">{{$item->text}}</a></li>
                          
                             @empty 
                             Нет пунктов
                             @endforelse
                       </ul>  
                    </div>  
                    @endif
		<div class="filter">
			<p class="filter-title">Фильтр</p>
                        <form id="form-filter" name="myform" class="filter-form" method="POST" action="{{route('products-catalog-human',['category_slug'=>$category->slug])}}">
                               {!!csrf_field() !!}
                               <input id="sort-price" name="sort" type="hidden" value=""/>
                              
                                <p>Производитель</p>
                                <ul>
                                       
                                        @foreach($brands as $brand)
                                        <li><input {{$brand_list->contains($brand->slug)?'checked':''}} class="uk-checkbox brands-checkbox" data-slug="{{$brand->slug}}" type="checkbox"  >{{$brand->title}}</li>
                                        @endforeach

                                </ul>
                                
                               <p>Цена</p>
                               <input name="price_original[min]" type="hidden" id="price_original_min" readonly>
                                <input name="price_original[max]" type="hidden" id="price_original_max" readonly>
                                <input class="no-border"  type="text" id="price_original_range" readonly>
				<div id="slider-range-price_original" ></div>
				
                               
                                @foreach ($properties as $property)
				
                                   @if($property->getInputType()=='number' || $property->getInputType()=='float')
                                   <p>{{$property->title}}</p>
                                    <input name="{{$property->alias}}[min]" type="hidden" id="property{{$property->id}}_min" readonly>
                                    <input name="{{$property->alias}}[max]" type="hidden" id="property{{$property->id}}_max" readonly>
                                    <input class="no-border"  type="text" id="property{{$property->id}}_range" readonly>
                                    <div id="slider-range-property{{$property->id}}" ></div>
                                   @elseif($property->getInputType()=='select')
                                   <p>{{$property->title}}</p>
                                    <ul>
                                        @foreach($property->getRange() as $value)
                                        <li><input class="uk-checkbox" type="checkbox" name="{{$property->alias}}[{{$value->id}}]" value="{{$value->value}}" @if(isset($old_inputs[$property->alias]) && in_array($value->value, $old_inputs[$property->alias])) checked @endif >{{$value->value}}</li>
                                        @endforeach

                                    </ul>
                                   @elseif($property->getInputType()=='checkbox')
                                   <p>{{$property->title}}</p>
                                    <ul>
                                       
                                        @foreach($property->getRange() as $value)
                                        <li><input class="uk-checkbox" type="checkbox" name="{{$property->alias}}[{{$value->id}}]" @if(isset($old_inputs[$property->alias]) && in_array($value->getOriginal('value'),$old_inputs[$property->alias])) checked @endif  value="{{$value->getOriginal('value')?$value->getOriginal('value'):'0'}}">{{$value->value}}</li>
                                        @endforeach

                                    </ul>
                                                                     
                                   @endif
                                @endforeach
                               
                              
                                
                               
                                <input type="submit" class="f-btn" value="Применить"/>
                                
			</form>
                          
                        <button onclick="location.href='{{route('products-catalog-human',['category_slug'=>$category->slug])}}'" class="btn btn-primary">Сброс</button>
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
				
                                  @php
                                    $input = Request::all();
                                   if (Request::has('popular')){

                                       unset($input['popular']);

                                   } else {
                                       $input['popular'] = 1;
                                   }
                                 
                                 @endphp
                                 <div>Сортировать по цене: 
                                     <a href="#" onclick="sort_price('desc');" uk-icon="icon: arrow-down"></a> 
                                     <a href="javascript:sort_price('asc');" uk-icon="icon: arrow-up"></a>
                                 </div>
                                <div>
                                    @if (Request::has('popular')&& Request::input('popular')==1)
                                        <a href="{{Request::Url()}}">Все</a>
                                    @else
                                    <a href="{{Request::Url()}}?popular=1&page=1">Только популярные</a>
                                    @endif
                                </div>
				
			</div>
			</div>
                     <div class="seo">   {!!$ceo_head_text or ''!!}</div>
			
                  <div id="products-wrapper" >  
                      @include('products.partials.products')
                      		
		</div>
                      <div class="seo">{!!$ceo_foot_text or ''!!}     </div>
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
                      });
                    }else{
                        $.get(window.route_del_from_cart,{ id: id})
                               .done(function( data ) {
                        $('#cart'+data.id+' input').first().val('Добавить');
                       $('.cart_counters').html(data.cart_size);
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
               
            
                
            
                   
                   
               
            });
            
    $( function() {
         window.form_action = $('#form-filter').attr('action');
         init_brands_url();
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
                      values: [ {{$old_inputs['price_original']['min'] or $min}}, {{$old_inputs['price_original']['max'] or $max}} ],
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
                    
                    $range = $property->getRange($category);
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
                      values: [ {{$old_inputs[$property->alias]['min'] or $min}}, {{$old_inputs[$property->alias]['max'] or $max}} ],
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
    
   
    function sort_price(sort_direction){
        
        $('#sort-price').val(sort_direction);
        var brands = [];
        $('.brands-checkbox').each(function(index,item){
         var checkbox = $(item);
          
          if (checkbox.prop('checked')){
              brands.push(checkbox.data('slug'));
          }
       });
       if (brands.length > 0){
            var brands_list =  brands.join('&');
       } else {
           brands_list = 'vse';
       }
       
        
       $('#form-filter').prop('action',form_action+'/'+brands_list)
        console.log(sort_direction);
      
       document.myform.submit();
    }
       function init_brands_url(){
           var brands = [];
        $('.brands-checkbox').each(function(index,item){
         var checkbox = $(item);
          
          if (checkbox.prop('checked')){
              brands.push(checkbox.data('slug'));
          }
       });
     if (brands.length > 0){
            var brands_list =  brands.join('&');
       } else {
           brands_list = 'vse';
       }
       $('#form-filter').prop('action',form_action+'/'+brands_list)
       
         
        
    }
    
    $('.brands-checkbox').change(function(){
       
       var brands = [];
        $('.brands-checkbox').each(function(index,item){
         var checkbox = $(item);
          
          if (checkbox.prop('checked')){
              brands.push(checkbox.data('slug'));
          }
       });
        var brands_list =  brands.join('&');
        if(brands_list){
            $('#form-filter').prop('action',form_action+'/'+brands_list);
        }else{
             $('#form-filter').prop('action',form_action);
        }
       
    });
    </script>
    
    
@endsection