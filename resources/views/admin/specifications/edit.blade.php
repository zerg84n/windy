@extends('layouts.app')

@section('content')
    <h3 class="page-title">Характеристики</h3>
    
    {!! Form::model($specification, ['method' => 'PUT', 'route' => ['admin.specifications.update', $specification->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Редактирование
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Название*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
           
           @if($specification->variants)
             <div id='variants-wrapper'>
            <div id='variants' class="row" >
                @foreach($specification->variants as $variant)
                  <div  class="col-xs-12 form-group field" >
                      <input name="old_variants[{{$variant->id}}]" type="text" value="{{$variant->value}}" />
                      <button class="remove-field" onclick=" return false;" >Удалить</button>
                  </div>
                @endforeach  
             </div>
               <div class="row"> 
                    <div class="col-xs-1">
                     <button class="btn btn-default" onclick="addField(); return false;">Добавить вариант</button>
                    </div>
                   
               </div>
            </div>
            
               
          
           @endif
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
@section('javascript')
    @parent
    
        <script>
          
            $('#value_type').change(function(){
                
                              
                if ($(this).val()=='select'){
                    $('#variants-wrapper').show();
                } else {
                     $('#variants-wrapper').hide();
                    
                }
            });
            
            $('.remove-field').click(function(){
               console.log('click');
                $(this).parent().remove();
                return false;
            });
                    
            
          
        function addField(){
            var num = $('.field').length;
            if ($('.field').length>5){ alert('Больше нельзя!'); return false;}
            
             // $('.field').first().clone(true).appendTo('#variants');
            
             // $('#variants').append(input);
             var html ='<div  class="col-xs-12 form-group field" >'+
                      '<input name="new_variants[]" type="text" />'+
                      '<button class="remove-field" onclick=" return false;" >Удалить</button>'+
            '</div>';
             $('#variants').append(html);
          }
             function removeField(){
                 if ($('.field').length>2){
                      $(this).parent().remove();
                 } else {
                     alert('Нужен хотябы один вариант.');
                 }
               
             }
       
        </script>
@stop


