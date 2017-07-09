@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.specification.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.specification.fields.title')</th>
                            <td>{{ $specification->title }}</td>
                        </tr>
                        <tr>
                            <th>Алиас</th>
                            <td>{{ $specification->alias }}</td>
                        </tr>
                        <tr>
                            <th>Тип</th>
                            <td>{{ $specification->getInputType() }}</td>
                        </tr>
                        <tr>
                            <th>Возможные значения</th>
                            <td>
                                @foreach ($specification->getRange()  as $value)
                                <p>{{$value->value}}</p>
                               @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->



            <p>&nbsp;</p>

            <a href="{{ route('admin.specifications.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop