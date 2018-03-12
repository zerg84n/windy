@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.filters.title')</h3>
    @can('filter_create')
    <p>
        <a href="{{ route('admin.filters.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($filters) > 0 ? 'datatable' : '' }} @can('filter_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('filter_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.filters.fields.query')</th>
                        <th>@lang('quickadmin.filters.fields.slug')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($filters) > 0)
                        @foreach ($filters as $filter)
                            <tr data-entry-id="{{ $filter->id }}">
                                @can('filter_delete')
                                    <td></td>
                                @endcan

                                <td field-key='query'>{{ $filter->query }}</td>
                                <td field-key='slug'>{{ $filter->slug }}</td>
                                                                <td>
                                    @can('filter_view')
                                    <a href="{{ route('admin.filters.show',[$filter->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('filter_edit')
                                    <a href="{{ route('admin.filters.edit',[$filter->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('filter_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.filters.destroy', $filter->id])) !!}
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
        @can('filter_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.filters.mass_destroy') }}';
        @endcan

    </script>
@endsection