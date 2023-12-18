@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control '.$classes : 'form-control';
    $placeholder = isset($placeholder) ? 'placeholder='.$placeholder : '';
@endphp

@if($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<textarea name="{{ $name }}" wire:model="data.{{ $name }}" {{ $required }} class="{{ $classes }}" {{ $attributes }} {{ $placeholder }}></textarea>
@error('data.'.$name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
</div>
@enderror
