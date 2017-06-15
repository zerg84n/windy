@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.banners.title')</h3>
    @can('banners_create')
    <p>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($banners) > 0 ? 'datatable' : '' }} @can('banners_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('banners_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.banners.fields.title')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($banners) > 0)
                        @foreach ($banners as $banners)
                            <tr data-entry-id="{{ $banners->id }}">
                                @can('banners_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $banners->title }}</td>
                                <td>
                                    @can('banners_view')
                                    <a href="{{ route('admin.banners.show',[$banners->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('banners_edit')
                                    <a href="{{ route('admin.banners.edit',[$banners->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('banners_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.banners.destroy', $banners->id])) !!}
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
        @can('banners_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.banners.mass_destroy') }}';
        @endcan

    </script>
@endsection