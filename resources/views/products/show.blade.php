@extends('layouts.main')
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
		<div class="uk-width-3-4 content" ><p class="title">{{$product->title}}</p>
			<div class="card-info uk-grid-small uk-grid" >
				<div class="uk-text-center info  uk-width-1-3">
					
						<div data-uk-slideshow class="uk-slidenav-position foto">
							<ul class="uk-slideshow">
                                                            
                                                        @foreach($product->getMedia('photos') as $media)   
                                                        <li><a href="{{$image->getUrl()}}" data-uk-lightbox><img src="{{$media->getUrl()}}" alt=""></a></li>
							@endforeach
                                                        </ul>
							<ul class="uk-flex-inline foto-nav uk-align-center">
                                                        @foreach($product->getMedia('photos') as $key=>$media)    
                                                        <li data-uk-slideshow-item="{{$key}}"><a href=""><img src="{{$media->getUrl()}}" alt=""></a></li>
							@endforeach	
							</ul>
						</div>
				
				</div>	
				<div class="uk-text-left  uk-margin-bottom info uk-width-2-3">
					<p class="price">Цена: <span class="dark-green">{{$product->price_original}}<span> р.</p>
					<form  class="add-cart">
						
						<input type="number" name="amount" value="1" min="0" max="100" class="uk-form-width-mini uk-form-small">
						
						<p><input type="submit" value="Добавить"></p>
					</form>
					<div class="charakter">
                                       @foreach($product->values() as $property_value_model)
					<p>{{$property_value_model->property->title}}: <span>{{$property_value_model->value}}</span></p>
                                       @endforeach
					</div>
				</div>
				
					
			
			</div>
			<div class="card-info uk-grid-small">
			<ul uk-tab>
				<li class="uk-active"><a href="">Технические характеристики</a></li>
				<li><a href="">Описание</a></li>
				<li><a href="">Отзывы</a></li>
			</ul>
			<ul class="uk-switcher uk-margin uk-padding-small">
			<li class="uk-active uk-column-1-2 charakter">
                             @foreach($product->values() as $property_value_model)
					<p>{{$property_value_model->property->title}}: <span>{{$property_value_model->value}}</span></p>
                             @endforeach
			</li>
				<li>Описание:<br>
                                    {{$product->description}}
                                </li>
				<li class="">
				<div class="uk-column-1-2">
                               @foreach ($product->reviews as $review)
				<div class="otziv">
					<p class="otziv-name">{{$review->name}}</p>
					<p class="otziv-content">{{$review->text}}</p>
					<p class="otziv-date">{{$review->created_at}}</p>
				</div>
				@endforeach
                                </div>
				<div class="uk-margin">
				<p class="green">Оставьте свой отзыв</p>
				<form class="otziv-form">
				   <p><input class="uk-input" type="text" name="text" placeholder="Ваше имя"></p>
				   <p><textarea class="uk-textarea" placeholder="Ваш отзыв"></textarea></p>
				   <p><input class="uk-button uk-button-default uk-button-small" type="submit" value="Отправить"></p>
				</form></div>
				</li>
			</ul>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts') 
<script src="/js/lightbox.min.js"></script>
<script src="/js/slideshow.js"></script>
<script src="/js/slideshow-fx.js"></script>    
@endsection
