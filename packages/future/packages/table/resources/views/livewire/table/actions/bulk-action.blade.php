<button wire:click.prevent="" class="{{$class}}">
    @if($icon)
        <i class="{{$icon}}"></i>
    @endif
    <span class="ms-2">{{$label}}</span>
</button>
