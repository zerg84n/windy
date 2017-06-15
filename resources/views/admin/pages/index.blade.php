@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pages.title')</h3>
    @can('page_create')
    <p>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($pages) > 0 ? 'datatable' : '' }} @can('page_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('page_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.pages.fields.title')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($pages) > 0)
                        @foreach ($pages as $page)
                            <tr data-entry-id="{{ $page->id }}">
                                @can('page_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $page->title }}</td>
                                <td>
                                    @can('page_view')
                                    <a href="{{ route('admin.pages.show',[$page->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('page_edit')
                                    <a href="{{ route('admin.pages.edit',[$page->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('page_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.pages.destroy', $page->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('page_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.pages.mass_destroy') }}';
        @endcan

    </script>
@endsection