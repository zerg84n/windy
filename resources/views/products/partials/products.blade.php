<div  class="last uk-child-width-1-3@m  uk-grid-small uk-grid-match uk-grid" >
			
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
                                                             <p class="price-sale">Акция: <span>{{$product->price_sale}}<span> р.</p>
                                                         @endif
                                                           <form id="cart{{$product->id}}" class="add-cart" action="javascript:void(null);" onsubmit="cart_add({{$product->id}})">
                                                              
                                                               <p><input type="submit" value="{{Session::has('cart.'.$product->id)?'В корзине':'Добавить'}}"></p>
							 </form>
						</div>
					</div>
				</div>
				
                        @endforeach
			
				</div>
		
                  {!!$products->render()!!}
			
	