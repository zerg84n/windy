@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.order.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.order.fields.name')</th>
                            <td>{{ $order->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.email')</th>
                            <td>{{ $order->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.phone')</th>
                            <td>{{ $order->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.delivery')</th>
                            <td>{{ $order->delivery }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.address')</th>
                            <td>{{ $order->address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.time')</th>
                            <td>{{ $order->time }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.payment-type')</th>
                            <td>{{ $order->payment_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.is-ur')</th>
                            <td>{{ Form::checkbox("is_ur", 1, $order->is_ur == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.attachment')</th>
                            <td>@if($order->attachment)<a href="{{ asset('uploads/' . $order->attachment) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.ur-name')</th>
                            <td>{{ $order->ur_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.ur-inn')</th>
                            <td>{{ $order->ur_inn }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.ur-nls')</th>
                            <td>{{ $order->ur_nls }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.order.fields.status')</th>
                            <td>{{ $order->status }}</td>
                        </tr>
                      
                        
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID Товара</th>
                                <th>Наименование</th>
                                <th>Количество</th>
                                <th>Стоимость</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                             @foreach($order->products as $product)
                            <tr>
                                <td>
                                 {{$product->id}}
                                 </td>
                                 <td>
                                     <a href="{{route('products-show',$product)}}" target="_blank">{{$product->title}}</a>
                                 </td>
                                 <td>
                                 {{$product->pivot->count}}
                                 </td>
                                 <td>
                                 {{$product->pivot->count*$product->price_original}} р.
                                 @php
                                    $total += $product->pivot->count*$product->price_original;
                                @endphp
                                 </td>
                             </tr>
                            @endforeach
                        <td>
                            Итого:
                        </td>
                        <td colspan="3">
                            {{$total}} р.
                        </td>
                        </tbody>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.orders.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop