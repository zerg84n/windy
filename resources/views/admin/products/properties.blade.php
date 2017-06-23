@extends('layouts.app')

@section('content')
    <h3 class="page-title">Товары. {{$product->category->title}}</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.products.properties.store',$product]]) !!}
     <div class="panel panel-default">
        <div class="panel-heading">
           Добавление товара(Характеристики) {{$product->title}}
        </div>
         @foreach($product->values() as $property_value)
         <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('property['.$property_value->property->id.']', $property_value->property->title, ['class' => 'control-label']) !!}
            @if($property_value->getType()=='number')
                 {!! Form::number('property['.$property_value->property->id.']', $property_value->value, ['class' => 'form-control', 'placeholder' => '']) !!}   
            @elseif($property_value->getType()=='text')
                {!! Form::text('property['.$property_value->property->id.']', $property_value->value, ['class' => 'form-control', 'placeholder' => '']) !!}
            @elseif($property_value->getType()=='select')
                @php
                    $categories = collect();
                @endphp
                {!! Form::select('property['.$property_value->property->id.']', $property_value->property->variants->pluck('value','id')->prepend('Выберите характеристику', ''), '', ['class' => 'form-control select2']) !!}
            @elseif($property_value->getType()=='checkbox')
                {!! Form::hidden('property['.$property_value->property->id.']', 0) !!}
                 {!! Form::checkbox('property['.$property_value->property->id.']', 1, $property_value->value, []) !!}
            @endif
               </div>
             
        </div>
         
        @endforeach
           <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('products', 'Сопутствующие товары', ['class' => 'control-label']) !!}
                    {!! Form::select('products[]', $products, old('products'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('products'))
                        <p class="help-block">
                            {{ $errors->first('products') }}
                        </p>
                    @endif
                </div>
            </div>
     </div>   
      {!! Form::submit('Сохранить', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
   

  
@stop