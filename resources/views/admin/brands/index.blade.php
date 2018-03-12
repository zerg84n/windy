@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.brands.title')</h3>
    @can('brand_create')
    <p>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($brands) > 0 ? 'datatable' : '' }} @can('brand_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('brand_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.brands.fields.title')</th>
                        <th>@lang('quickadmin.brands.fields.slug')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($brands) > 0)
                        @foreach ($brands as $brand)
                            <tr data-entry-id="{{ $brand->id }}">
                                @can('brand_delete')
                                    <td></td>
                                @endcan

                                <td field-key='title'>{{ $brand->title }}</td>
                                <td field-key='slug'>{{ $brand->slug }}</td>
                                                                <td>
                                    @can('brand_view')
                                    <a href="{{ route('admin.brands.show',[$brand->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('brand_edit')
                                    <a href="{{ route('admin.brands.edit',[$brand->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('brand_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.brands.destroy', $brand->id])) !!}
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
    <script>
        @can('brand_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.brands.mass_destroy') }}';
        @endcan

    </script>
@endsection