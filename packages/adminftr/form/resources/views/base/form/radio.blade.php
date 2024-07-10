@if(!$canHide)
    @php
        $required = $isRequired ? 'required' : '';
        $classes = !empty($classes) ? 'form-check-input '.$classes : 'form-check-input';
         $wireModelDirective = $reactive ? 'wire:model.live.debounce.500ms' : 'wire:model';
    @endphp

    @if($label)
        <label class="mb-2 form-label {{$required ? 'required':''}}" for="{{ $name }}">{{ $label }}</label>
    @endif

    @foreach($options as $index => $option)
        <div class="form-check">
            <input type="radio" name="{{ $name }}" value="{{ $option['id'] }}"
            {{ $wireModelDirective }}="data.{{ $name }}"
            id="{{ $name }}-{{ $option['id'] }}-{{ $index }}"
            {{ $required }} class="{{$classes}}" {{ $attributes }}>
            <label class="form-check-label" for="{{ $name }}-{{ $option['id'] }}-{{ $index }}"
            >{{ $option['label'] }}</label>
        </div>
    @endforeach
    @error('data.'.$name)
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
    </div>
    @enderror
@endif
