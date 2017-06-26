@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.specification.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.specifications.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
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
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('alias', 'Алиас*', ['class' => 'control-label']) !!}
                    {!! Form::text('alias', old('alias'), ['class' => 'form-control', 'placeholder' => 'только латинские буквы, подчеркивание и тире', 'required' => '']) !!}
                    <small>Алиас -короткое обозначение латинскими буквами для url. Должно быть уникальным для каждой характеристики.</small>
                    <p class="help-block"></p>
                    @if($errors->has('alias'))
                        <p class="help-block">
                            {{ $errors->first('alias') }}
                        </p>
                    @endif
                </div>
            </div>
      
          <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('value_type', 'Тип характеристики', ['class' => 'control-label']) !!}
                    {!! Form::select('value_type', $value_types, old('value_type'), ['id'=>'value_type' ,'class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('value_type'))
                        <p class="help-block">
                            {{ $errors->first('value_type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div id='variants-wrapper'>
            <div id='variants' class="row" >
                  <div  class="col-xs-12 form-group field" >
                      <input name="variants[]" type="text" />
                      <button class="remove-field" onclick=" return false;" >Удалить</button>
                  </div>
                  
             </div>
               <div class="row"> 
                    <div class="col-xs-1">
                     <button class="btn btn-default" onclick="addField(); return false;">Добавить вариант</button>
                    </div>
                   
               </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
@section('javascript')
    @parent
    
        <script>
             $('#variants-wrapper').hide();
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
            
              $('.field').first().clone(true).appendTo('#variants');
            
             // $('#variants').append(input);
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

