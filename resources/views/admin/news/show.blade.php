@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.news.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.news.fields.title')</th>
                            <td>{{ $news->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.news.fields.short')</th>
                            <td>{{ $news->short }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.news.fields.full-text')</th>
                            <td>{!! $news->full_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.news.fields.photos')</th>
                            <td> @foreach($news->getMedia('photos') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.news.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop