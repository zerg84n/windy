@extends('layouts.main')
@section('styles') 
    
@endsection

@section('content')

<div class="uk-container">
	<div class="uk-grid">
		<div class="uk-width-1-4 left-col" >
		<p class="title">Контактная информация</p>
		<p>+7 (812) 123-45-78</p>
		<p>info@wendy.ru </p>
		<p>Мы работаем для Вас:<br>
		ПН-ПТ: 08:00 - 18:00<br>СБ: 10:00 - 16:00 </p>
		</div>
		<div class="uk-width-3-4 content" ><p class="title">{{$news->title}}</p>
		<div class="news-content">	
		<p><img src="/img/clock.png" alt=""> {{$news->created_at}}</p>
                    @php
                        $image = $news->getMedia('photos')->first();
                        if($image){
                            $image_src = $image->getUrl();
                        }
                        else{
                        $image_src = '/cat-img/8814-pw.jpg';
                        } 
                    @endphp
		<div class="uk-align-left"><img src="{{$image_src or ''}}" alt=""></div>
		<p>
                    {!!$news->full_text!!}
		</p>

		</div>
                    <a class="all-news uk-align-right" href="{{route('news-index')}}">Все новости</a>		
		</div>
	</div>	
</div>
@endsection

@section('scripts') 

    
@endsection

