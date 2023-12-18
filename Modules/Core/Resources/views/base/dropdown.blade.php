<div class='dropdown'>
    <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown'>Actions</button>
    <div class='dropdown-menu'>
        @foreach($actions as $action)
            <a class='dropdown-item'
               @if($action->link) href='{{ $action->link }}' @else href="#" @endif
{{--               @if($action->modalId) data-bs-toggle="modal" data-bs-target="#{{ $action->modalId }}" @endif--}}
                @if(!empty($action->sweetAlert)) wire:click.prevent="$dispatch('{{$action->sweetAlert['eventName']}}', {
                    message: '{{$action->sweetAlert['options']['message']}}',
                    id: {{$action->sweetAlert['options']['id']}},
                    nameMethod: '{{$action->sweetAlert['options']['nameMethod']}}'
                })" @endif


               data-action='{{ $action->name }}'>
                <i class='{{ $action->icon }}'></i> <span class="ms-2">{{ $action->label }}</span>
            </a>
        @endforeach
    </div>
</div>
