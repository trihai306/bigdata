@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control  form-select'.$classes : 'form-control form-select';
@endphp

@if($label)
    <div class="form-label">{{$label}}</div>
@endif

<select name="{{ $name }}" id="{{$name}}"  wire:model="data.{{ $name }}" {{ $required }} class="{{ $classes }}" {{ $attributes }}>
    @foreach($options as $value => $labelOption)
        <option value="{{ $value }}" {{ $value == $defaultValue ? 'selected' : '' }}>{{ $labelOption }}</option>
    @endforeach
</select>

@error('data.'.$name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
</div>
@enderror

@script
<script>
    window.TomSelect && Array.from(document.querySelectorAll('select')).forEach(select => {
        new TomSelect(select, {
            copyClassesToDropdown: false,
            dropdownParent: 'body',
            controlInput: '<input>',
            render:{
                item: function(data,escape) {
                    if( data.customProperties ){
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data,escape){
                    if( data.customProperties ){
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
            onInitialize: function() {
                var defaultValue = select.value;
                console.log('Default value:', defaultValue);
            }
        });
    });
</script>
@endscript
