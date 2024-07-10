<div x-data="{
        name: '{{ $name }}',
        classes: '{{ $classes }}',
        required: '{{ $required }}',
        attributes: '{{ $attributes }}',
        initTinyMCE() {
          if (tinymce.get(this.name)) {
                tinymce.remove('#' + this.name);
            }
            tinymce.init({
                selector: '#' + this.name,
                plugins: '{{ $plugins }}',
                toolbar_mode: 'floating',
                branding: false,
                promotion: false,
                toolbar: '{{ $toolbar }}',
                height: '{{ $height }}',
                menubar: '{{ $menubar }}',
                statusbar: '{{ $statusbar }}',
                readonly: '{{ $readonly }}',
                setup: (editor) => {
                    editor.on('change', () => {
                      $wire.set('data.' + this.name, editor.getContent(),false);
                    });
                }
            });
        },
    }" x-init="initTinyMCE">
    <label  class="form-label {{$required ? 'required':''}}" for="{{$name}}">{{$label}}</label >
    <textarea id="{{$name}}" name="{{$name}}" wire:model="data.{{$name}}" :class="classes" :required="required"
              :attributes="attributes"></textarea>
</div>
