@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.menu.title')</h3>
    @can('menu_create')
    <p>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($menus) > 0 ? 'datatable' : '' }} @can('menu_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('menu_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.menu.fields.title')</th>
                         <th>На сайте</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($menus) > 0)
                        @foreach ($menus as $menu)
                            <tr data-entry-id="{{ $menu->id }}">
                                @can('menu_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $menu->title }}</td>
                                  <td>{{ $menu->text or $menu->title  }}</td>
                                <td>                                    @can('menu_edit')
                                    <a href="{{ route('admin.menus.edit',[$menu->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('menu_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.menus.destroy', $menu->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('menu_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.menus.mass_destroy') }}';
        @endcan

    </script>
@endsection