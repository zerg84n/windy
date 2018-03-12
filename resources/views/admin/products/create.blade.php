@extends('layouts.app')


@section('content')
    <h3 class="page-title">Товары</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.products.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
           Добавление товара
        </div>
        
        <div class="panel-body">
             <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('category_id', 'Категория*', ['class' => 'control-label']) !!}
                    {!! Form::select('category_id', $categories, old('category_id'), ['id'=>'category-select', 'class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_id'))
                        <p class="help-block">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif
                </div>
                  <div class="col-xs-6 form-group">
                    {!! Form::label('brand_id', 'Производитель*', ['class' => 'control-label']) !!}
                    {!! Form::select('brand_id', $brands, old('brand_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('brand_id'))
                        <p class="help-block">
                            {{ $errors->first('brand_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-8 form-group">
                    {!! Form::label('title', 'Наименование*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '','required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                 <div class="col-xs-4 form-group">
                    {!! Form::label('articul', 'Артикул*(Заполняется автоматически)', ['class' => 'control-label']) !!}
                  
                    {!! Form::text('articul', old('articul'), ['id'=>'articul_code', 'class' => 'form-control', 'placeholder' => 'XX.XXX','required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('articul'))
                        <p class="help-block">
                            {{ $errors->first('articul') }}
                        </p>
                    @endif
                </div>
            </div>
           
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', 'Описание', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('price_original', 'Цена*', ['class' => 'control-label']) !!}
                    {!! Form::text('price_original', old('price_original'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('price_original'))
                        <p class="help-block">
                            {{ $errors->first('price_original') }}
                        </p>
                    @endif
                </div>
                  <div class="col-xs-4 form-group">
                    {!! Form::label('price_sale', 'Цена по акции', ['class' => 'control-label']) !!}
                    {!! Form::text('price_sale', old('price_sale'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('price_sale'))
                        <p class="help-block">
                            {{ $errors->first('price_sale') }}
                        </p>
                    @endif
                </div>
                 <div class="col-xs-4 form-group">
                    {!! Form::label('amount', 'Количество', ['class' => 'control-label']) !!}
                    {!! Form::number('amount', old('amount'), ['class' => 'form-control', 'placeholder' => 'Количество товара на складе','value'=>'1']) !!}
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
                    {!! Form::checkbox('popular', 1, false, []) !!}
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
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('photos'))
                        <p class="help-block">
                            {{ $errors->first('photos') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="panel-heading"> 
                <h2>Характеристики:</h2></div>
            <div id='properties-wrapper'>
                   @include('admin.products.partials.properties')
            </div>
            
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
    </div>

    {!! Form::submit('Сохранить', ['class' => 'btn btn-danger']) !!}
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

    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
     <script src="/js/masked_input.js"></script>
    <script>
       window.category_codes = $.parseJSON('{!!$categories_codes_json or ''!!}');
        window.category_size = $.parseJSON('{!!$categories_size_json or ''!!}');
        window.route_get_properties = "{{route('admin.products.properties')}}";
        $(function () {
            $("#articul").mask("99.999",{placeholder:"__.___"});
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
            $('#category-select').on('change',function(){
                 id = $(this).val();
                
                  $.get(window.route_get_properties,{ category_id: id})
                               .done(function( data ) {
                      
                        $('#properties-wrapper').html(data);
                          category_code = window.category_codes[id];
                          product_code = window.category_size[id];
                          $('#articul_code').val(category_code+'.'+product_code);
                        
                       
                      });
               
            });
        });
        
    </script>
@stop