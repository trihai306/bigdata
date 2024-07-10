@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control  '.$classes : 'form-control ';
    $placeholder = isset($placeholder) ? 'placeholder='.$placeholder : '';
@endphp

<div x-data='
    {
    init(){
      flatpickr("#{{ $name }}", {
                enableTime: true,
                dateFormat: "{{$format}}",
                time_24hr: true,
                onChange: function(selectedDates, dateStr, instance) {
                    $wire.set("data.{{ $name }}", dateStr, {{$reactive ? "true" : "false"}});
                },
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                        longhand: [
                            "Sunday",
                            "Monday",
                            "Tuesday",
                            "Wednesday",
                            "Thursday",
                            "Friday",
                            "Saturday",
                        ],
                    },
                    months: {
                        shorthand: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dec",
                        ],
                        longhand: [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "December",
                        ],
                    },
                },
            });
    },
    }
'>
    @if($label)
        <label class="mt-2" for="{{ $name }}">{{ $label }}</label>
    @endif
    <input name="{{ $name }}" id="{{$name}}" wire:model="data.{{ $name }}"
           {{ $required }} class="{{ $classes }}" {{ $attributes }} {{ $placeholder }}>
    @error('data.'.$name)
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
    </div>
    @enderror
</div>
