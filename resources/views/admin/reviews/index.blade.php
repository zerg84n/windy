@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.reviews.title')</h3>
    @can('review_create')
    <p>
        <a href="{{ route('admin.reviews.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($reviews) > 0 ? 'datatable' : '' }} @can('review_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('review_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.reviews.fields.name')</th>
                        <th>Товар</th>
                        <th>@lang('quickadmin.reviews.fields.published')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($reviews) > 0)
                        @foreach ($reviews as $review)
                            <tr data-entry-id="{{ $review->id }}">
                                @can('review_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $review->name }}</td>
                                <td><a href="{{route('products-show',$review->product)}}" target="_blank">{{ $review->product->title }}</a></td>
                                <td>{{ Form::checkbox("published", 1, $review->published == 1 ? true : false, ["disabled"]) }}</td>
                                <td>
                                    @can('review_view')
                                    <a href="{{ route('admin.reviews.show',[$review->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('review_edit')
                                    <a href="{{ route('admin.reviews.edit',[$review->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('review_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.reviews.destroy', $review->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('review_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.reviews.mass_destroy') }}';
        @endcan

    </script>
@endsection