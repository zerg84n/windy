@extends('layouts.front')

@section('content')

    <div class="row">
         Главная страница
        <a href="{{route('auth.login')}}">Админка</a>
        {{var_dump(Session::all())}}
        <br>
        @if(Session::has('basket.product1'))
        checked
        @endif
        <input  type="checkbox" class="compare" data-id="1"           />Продукт1<br>
        <input type="checkbox" class="compare" data-id="2"  />Продукт2<br>
        <input type="checkbox" class="compare" data-id="3"   />Продукт3<br>
        <input type="checkbox" class="compare" data-id="4" />Продукт4<br>
    </div>
@endsection

@section('javascript') 
    <script>
         window.route_add_to_compare = '{{ route('products-compare-add') }}';
         window.route_del_from_compare = '{{ route('products-compare-del') }}';
      $('.compare').change( function() {
                var $this = $(this);
                if(this.checked) {
                       $.get(window.route_add_to_compare,{ id: $this.data('id')})
                               .done(function( data ) {
                        alert( "Add to basket " + data );
                      });
                    }else{
                        $.get(window.route_del_from_compare,{ id: $this.data('id')})
                               .done(function( data ) {
                        alert( "Remove from basket" + data );
                      });
                    }
               
            });
    </script>
@endsection