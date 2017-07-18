@extends('layouts.main')
@section('styles')
    	<link rel="stylesheet" type="text/css" href="/css/compare.css" />
 @endsection       
@section('content')
    <div class="uk-container">
        @foreach($categories as $category)
	<div class="compare">
		
		<div class="content" ><p class="title">Сравнение  {{$category->title}}</p>
			
			<table class="compare-table">
				
				<tr>
                                    
					<td>
					</td>
                                        @foreach($products->where('category_id',$category->id) as $product)
                                        <th class="product{{$product->id}}">
                                            <img src="{{$product->getFirstMediaUrl('photos')?$product->getFirstMediaUrl('photos'):'/cat-img/8814-pw.jpg'}}" alt=""><br>
						<a href="{{route('products-show',$product)}}">{{$product->title}}</a>
						<p>{{$product->price_original}} р.</p>
					</th>
					@endforeach
				</tr>
				<tr>
					<td class="compare-tab">
						<a href="javascript:void(0)" class="compare-tab-active all-ch"><span>Все параметры</span></a>
						<a href="javascript:void(0)" class="different"><span>Различающиеся</span></a>
					</td>
                                      @foreach($products->where('category_id',$category->id) as $product)  
					<td class="product{{$product->id}}">
                                            <button class="compare-del" data-id="{{$product->id}}">Удалить</button>
					</td>
					
                                     @endforeach   
				</tr>
                                @foreach($category->properties as $property)
                                @php
                                    $product1=$products->where('category_id',$category->id)->first();
                                    $last_prop = $product1->getPropertyValue($property->id);
                                    $all = 'all';
                                    $properties = [];
                                    foreach($products->where('category_id',$category->id) as $product){
                                        if ($last_prop != $product->getPropertyValue($property->id)){
                                        
                                            $all = '';
                                        }
                                       $properties[$product->id] = $product->getPropertyValue($property->id);
                                    }
                                @endphp
				<tr class="{{$all}}">
					<td>
						{{$property->title}}
					</td>
                                       @foreach($properties as $key=>$value)  
					<td class="product{{$key}}">
						{{$value}}
					</td>
					@endforeach
				</tr>
				
				@endforeach
			</table>
			
			<div style="clear:both;">
			
		</div>
            </div>
        </div>
        @endforeach

    </div>
@endsection

@section('scripts') 
    <script>
         window.route_add_to_compare = '{{ route('products-compare-add') }}';
         window.route_del_from_compare = '{{ route('products-compare-del') }}';
      $('.compare-del').click(function(){
          
          var $this = $(this);
         var id = $this.data('id');
           $.get(window.route_del_from_compare,{ id: id})
                               .done(function( data ) {
                         $('.product'+id).remove();
                      });
         
         
      });
              
            
           
              
            
            
//            change( function() {
//                var $this = $(this);
//                if(this.checked) {
//                       $.get(window.route_add_to_compare,{ id: $this.data('id')})
//                               .done(function( data ) {
//                        alert( "Добавлено в сравнение " + data );
//                      });
//                    }else{
//                        $.get(window.route_del_from_compare,{ id: $this.data('id')})
//                               .done(function( data ) {
//                        alert( "Удалено из сравнения" + data );
//                      });
//                    }
//               
//            });
   

$( ".compare-tab a" ).on("click", function(){
	
	$('a').removeClass('compare-tab-active');
	$(this).addClass('compare-tab-active').stop();
});
$( ".different" ).on("click", function(){
	
	$( ".all" ).css({'display' : 'none'});
	
});
$( ".all-ch" ).on("click", function(){
	
	$( ".all" ).css({'display' : 'table-row'});
	
});
</script>
@endsection