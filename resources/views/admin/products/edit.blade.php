@extends('layouts.app')

@section('content')
    <h3 class="page-title">Товары</h3>
    
    {!! Form::model($product, ['method' => 'PUT', 'route' => ['admin.products.update', $product->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Редактирование
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Наименование', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::label('price_original', 'Цена*', ['class' => 'control-label']) !!}
                    {!! Form::text('price_original', old('price_original'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('price_original'))
                        <p class="help-block">
                            {{ $errors->first('price_original') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('price_sale', 'Цена по акции', ['class' => 'control-label']) !!}
                    {!! Form::text('price_sale', old('price_sale'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('price_sale'))
                        <p class="help-block">
                            {{ $errors->first('price_sale') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('category_id', 'Категория*', ['class' => 'control-label']) !!}
                    {!! Form::select('category_id', $categories, old('category_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_id'))
                        <p class="help-block">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('amount', 'Количество', ['class' => 'control-label']) !!}
                    {!! Form::number('amount', old('amount'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('popular', 'Популярный', ['class' => 'control-label']) !!}
                    {!! Form::hidden('popular', 0) !!}
                    {!! Form::checkbox('popular', 1, old('popular'), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('popular'))
                        <p class="help-block">
                            {{ $errors->first('popular') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('photos', 'Фотографии*', ['class' => 'control-label']) !!}
                    {!! Form::file('photos[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'photos',
                        'data-filekey' => 'photos',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list">
                            @foreach($product->getMedia('photos') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                    <a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>
                                    <input type="hidden" name="photos_id[]" value="{{ $media->id }}">
                                </p>
                            @endforeach
                        </div>
                    </div>
                    @if($errors->has('photos'))
                        <p class="help-block">
                            {{ $errors->first('photos') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="panel-heading">
            Характеристики:
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
                {!! Form::select('property['.$property_value->property->id.']', $property_value->property->variants->pluck('value','id')->prepend('Выберите характеристику', ''),$property_value->getAttributes()['value'], ['class' => 'form-control select2']) !!}
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
                    {!! Form::select('products[]', $products, old('products') ? old('products') : $product->products->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('products'))
                        <p class="help-block">
                            {{ $errors->first('products') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Product',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'
                    },
                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' KB)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                            'width',
                            '0%'
                        );
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                        'width',
                        progress + '%'
                    );
                });
            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>
@stop