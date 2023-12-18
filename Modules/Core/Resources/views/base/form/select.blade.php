@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control text-gray-800 fw-bold '.$classes : 'form-control text-gray-800 fw-bold';
@endphp

@if($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<select name="{{ $name }}" wire:model="data.{{ $name }}" {{ $required }} class="{{ $classes }}" {{ $attributes }}>
    @foreach($options as $value => $labelOption)
        <option value="{{ $value }}" {{ $value == $defaultValue ? 'selected' : '' }}>{{ $labelOption }}</option>
    @endforeach
</select>

@error('data.'.$name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
</div>
@enderror
