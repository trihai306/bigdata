@php
    $classes = !empty($classes) ? 'form-control ' . $classes : 'form-control';
    $parts = str_replace('.', '_', $name);
@endphp

<div class="mb-3">
    @if($label)
        <label class="form-label" for="{{$parts}}">{{$label}}</label>
    @endif

    <div x-data='{
        init() {
            if (!document.querySelector("#{{$parts}}").classList.contains("tomselected")) {
                let tomSelect{{$parts}} = new TomSelect("#{{$parts}}", {
                    valueField: "{{$valueField}}",
                    onChange: value => this.onChange(value),
                    options: this.options,
                    searchField: ["{{$labelField}}"],
                    plugins: ["dropdown_input", "remove_button"],
                    maxOptions: {{$maxOptions}},
                    create: false,
                    render: {
                        option: function(data, escape) {
                            return "<div>" + escape(data.{{$labelField}}) + "</div>";
                        },
                        item: function(data, escape) {
                            return "<div>" + escape(data.{{$labelField}}) + "</div>";
                        }
                    },
                    load: function(query, callback) {
                        callback();
                    }
                });

                if ($wire.get("selectedRows.{{$parts}}") instanceof Object) {
                    $wire.get("selectedRows.{{$parts}}").forEach(item => {
                        tomSelect{{$parts}}.addItem(item["{{$valueField}}"]);
                    });
                } else {
                    tomSelect{{$parts}}.addItem($wire.get("selectedRows.{{$name}}"));
                }

                document.querySelector("#{{$parts}}").classList.add("tomselected");
            }
        },
        onChange(value) {
{{--            $wire.set("selectedRows.{{$parts}}", value, true);--}}
        },
        options: @json($options)
    }' >
        <select id="{{$parts}}" {{$multiple ? 'multiple' : ''}} name="selectedRows[{{$name}}]" wire:model.defer="selectedRows.{{ $name }}" class="{{ $classes }}"
                >
        </select>
    </div>

    @error('selectedRows.'.$name)
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
    </div>
    @enderror
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('{{$name}}', () => ({
            init() {
                // Custom initialization logic if needed
            }
        }))
    })
</script>
