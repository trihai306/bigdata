@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control form-control-rounded '.$classes : 'form-control form-control-rounded';
    $placeholder = isset($placeholder) ? 'placeholder='.$placeholder : '';
@endphp

@if($label)
    <label class="mt-2" for="{{ $name }}">{{ $label }}</label>
@endif

<input type="text" name="{{ $name }}"  wire:model.defer="data.{{ $name }}" {{ $required }} class="{{ $classes }}" {{ $attributes }} {{ $placeholder }}>
@error('data.'.$name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
</div>
@enderror

@assets
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js" defer></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endassets

@script
<script>
    new Pikaday({
        field: $wire.$el.querySelector('[data-picker]'),
        onSelect: function(date) {
            $wire.set('data.{{ $name }}', this.getMoment().format('YYYY-MM-DD'));
        }
    });
</script>
@endscript
