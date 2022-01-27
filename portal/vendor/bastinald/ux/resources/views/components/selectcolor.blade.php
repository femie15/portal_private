@props([
    'label' => null,
    'placeholder' => null,
    'options' => [],
    'icon' => null,
    'prepend' => null,
    'append' => null,
    'size' => null,
    'help' => null,
    'model' => null,
    'lazy' => false,
])

@php
    if ($lazy) $bind = '.lazy';
    else $bind = '.defer';

    $options = Arr::isAssoc($options) ? $options : array_combine($options, $options);

    $attributes = $attributes->class([
        'form-select',
        'form-select-' . $size => $size,
        'rounded-end' => !$append,
        'is-invalid' => $errors->has($model),
    ])->merge([
        'id' => $model,
        'wire:model' . $bind => 'model.' . $model,
    ]);
@endphp
 
<div>
    <x-ux::label :for="$model" :label="$label"/>

    <div class="input-group">
        <x-ux::input-addon :icon="$icon" :label="$prepend"/>

        <select {{ $attributes }} >
            <option value="{{ $placeholder }}">{{ $placeholder }}</option>

            
            @foreach($options as $optionValue => $optionLabel)
                @if ($optionValue=='cafe')
                    <option style="background-color:#31271e;" value="{{ $optionValue }}"> {{ $optionLabel }}</option>
                @elseif ($optionValue=='default')
                    <option style="background-color:#303641;" value="{{ $optionValue }}"> {{ $optionLabel }}</option>
                @else
                    <option style="background-color:{{ $optionValue }};" value="{{ $optionValue }}">{{ $optionLabel }} </option>
                @endif
            @endforeach
        </select>

        <x-ux::input-addon :label="$append" class="rounded-end"/>

        <x-ux::error :key="$model"/>
    </div>

    <x-ux::help :label="$help"/>
</div>
