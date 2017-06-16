<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" type="text/css" href="/css/uikit.min.css" />
		<link rel="stylesheet" type="text/css" href="/css/main.css" />
		<link rel="stylesheet" type="text/css" href="/css/menu.css" />
                
                @yield('styles')
                
                
		<script src="http://code.jquery.com/jquery-3.2.1.min.js"  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
		<script src="/js/menu.js"></script>
		<script src="/js/ini.js"></script>
		<script src="/js/uikit.min.js"></script>
		<script src="/js/uikit.js"></script>
		
		
		
</head>
<body>

﻿<!-- Шапка-->
<div id="page-wrapper">
		<!-- This is the modal -->
			<div id="modal-form" uk-modal>
				<div class="uk-modal-dialog uk-modal-body">
					<p class="title">Заказать звонок</p>
					<p class="uk-text-right">
						<form class="call">
								<p><input type="text" name="text" placeholder="Ваше имя" class="uk-input uk-form-width-medium uk-form-small"></p>
							   <p><input type="text" name="text" placeholder="Ваш телефон" class="uk-input uk-form-width-medium uk-form-small"></p>
							   <p><input class="uk-checkbox" type="checkbox" name="option1" value="a1" checked> Даю согласие на обработку персональных данных</p>
							   <p><input class="uk-button uk-button-default uk-button-small" type="submit" value="Отправить"></p>
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
					<a href="#"><img src="/img/cart.png"> Корзина (0)</a>
				</div>
				<div class="uk-width-1-4 uk-text-right links">
					<a href="#"><img src="/img/fb.png"></a>
					<a href="#"><img src="/img/vk.png"></a>
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
							<form class="search">
							   <input type="search" name="q" class="uk-width-4-5">
							   <input type="submit" value="" class="uk-width-1-5">
							 </form>
						</div>
					</div>
				</div>
			</div>
		</div>	

				<nav id="nav" class="uk-container">
					<ul class="main-ul">
                                          @foreach($main_menu->items as $root_item)
						<li><a class="a-drop-down" href="#">{{$root_item->text or $root_item->title}}</a>
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
				<a href="#"><img src="/img/fb.png"></a>
				<a href="#"><img src="/img/vk.png"></a></div>
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
				+7 (812) 123-45-78<br>info@wendy.ru <br>Мы работаем для Вас:<br>
				ПН-ПТ: 08:00 - 18:00<br>СБ: 10:00 - 16:00
				
			</div>
		</div>
	</div>
</div>
  @yield('scripts')
</body>
</html>
 
 
 