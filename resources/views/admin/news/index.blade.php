@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.news.title')</h3>
    @can('news_create')
    <p>
        <a href="{{ route('admin.news.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($news) > 0 ? 'datatable' : '' }} @can('news_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('news_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.news.fields.title')</th>
                         <th>URL</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($news) > 0)
                        @foreach ($news as $news)
                            <tr data-entry-id="{{ $news->id }}">
                                @can('news_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $news->title }}</td>
                                <td><a href="{{ route('news-show',$news) }}" target="_blank">{{ route('news-show',$news) }}</a></td>
                                <td>
                                    @can('news_view')
                                    <a href="{{ route('admin.news.show',[$news->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('news_edit')
                                    <a href="{{ route('admin.news.edit',[$news->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('news_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.news.destroy', $news->id])) !!}
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
        @can('news_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.news.mass_destroy') }}';
        @endcan

    </script>
@endsection