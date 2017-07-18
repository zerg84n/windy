@extends('layouts.main')
@section('styles') 
    
@endsection

@section('content')

<div class="uk-container">
	<div class="uk-grid">
		<div class="uk-width-1-4 left-col" >
		<p class="title">Контактная информация</p>
		<p>+7 (812) 926-53-82</p>
		<p>info@windytech.ru</p>
			<p>Мы работаем для Вас:<br>
			ПН-ПТ: с 10:00 до 18:00</p>
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
                        $image_src = '';
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

