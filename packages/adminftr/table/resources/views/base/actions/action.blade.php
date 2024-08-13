@if(!$action->hide)
    <a class="btn {{$action->color}} w-100 text-start"
       @if($action->link) href="{{ $action->link }}" @endif
       @if($action->modal) data-bs-toggle="modal" x-on:click="$wire.dispatch('setModel',{id:{{$action->id}}})"
       data-bs-target="#{{ $action->name }}" @endif
       @if(!empty($action->sweetAlert))
           wire:click="$dispatch('{{$action->sweetAlert['eventName']}}', {
                title: '{{ trim($action->sweetAlert['title']) }}',
                message: '{{ trim($action->sweetAlert['message']) }}',
                params: { id: '{{ trim($action->sweetAlert['id']) }}' },
                nameMethod: 'callbackActions',
                name: '{{ trim($action->name) }}'
            })" @endif
       data-action="{{ $action->name }}">
        <i class="{{ $action->icon }}" style="{{ $action->size }}"></i> <span class="ms-2">{{ $action->label }}</span>
    </a>
@endif
