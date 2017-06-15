@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.item.title')</h3>
    @can('item_create')
    <p>
        <a href="{{ route('admin.items.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan
   <div class="row">
                 <div class="col-xs-8">
                 </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('menus', 'Меню', ['class' => 'control-label']) !!}
                    {!! Form::select('Меню', $menus, old('menus'), ['class' => 'form-control select2','id'=>'menus']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_id'))
                        <p class="help-block">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif
                </div>
            </div> 
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>
          
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($items) > 0 ? 'datatable' : '' }} @can('item_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('item_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.item.fields.title')</th>
                        <th>На сайте</th>
                        <th>@lang('quickadmin.item.fields.url')</th>
                          <th>Входит в меню</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($items) > 0)
                        @foreach ($items as $item)
                            <tr data-entry-id="{{ $item->id }}">
                                @can('item_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $item->title }}</td>
                                <td>{{ $item->text or $item->title }}</td>
                                <td>{{ $item->url }}</td>
                                     <td>{{$item->getFirstMenu()->title or 'не входит в меню'}}</td>
                                <td>                                    @can('item_edit')
                                    <a href="{{ route('admin.items.edit',[$item->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('item_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.items.destroy', $item->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
@parent
    <script>
        @can('item_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.items.mass_destroy') }}';
        @endcan
        
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
            
             addfilter('#menus',4,window.datatable);
         });
         
    </script>
@endsection