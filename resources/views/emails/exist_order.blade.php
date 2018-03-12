<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
            <h2>{{ $title }} артикул: {{$product->articul or '??.???'}}</h2>

            <div class="row">
                Имя: {{$name}}
                Телефон: {{$phone or '-'}}
                Email: {{$email or '-'}}
            </div>
             <div class="row">
                    <a href="{{route('admin.products.show',$product->id)}}"> Ссылка на товар в админке</a></br>
                     <a href="{{route('products-show',$product)}}"> Товар на сайте</a>
                </div>
	</body>
</html>
