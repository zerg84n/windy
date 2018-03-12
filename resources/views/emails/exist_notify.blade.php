<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
            <h2>{{ $text }} артикул: {{$product->articul or '??.???'}}</h2>

            <div class="row">
              {{$name}}, Ваш запрос принят в работу, менеджер свяжется с Вами после уточнения наличия товара "{{$product->title}}"
               
            </div>
             <div class="row">
                  
                     <a href="{{route('products-show',$product)}}"> Товар на сайте</a>
                </div>
	</body>
</html>
