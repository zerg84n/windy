@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.pages.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.pages.fields.title')</th>
                            <td>{{ $page->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.alias.fields.short')</th>
                            <td>{{ $page->alias }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pages.fields.full-text')</th>
                            <td>{!! $page->full_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.pages.fields.photos')</th>
                            <td> @foreach($page->getMedia('photos') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.pages.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop