@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.products.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.products.fields.description')</th>
                            <td>{!! $product->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.price-original')</th>
                            <td>{{ $product->price_original }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.price-sale')</th>
                            <td>{{ $product->price_sale }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.category')</th>
                            <td>{{ $product->category->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.amount')</th>
                            <td>{{ $product->amount }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.products.fields.photos')</th>
                            <td> @foreach($product->getMedia('photos') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>Характеристики</th>
                            <td>
                                @foreach ($product->values() as $value)
                                    <span class="label label-info label-many">{{ $value->property->title }} : {{$value->value}}</span>
                                @endforeach
                            </td>
                        </tr>
                          <tr>
                            <th>Сопутствующие товары</th>
                            <td>
                                @foreach ($product->products as $child_product)
                                <span class="label label-info label-many"><a href="{{route('products-show',$child_product)}}" target="_blank">{{ $child_product->title }} </a></span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.products.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop