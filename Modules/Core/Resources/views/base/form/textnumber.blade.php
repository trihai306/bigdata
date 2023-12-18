@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control '.$classes : 'form-control';
    $min = isset($min) ? 'min='.$min : '';
    $max = isset($max) ? 'max='.$max : '';
    $step = isset($step) ? 'step='.$step : '';
    $placeholder = isset($placeholder) ? 'placeholder='.$placeholder : '';
@endphp

@if($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<input type="number" name="{{ $name }}" wire:model="data.{{ $name }}" {{ $required }} class="{{ $classes }}" {{ $attributes }} {{ $min }} {{ $max }} {{ $step }} {{ $placeholder }}>
