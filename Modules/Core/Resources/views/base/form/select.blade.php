@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control  form-select'.$classes : 'form-control form-select';
@endphp

@if($label)
    <div class="form-label">{{$label}}</div>
@endif

<select name="{{ $name }}" id="testselect" wire:model="data.{{ $name }}" {{ $required }} class="{{ $classes }}" {{ $attributes }}>
    @foreach($options as $value => $labelOption)
        <option value="{{ $value }}" {{ $value == $defaultValue ? 'selected' : '' }}>{{ $labelOption }}</option>
    @endforeach
</select>

@error('data.'.$name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
</div>
@enderror

