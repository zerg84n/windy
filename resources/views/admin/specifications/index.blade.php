@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.specification.title')</h3>
    @can('specification_create')
    <p>
        <a href="{{ route('admin.specifications.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($specifications) > 0 ? 'datatable' : '' }} @can('specification_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('specification_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.specification.fields.title')</th>
                          <th>Алиас</th>
                        <th>Тип характеристики</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($specifications) > 0)
                        @foreach ($specifications as $specification)
                            <tr data-entry-id="{{ $specification->id }}">
                                @can('specification_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $specification->title }}</td>
                                   <td>{{ $specification->alias or 'не назначен' }}</td>
                                <td>{{ $specification->getInputType() }}</td>
                                <td>
                                    @can('specification_view')
                                    <a href="{{ route('admin.specifications.show',[$specification->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('specification_edit')
                                    <a href="{{ route('admin.specifications.edit',[$specification->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('specification_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.specifications.destroy', $specification->id])) !!}
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
        @can('specification_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.specifications.mass_destroy') }}';
        @endcan

    </script>
@endsection