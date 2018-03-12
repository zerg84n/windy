@forelse($properties as $property)
      <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('property['.$property->id.']', $property->title, ['class' => 'control-label']) !!}
            @if($property->getInputType()=='number')
                 {!! Form::number('property['.$property->id.']', '', ['class' => 'form-control', 'placeholder' => '']) !!}   
            @elseif($property->getInputType()=='float')
                 {!! Form::number('property['.$property->id.']', '', ['class' => 'form-control', 'placeholder' => '', 'step'=>'.01']) !!}   
            @elseif($property->getInputType()=='text')
                {!! Form::text('property['.$property->id.']', '', ['class' => 'form-control', 'placeholder' => '']) !!}
            @elseif($property->getInputType()=='select')
                @php
                    $categories = collect();
                @endphp
                {!! Form::select('property['.$property->id.']', $property->variants->pluck('value','id')->prepend('Выберите характеристику', ''), '', ['class' => 'form-control select2']) !!}
            @elseif($property->getInputType()=='checkbox')
                {!! Form::hidden('property['.$property->id.']', 0) !!}
                 {!! Form::checkbox('property['.$property->id.']', 1, 1, []) !!}
            @endif
               </div>
             
        </div>
@empty
<p>Категория не выбрана!</p>
@endforelse
   