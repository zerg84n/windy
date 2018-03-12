<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta name="yandex-verification" content="bd794b17ea25fba5" />
                
               <title>{{$ceo_title or 'windytech'}}</title>
               <meta name="description" content="{{$ceo_description or 'windytech'}}">
		<link rel="stylesheet" type="text/css" href="/css/uikit.min.css" />
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
		<link rel="stylesheet" type="text/css" href="/css/menu-pic.css" />
		<link rel="stylesheet" type="text/css" href="/css/menu.css" />
		
                
                @yield('styles')
                
                
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <!--     <script src="/js/menu.js"></script>-->
		<script src="/js/uikit.min.js"></script>
		<script src="/js/uikit.js"></script>
		
		
		
</head>
<body>
<div class="head-min">
	<div class="uk-container head-middle">
		<div class="uk-grid">	
				<div class="uk-width-2-5 logo">
                                    <a href="{{route('products-index')}}"><img src="/img/logo.png"></a>
				</div>
				<div class="uk-width-3-5 uk-text-right">

                                    
					<div class="uk-grid">
						
						<div class="green uk-width-1-3 phone"><img src="/img/phone.png"> 8 (800) 200-63-71<br><span>Звонок по России бесплатный!</span></div>
						<div class="green uk-width-1-3 mail"><img src="/img/mail.png"> 
						<a href="mailto:info@windytech.ru">info@windytech.ru</a></div>
                                                <div class="green uk-width-1-3"><a id='cart_title' class="{{count(Session::get('cart'))?'cart_not_empty':''}}" href="{{route('products-cart-index')}}"><img src="/img/cart.png"> Корзина (<span class="cart_counters" id="cart_count">{{count(Session::get('cart'))}}</span>)</a></div>
					</div>
				</div>
        <ul class="top-menu">
                                             @foreach($main_menu->items as $root_item)
                                          <li class="menu{{$root_item->id}}"><a class="a-drop-down" href="{{$root_item->url}}">{{$root_item->text or $root_item->title}}</a>
					@endforeach
					</ul>        

		</div>
	</div>
</div>
<div id="page-wrapper">
		<!-- This is the modal -->
			<div id="modal-form" uk-modal>
				<div id="mail-form-wrapper" class="uk-modal-dialog uk-modal-body">
					<p class="title">Заказать звонок</p>
					<p class="uk-text-right">
						<form id="mail-form" class="call">
                                                    <p><input id="mail-form-name" type="text" name="name" placeholder="Ваше имя" class="uk-input uk-form-width-medium uk-form-small" ></p>                                                       
							   <p><input id="mail-form-phone"  type="phone" name="phone" placeholder="Ваш телефон" class="uk-input uk-form-width-medium uk-form-small" required></p>
                                                           <p><input  id="agreement" class="uk-checkbox" type="checkbox" name="aggrement" value="1" checked readonly> <a href="/docs/politic.docx">Даю согласие на обработку персональных данных</a></p>
                                                           <p id="mail-form-danger" class="uk-form-danger"></p>
                                                           <p><a href="javascript:orderCall()" class="uk-button uk-button-default uk-button-small">Отправить</a></p>
						</form>
					</p>
				</div>
			</div>
                    <div id="exist-modal-form" uk-modal>
				<div id="exist-form-wrapper" class="uk-modal-dialog uk-modal-body">
                                    <p class="title">Прошу уточнить наличие товара «<span id="product-title"></span>» и проинформировать меня. </p>
					<p class="uk-text-right">
						<form id="exist-form" class="call">
                                                    <input id="exist-form-product" name="product_id" type="hidden">
                                                    <p><input id="exist-form-name" type="text" name="name" placeholder="Ваше имя" class="uk-input uk-form-width-medium uk-form-small" required></p>
							   <p><input id="exist-form-phone"  type="phone" name="phone" placeholder="Ваш телефон" class="uk-input uk-form-width-medium uk-form-small" required></p>
                                                            <p><input id="exist-form-email"  type="email" name="email" placeholder="Email" class="uk-input uk-form-width-medium uk-form-small" ></p>
                                                           <p><input  id="exist-agreement" class="uk-checkbox" type="checkbox" name="aggrement" value="1" checked readonly> <a href="/docs/politic.docx">Даю согласие на обработку персональных данных</a></p>
                                                           <p id="exist-form-danger" class="uk-form-danger"></p>
                                                           <p><a href="javascript:existCall()" class="uk-button uk-button-default uk-button-small">Отправить</a></p>
						</form>
					</p>
				</div>
			</div>
		<div class="head-top">
		<div class="uk-container">
			<div class="uk-grid">
				<div class="uk-width-4-5 call">
				<div class="nav__menu">
					@if($top_menu)
					<ul class="top-menu">
                                            @foreach($top_menu->items as $item)
                                            <li><a href="{{$item->url}}">{{$item->text}}</a></li>
                                            @endforeach
					</ul>
					@endif
				</div></div>
				<div class="uk-width-1-5 cart uk-text-right">
                                    <a id='cart_title' class="{{count(Session::get('cart'))?'cart_not_empty':''}}" href="{{route('products-cart-index')}}"><img src="/img/cart.png"> Корзина (<span class="cart_counters" id="cart_count">{{count(Session::get('cart'))}}</span>)</a>
				</div>
                                 
				<!--<div class="uk-width-1-4 uk-text-right links">
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
				</div>-->
					</div>
		</div>
		</div>
		<div class="uk-container head-middle">
			<div class="uk-grid">	
				<div class="uk-width-2-5 logo">
                                    <a href="{{route('products-index')}}"><img src="/img/logo.png"></a>
									<p>Оборудование для бизнес-центров, гостиниц, ресторанов</p>
				</div>
				<div class="uk-width-3-5 uk-text-right">
					<div class="uk-grid">
						<div class="green uk-width-2-3 phone"><img src="/img/phone.png"> 8 (800) 200-63-71 - <span>Звонок по России бесплатный! </span><br>
						<img src="/img/phone.png"> +7 (812) 667-86-97 +7 (812) 926-53-82 
						<div class="mail__block"><img src="/img/mail.png"><a href="mailto:info@windytech.ru">info@windytech.ru</a></div></div>
						<div class="uk-width-1-3">
                                                    <form action="{{route('products-search')}}" method="GET" class="search">
                                                        <input id='search' type="search" name="keyword" value="{{$keyword or ''}}" class="uk-width-4-5">
							   <input type="submit" value="" class="uk-width-1-5"/>
							 </form>
							 <a href="#modal-form" uk-toggle>Заказать звонок <img src="/img/call.png"></a>
						</div>
					</div>
				</div>
			</div>
		</div>	

				<nav id="nav" class="uk-container">
					<ul class="main-ul">
                                          @foreach($main_menu->items as $root_item)
                                          <li class="menu{{$root_item->id}}"><a class="a-drop-down" href="{{$root_item->url}}">{{$root_item->text or $root_item->title}}</a>
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
				<!--<div><p>Посоветовать другу:</p>
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
			
                                </div>-->
				<div>
				<p>Способы оплаты:</p>
				<br><img src="/img/pay.png" class="uk-text-bottom"></div>
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
				<p>8 (800) 200-63-71 - звонок по России бесплатный!</p>
		<p>+7 (812) 667-86-97</p>
		<p>+7 (812) 926-53-82</p>
		<p>info@windytech.ru</p>
				<p>Мы работаем для Вас:<br>
			ПН-ПТ: с 10:00 до 18:00</p>
			</div>
		</div>
	</div>
</div>
  @yield('scripts')
 
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter45374520 = new Ya.Metrika({ id:45374520, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/45374520" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<script async>	
jQuery(document).scroll(function(){
	if(jQuery(document).scrollTop()>180){
		jQuery('.head-min').slideDown("fast");
	}
	else {
		jQuery('.head-min').slideUp("fast");
	}
});
</script>
 <script>
  
$('.filter .uk-checkbox').click(function(){ 
$(".f-btn").css("display:none"); 
offset = $(this).offset(); 
$(".f-btn").offset({ top:offset.top - 10, left:offset.left + 125 }); 
$(".f-btn").show("slow"); 

});
		
  </script>
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
         function existCall(){
          var fields = $('#exist-form').serialize(); 
            
          var name = $("#exist-form-name").val();
          var phone = $("#exist-form-phone").val(); 
          var email = $("#exist-form-email").val();  
           
          if (name.length<2){
              $('#exist-form-danger').html("Поле Имя должно содержать не менее 2-х символов.");
              return false;
          }
            if (phone.length>0 && phone.length<10){
              $('#exist-form-danger').html("Поле Телефон должно содержать не менее 10 символов.");
              return false;
          }
          
          if(!email && !phone){
               $('#exist-form-danger').html("Нужно заполнить хотя бы одно из полей: Email или Телефон!");
              return false;
          }
          
          if(email.length>0 && !isEmail(email)){
              $('#exist-form-danger').html("Неверный формат Email");
              return false;
          }
          
       $.ajax({
            type: 'GET',
            url: '{{route("mail-exist_order")}}',
            data: fields,
            beforeSend: function(){
                 $('#exist-form-danger').html("Отправка...");
               
            },
            success: function(data){
                  
                  $('#exist-form-danger').html("Запрос отправлен. Менеджер скоро с вами свяжется!");
                  id =  $('#exist-form-product').val();
                   $('#cart'+id+' input').first().val('Запрос отправлен');
                   
                    alert("Запрос отправлен. Менеджер скоро с вами свяжется!");
            },
            error: function(xhr,str){
                console.log('error');
            }
        });
        return false;
        }
        function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
      }
  </script>
</body>
</html>
 
 
 
