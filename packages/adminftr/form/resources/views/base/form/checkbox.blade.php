@if(!$canHide)
    <label class="mb-2 form-label {{$required ? 'required':''}}" for="{{ $name }}">{{ $label }}</label>
    @foreach($options as $key => $option)
        <label class="form-check me-2 form-check-inline">
            <input type="checkbox" name="{{ $name }}" wire:model="data.{{ $name }}.{{ $key }}" id="{{ $name }}"
                   {{ $required }} class="{{ $classes }}" {{ $attributes }} {{ $checked }}>
            <span class="form-check-label" for="{{ $name }}">{{ $option }}</span>
            @if($descriptions)
                <span class="form-check-description">{{ $descriptions[$key] }}</span>
            @endif
        </label>
    @endforeach

    @error('data.'.$name)
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
    </div>
    @enderror

@endif
