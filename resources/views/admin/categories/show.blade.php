@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.category.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.category.fields.title')</th>
                            <td>{{ $category->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.category.fields.description')</th>
                            <td>{{ $category->description }}</td>
                        </tr>
                        <tr>
                            <th>Характеристики</th>
                            <td>
                                @foreach($category->properties as $property)
                                <p>{{$property->title}}</p>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->


            <p>&nbsp;</p>

            <a href="{{ route('admin.categories.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop