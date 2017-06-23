<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" type="text/css" href="/css/uikit.min.css" />
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
		<link rel="stylesheet" type="text/css" href="/css/menu.css" />
                
                @yield('styles')
                
                
		<script src="http://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                <script src="/js/menu.js"></script>
		<script src="/js/uikit.min.js"></script>
		<script src="/js/uikit.js"></script>
		
		
		
</head>
<body>
<div id="page-wrapper">
		<!-- This is the modal -->
			<div id="modal-form" uk-modal>
				<div id="mail-form-wrapper" class="uk-modal-dialog uk-modal-body">
					<p class="title">Заказать звонок</p>
					<p class="uk-text-right">
						<form id="mail-form" class="call">
                                                    <p><input id="mail-form-name" type="text" name="name" placeholder="Ваше имя" class="uk-input uk-form-width-medium uk-form-small" required></p>
							   <p><input id="mail-form-phone"  type="phone" name="phone" placeholder="Ваш телефон" class="uk-input uk-form-width-medium uk-form-small" required></p>
                                                           <p><input  id="agreement" class="uk-checkbox" type="checkbox" name="aggrement" value="1" checked readonly> Даю согласие на обработку персональных данных</p>
                                                           <p id="mail-form-danger" class="uk-form-danger"></p>
                                                           <p><a href="javascript:orderCall()" class="uk-button uk-button-default uk-button-small">Отправить</a></p>
						</form>
					</p>
				</div>
			</div>
		<div class="head-top">
		<div class="uk-container">
			<div class="uk-grid">
				<div class="uk-width-1-2 call">
					<a href="#modal-form" uk-toggle>Заказать звонок <img src="/img/call.png"></a>
				</div>
				<div class="uk-width-1-4 cart uk-text-right">
                                    <a href="{{route('products-cart-index')}}"><img src="/img/cart.png"> Корзина (<span id="cart_count">{{count(Session::get('cart'))}}</span>)</a>
				</div>
                                 
				<div class="uk-width-1-4 uk-text-right links">
					<script type="text/javascript">(function() {
                                    if (window.pluso)if (typeof window.pluso.start == "function") return;
                                    if (window.ifpluso==undefined) { window.ifpluso = 1;
                                      var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                      s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                      s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                                      var h=d[g]('body')[0];
                                      h.appendChild(s);
                                    }})();</script>
                          <div class="pluso" style="margin-top: 5px" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,facebook"></div>
				</div>
					</div>
		</div>
		</div>
		<div class="uk-container head-middle">
			<div class="uk-grid">	
				<div class="uk-width-2-5 logo">
                                    <a href="{{route('products-index')}}"><img src="/img/logo.png"></a>
				</div>
				<div class="uk-width-3-5 uk-text-right">
                                    @if($top_menu)
					<ul class="top-menu">
                                            @foreach($top_menu->items as $item)
                                            <li><a href="{{$item->url}}">{{$item->text}}</a></li>
                                            @endforeach
					</ul>
                                    @endif
					<div class="uk-grid">
						<div class="green uk-width-1-3"><img src="/img/phone.png"> 8 800 999999</div>
						<div class="green uk-width-1-3"><img src="/img/mail.png"> info@windytech.ru</div>
						<div class="uk-width-1-3">
                                                    <form action="{{route('products-search')}}" method="GET" class="search">
                                                        <input id='search' type="search" name="keyword" value="{{$keyword or ''}}" class="uk-width-4-5">
							   <input type="submit" value="" class="uk-width-1-5"/>
							 </form>
						</div>
					</div>
				</div>
			</div>
		</div>	

				<nav id="nav" class="uk-container">
					<ul class="main-ul">
                                          @foreach($main_menu->items as $root_item)
                                          <li><a class="a-drop-down" href="{{$root_item->url}}">{{$root_item->text or $root_item->title}}</a>
							<div class="nav-drop-down">
							<div class="uk-container">
                                                            @foreach($root_item->menus as $sub_menu)
								<div class="sub-menu">
									<p>{{$sub_menu->text or $sub_menu->title}}</p>
									<ul>
                                                                            @foreach($sub_menu->items as $sub_item)
										<li><a href="{{$sub_item->url or '#'}}">{{$sub_item->text or $sub_item->title}}</a></li>
                                                                            @endforeach
									</ul>
								</div>
							@endforeach
							</div>
							</div>		
						</li>
						
                                            @endforeach
					</ul>
				</nav>
				
					
		</div>


 @yield('content')
 
 <div id="footer">
	<div class="uk-container">
		<div class="uk-grid">
			<div class="uk-width-1-2 uk-text-left footer-left">
				<div><p>Посоветовать другу</p>
					<script type="text/javascript">(function() {
                                    if (window.pluso)if (typeof window.pluso.start == "function") return;
                                    if (window.ifpluso==undefined) { window.ifpluso = 1;
                                      var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                      s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                      s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                                      var h=d[g]('body')[0];
                                      h.appendChild(s);
                                    }})();</script>
                          <div class="pluso" style="vertical-align: middle" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,facebook"></div>
			
                                </div>
				<div><img src="/img/pay.png" class="uk-text-bottom"></div>
				<p class="copyright">Интернет-магазин (c) 2017 г.Санкт-Петербург</p>
			</div>
			<div class="uk-width-1-4 uk-text-left f-right">
					<p class="green">Меню</p>
					<ul class="footer-menu">
					@if($top_menu)
					
                                            @foreach($top_menu->items as $item)
                                            <li><a href="{{$item->url}}">{{$item->text}}</a></li>
                                            @endforeach
					
                                         @endif
					</ul>
			</div>
			<div class="uk-width-1-4 uk-text-left f-right">
			<p class="green">Контактная информация</p>
				+7 (812) 123-45-78<br>info@windy.ru <br>Мы работаем для Вас:<br>
				ПН-ПТ: 08:00 - 18:00<br>СБ: 10:00 - 16:00
				
			</div>
		</div>
	</div>
</div>
  @yield('scripts')
  <script>
        $('#agreement').click(function(){
            return false;
        });
        function orderCall(){
          var fields = $('#mail-form').serialize(); 
            
          var name = $("#mail-form-name").val();
          var phone = $("#mail-form-phone").val();  
           console.log(name);
          if (name.length<2){
              $('#mail-form-danger').html("Поле Имя должно содержать не менее 2-х символов.");
              return false;
          }
            if (phone.length<10){
              $('#mail-form-danger').html("Поле Телефон должно содержать не менее 10 символов.");
              return false;
          }
          
       $.ajax({
            type: 'GET',
            url: '{{route("mail-call_order")}}',
            data: fields,
            beforeSend: function(){
                console.log('before');
               
            },
            success: function(data){
                  $('#mail-form-wrapper').html("Запрос отправлен. Менеджер скоро с вами свяжется!");
                
                
            },
            error: function(xhr,str){
                console.log('error');
            }
        });
        }
  </script>
</body>
</html>
 
 
 
