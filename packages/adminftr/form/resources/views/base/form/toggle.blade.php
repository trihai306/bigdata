@if(!$canHide)
    @if(!is_null($label))
        <label class="mb-2 form-label {{$required ? 'required':''}}" for="{{ $name }}">{{ $label }}</label>
    @endif
    <div class="form-check form-switch">
        <input type="checkbox" name="{{ $name }}" id="{{$name}}" {{ $required ? 'required' : '' }}
        {{ $wireModelDirective }}="data.{{$name}}"
        class="form-check-input @error('data.'.$name) is-invalid @enderror {{ $classes }}"
        {{ $attributes }} {{ !is_null($defaultValue) ? 'value='.$defaultValue : '' }}
        {{ !empty($placeholder) ? 'placeholder='.$placeholder : '' }}
        {{ $disabled ? 'disabled' : '' }}
        <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
@endif
