@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.specification.title')</h3>
    
    {!! Form::model($specification, ['method' => 'PUT', 'route' => ['admin.specifications.update', $specification->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
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
                    {!! Form::label('value_text', 'Текстовое значение', ['class' => 'control-label']) !!}
                    {!! Form::text('value_text', old('value_text'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('value_text'))
                        <p class="help-block">
                            {{ $errors->first('value_text') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('value_number', 'Числовое значение', ['class' => 'control-label']) !!}
                    {!! Form::number('value_number', old('value_number'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('value_number'))
                        <p class="help-block">
                            {{ $errors->first('value_number') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

