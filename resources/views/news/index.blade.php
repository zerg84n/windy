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
           <div class='green uk-width-3-4 content'><p class="title">Новости</p>   
          <div class="uk-child-width-1-2@m  uk-grid-small uk-grid-match uk-grid news-page"> 
             @foreach($all_news as $news)       
              
                    <div class="uk-margin-bottom ">
                        <div class="uk-card uk-card-default uk-grid-collapse uk-grid" >
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
                                <img src="{{$image_src or ''}}" alt="">
                            </div>
                            <div class="uk-width-2-3">
                                <div class="uk-card-body">
                                    <h3 class="uk-card-title">{{$news->title}}</h3>
                                    <p>{{$news->short}}</p>
                                </div>
                            </div>
                            <div class="uk-card-footer uk-width-3-3 uk-column-1-2">
                            <p><img src="/img/clock.png" alt=""> {{$news->created_at}}</p>
                            <p class="uk-text-right"><a href="{{route('news-show',$news)}}" class="uk-button uk-button-text">Подробнее</a></p>
                            </div>
                        </div>
                    </div>
        
          
          @endforeach 
          
           
	
           </div>  
               {{$all_news->render()}}
    </div>
</div>
</div>
@endsection

@section('scripts') 

    
@endsection