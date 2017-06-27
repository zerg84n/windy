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
		<div class="uk-width-3-4 content" ><p class="title">{{$page->title}}</p>
		<div class="news-content">	
		<p><img src="/img/clock.png" alt=""> {{$page->created_at}}</p>
                    @php
                        $image = $page->getMedia('photos')->first();
                        if($image){
                            $image_src = $image->getUrl();
                        }
                        else{
                        $image_src = '/cat-img/8814-pw.jpg';
                        } 
                    @endphp
		<div class="uk-align-left"><img src="{{$image_src or ''}}" alt=""></div>
		<p>
                    {!!$page->full_text!!}
		</p>

		</div>
                  		
		</div>
	</div>	
</div>
@endsection

@section('scripts') 

    
@endsection

