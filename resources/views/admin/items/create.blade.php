@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.item.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.items.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Полное название*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('text', 'Название на сайт*', ['class' => 'control-label']) !!}
                    {!! Form::text('text', old('text'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('text'))
                        <p class="help-block">
                            {{ $errors->first('text') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('url', 'Url', ['class' => 'control-label']) !!}
                    {!! Form::text('url', old('url'), ['class' => 'form-control', 'placeholder' => '/catalog?category=2&power[min]=1000&power[max]=5000']) !!}
                    <small>Посмотреть алиасы характеристик можно в раделе характеристики</small>
                    <p class="help-block"></p>
                    @if($errors->has('url'))
                        <p class="help-block">
                            {{ $errors->first('url') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('menus', 'Подменю', ['class' => 'control-label']) !!}
                    {!! Form::select('menus[]', $menuses, old('menus'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('menus'))
                        <p class="help-block">
                            {{ $errors->first('menus') }}
                        </p>
                    @endif
                </div>
            </div>
              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('parents', 'Родительcкое меню', ['class' => 'control-label']) !!}
                    {!! Form::select('parents', $menuses, old('parents'), ['class' => 'form-control select2', 'placeholder'=>'В какое меню войдет пункт']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('parents'))
                        <p class="help-block">
                            {{ $errors->first('parents') }}
                        </p>
                    @endif
                </div>
            </div>
            <p><h2>CEO раздел</h2></p>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ceo_title', 'Title', ['class' => 'control-label']) !!}
                    {!! Form::text('ceo_title', old('ceo_title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                  
                    <p class="help-block"></p>
                    @if($errors->has('ceo_title'))
                        <p class="help-block">
                            {{ $errors->first('ceo_title') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ceo_description', 'Description', ['class' => 'control-label']) !!}
                    {!! Form::text('ceo_description', old('ceo_description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    
                    <p class="help-block"></p>
                    @if($errors->has('ceo_description'))
                        <p class="help-block">
                            {{ $errors->first('ceo_description') }}
                        </p>
                    @endif
                </div>
            </div>
              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ceo_head_text', 'Верхний текст', ['class' => 'control-label']) !!}
                    {!! Form::textarea('ceo_head_text', old('ceo_head_text'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ceo_head_text'))
                        <p class="help-block">
                            {{ $errors->first('ceo_head_text') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ceo_foot_text', 'Нижний текст', ['class' => 'control-label']) !!}
                    {!! Form::textarea('ceo_foot_text', old('ceo_foot_text'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ceo_foot_text'))
                        <p class="help-block">
                            {{ $errors->first('ceo_foot_text') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop
@section('javascript')
    @parent
	<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
           
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>
   @stop
