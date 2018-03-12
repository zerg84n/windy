@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.order.title')</h3>
    
    {!! Form::model($order, ['method' => 'PUT', 'route' => ['admin.orders.update', $order->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Контактное лицо*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone', 'Телефон*', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('delivery', 'Доставка', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('delivery'))
                        <p class="help-block">
                            {{ $errors->first('delivery') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('delivery', '0', false, []) !!}
                            Самовывоз
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('delivery', '1', false, []) !!}
                            Доставка по СПб
                        </label>
                    </div>
                      <div>
                        <label>
                            {!! Form::radio('delivery', '2', false, []) !!}
                            Доставка по России
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('address', 'Адрес', ['class' => 'control-label']) !!}
                    {!! Form::text('address', old('address'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('address'))
                        <p class="help-block">
                            {{ $errors->first('address') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('time', 'Удобное время', ['class' => 'control-label']) !!}
                    {!! Form::time('time',old('time'),['class'=>'form-control'])!!}
                    
                    <p class="help-block"></p>
                    @if($errors->has('time'))
                        <p class="help-block">
                            {{ $errors->first('time') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('payment_type', 'Способ оплаты', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('payment_type'))
                        <p class="help-block">
                            {{ $errors->first('payment_type') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('payment_type', 'Картой', $order->payment_type=='Картой', []) !!}
                            По карте
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('payment_type', 'Наличными курьеру', $order->payment_type=='Наличными курьеру', []) !!}
                            Наличными курьеру
                        </label>
                    </div>
                      <div>
                        <label>
                            {!! Form::radio('payment_type', 'По счету', $order->payment_type=='По счету', []) !!}
                            По счету
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('is_ur', 'Юридическое лицо', ['class' => 'control-label']) !!}
                    {!! Form::hidden('is_ur', 0) !!}
                    {!! Form::checkbox('is_ur', 1, old('is_ur'), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('is_ur'))
                        <p class="help-block">
                            {{ $errors->first('is_ur') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('attachment', 'Реквизиты в файле', ['class' => 'control-label']) !!}
                    @if ($order->attachment)
                        <a href="{{ asset('uploads/' . $order->attachment) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('attachment', ['class' => 'form-control']) !!}
                    {!! Form::hidden('attachment_max_size', 8) !!}
                    <p class="help-block"></p>
                    @if($errors->has('attachment'))
                        <p class="help-block">
                            {{ $errors->first('attachment') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ur_name', 'Реквизиты', ['class' => 'control-label']) !!}
                    {!! Form::textarea('ur_name', old('ur_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ur_name'))
                        <p class="help-block">
                            {{ $errors->first('ur_name') }}
                        </p>
                    @endif
                </div>
            </div>
            
             <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('comment', 'Комментарий покупателя', ['class' => 'control-label']) !!}
                    {!! Form::textarea('comment', old('comment'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('comment'))
                        <p class="help-block">
                            {{ $errors->first('comment') }}
                        </p>
                    @endif
                </div>
            </div>
       
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('status', 'Статус', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>    <script>
        $('.timepicker').datetimepicker({
            autoclose: true,
            timeFormat: "HH:mm:ss",
            timeOnly: true
        });
    </script>

@stop