@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.products.title')</h3>
    <div class="row">
        <div class="col-md-2">
            @can('product_create')
            <p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

            </p>
             @endcan
        </div>
        
        <div class="col-xs-6 form-group">
            
            {!! Form::select('Категории', $categories, old('categories'), ['class' => 'form-control select2','multiple' => 'multiple','id'=>'categories']) !!}
            <p class="help-block"></p>
            @if($errors->has('category_id'))
                <p class="help-block">
                    {{ $errors->first('category_id') }}
                </p>
            @endif
        </div>
       
        <div class="col-md-2">
              <button class="btn btn-success" id="export-yml">Экспорт</button>
        </div>
         <div id="export-link" class="col-md-2">
              
        </div>
         
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($products) > 0 ? 'datatable' : '' }} @can('product_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('product_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan
                        <th>ID</th>
                         <th>Артикул</th>
                        <th>@lang('quickadmin.products.fields.title')</th>
                        <th>@lang('quickadmin.products.fields.price-original')</th>
                        <th>@lang('quickadmin.products.fields.category')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <tr data-entry-id="{{ $product->id }}">
                                @can('product_delete')
                                    <td></td>
                                @endcan
                                <td>{{ $product->id }}</td>
                                 <td>{{ $product->articul or "??.???" }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->price_original }}</td>
                                <td>{{ $product->category->title or '' }}</td>
                                <td>
                                    @can('product_view')
                                    <a href="{{ route('admin.products.show',[$product->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('product_edit')
                                    <a href="{{ route('admin.products.edit',[$product->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('product_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.products.destroy', $product->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.product.copy',$product) }}" class="btn btn-xs btn-primary">Копировать</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="14">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('product_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.products.mass_destroy') }}';
            
        @endcan
         window.export_to_yml = '{{ route('admin.products.export') }}';
          
        function addfilter(id,number,table){
                            var column = table.api().column( number );
                            var select = $(id) 
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                  var id = $(this).attr('id');
                                  
                                   
                                       
                                   if (val == "null"){
                                                                         
                                        column
                                        .search( '^$', true, false )
                                        .draw();
                                   } else{                                      
                                   
                                        column
                                        .search(val?'^'+val+'$':'', true, false )
                                        .draw();
                                   }
                                     
                                  
                                    
                                
                                } );
                      
            }
         //   addfilter('#menus',4,window.datatable);
         $(document).ready(function () {
            
             //addfilter('#categories',5,window.datatable);
             
             $('#categories').change(function(item){
                
                 
                     types =$(this).val()
         if (types) {
                var regex = types.join('|');
            }else {regex=''}
               
                window.datatable.api().column(5)
                        .search(regex ? '^'+regex+'$' : '', true, false)
                        
                        .draw();
                 
             });
            
             $('#export-yml').click( function () {
                 var ids = [];
             $('.selected').each(function(index, item){
                 ids.push($(item).data('entry-id'));
             });
             console.log(ids);
            $('#export-link').html('Идет экспорт. Ожидайте...');
                 $.get(window.export_to_yml,{ ids: ids})
                                
                               .done(function( data ) {
                                $('#export-link').html('<a  href="'+data+'" target="_blank">Файл экспорта</a>');
                      });

         });
             
    });

    </script>
@endsection