@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control ' . $classes : 'form-control';
    $parts = str_replace('.', '_', $name);
@endphp

@if(!$canHide)
    @if($label)
        <label class="form-label {{$required}}" for="{{$parts}}">{{$label}}</label>
    @endif
    <div x-data='{
        init() {
            if (!document.querySelector("#{{$parts}}").classList.contains("tomselected")) {
                const tomSelect{{$parts}} = new TomSelect("#{{$parts}}", {
                    valueField: "{{$valueField}}",
                    onChange: value => this.onChange(value),
                    options: this.options,
                    searchField: ["{{$labelField}}"],
                    plugins: {!! json_encode($plugins) !!},
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
                    @if($liveSearch)

                    load: function(query, callback) {
                        $wire.call("searchSelect", query, "{{$name}}").then(response => {
                            const data = response.map(item => ({
                                "{{$valueField}}": item["{{$valueField}}"],
                                "{{$labelField}}": item["{{$labelField}}"]
                            }));
                            callback(data);
                        });
                    }
                    @endif
                });

                const dataParts = $wire.get("data.{{$parts}}");
                if (dataParts instanceof Object) {
                    dataParts.forEach(item => {
                        tomSelect{{$parts}}.addItem(item["{{$valueField}}"]);
                    });
                } else {
                    tomSelect{{$parts}}.addItem($wire.get("data.{{$name}}"));
                }
                document.querySelector("#{{$parts}}").classList.add("tomselected");
            }
        },
        onChange(value) {
            $wire.set("data.{{$parts}}", value, {{$reactive ? "true" : "false"}});
        },
        options: @json($options)
    }' class="dropdown">
        <select id="{{$parts}}" {{$multiple ? 'multiple' : ''}} {{$required}} class="{{ $classes }}"></select>
    </div>
    @error('data.'.$name)
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
    </div>
    @enderror
@endif
