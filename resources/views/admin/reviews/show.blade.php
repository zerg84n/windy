@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.reviews.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.reviews.fields.name')</th>
                            <td>{{ $review->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.reviews.fields.email')</th>
                            <td>{{ $review->email }}</td>
                        </tr>
                          <tr>
                            <th>Товар</th>
                            <td><a href="{{route('products-show',$review->product)}}" target="_blank">{{ $review->product->title }}</a></td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.reviews.fields.score')</th>
                            <td>{{ $review->score }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.reviews.fields.text')</th>
                            <td>{!! $review->text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.reviews.fields.published')</th>
                            <td>{{ Form::checkbox("published", 1, $review->published == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.reviews.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop