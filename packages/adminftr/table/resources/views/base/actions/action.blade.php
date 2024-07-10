<a class="text-decoration-none {{$action->color}} w-100 action-box"
   @if($action->link)   href='{{ $action->link }}' @endif
   @if($action->modal) data-bs-toggle="modal" x-on:click="$wire.dispatch('setModel',{id:{{$action->id}}})"
   data-bs-target="#{{ $action->name }}" @endif
   @if(!empty($action->sweetAlert))
       wire:click="$dispatch('{{$action->sweetAlert['eventName']}}', {
                    message: '{{$action->sweetAlert['options']['message']}}',
                    @if($action->sweetAlert['options']['params'])
                    params: '{{$action->sweetAlert['options']['params']}}',
                    @endif
                    nameMethod: '{{$action->sweetAlert['options']['nameMethod']}}'
                })" @endif
   data-action='{{ $action->name }}'>
    <i class='{{ $action->icon }}' style='{{ $action->size }} color:rgba(47, 43, 61, 0.7);'></i> <span
        class="ms-2">{{ $action->label }}</span>
</a>
