@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.category.title')</h3>
    
    {!! Form::model($category, ['method' => 'PUT', 'route' => ['admin.categories.update', $category->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('title', 'Название*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            
                <div class="col-xs-4 form-group">
                    {!! Form::label('slug', 'Алиас*', ['class' => 'control-label']) !!}
                    {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'placeholder' => 'Для формирования Url', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('slug'))
                        <p class="help-block">
                            {{ $errors->first('slug') }}
                        </p>
                    @endif
                </div>
                   <div class="col-xs-2 form-group">
                    {!! Form::label('articul_code', 'Код Артикула', ['class' => 'control-label']) !!}
                    {!! Form::number('articul_code', old('articul_code'), ['class' => 'form-control', 'placeholder' => '2 знака', 'max'=>'99']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('articul_code'))
                        <p class="help-block">
                            {{ $errors->first('articul_code') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Описание', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            
              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('properties', 'Характеристики', ['class' => 'control-label']) !!}
                    {!! Form::select('properties[]', $properties, old('properties') ? old('properties') : $category->properties->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('properties'))
                        <p class="help-block">
                            {{ $errors->first('properties') }}
                        </p>
                    @endif
                </div>
            </div>
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('menu_id', 'Меню', ['class' => 'control-label']) !!}
                    {!! Form::select('menu_id', $menus, old('menu_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('menu_id'))
                        <p class="help-block">
                            {{ $errors->first('menu_id') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

