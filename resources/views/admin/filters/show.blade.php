@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.filters.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.filters.fields.query')</th>
                            <td field-key='query'>{{ $filter->query }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.filters.fields.slug')</th>
                            <td field-key='slug'>{{ $filter->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.filters.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
