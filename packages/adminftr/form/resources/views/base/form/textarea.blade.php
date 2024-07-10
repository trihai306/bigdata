@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control '.$classes : 'form-control';
    $placeholder = isset($placeholder) ? 'placeholder='.$placeholder : '';
@endphp

@if(!$canHide)

    <div>
        @if($label)
            <label for="{{ $name }}" class="form-label {{$required}}">{{ $label }}</label>
        @endif
        <textarea name="{{ $name }}" data-bs-toggle="autosize" id="{{$name}}" wire:model="data.{{ $name }}"
                  {{ $required }} class="{{ $classes }} @error('data.'.$name) is-invalid @enderror" {{ $attributes }} {{ $placeholder }}></textarea>
    </div>
    @error('data.'.$name)
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
    </div>
    @enderror
@endif
