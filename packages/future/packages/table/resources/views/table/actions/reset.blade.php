<a wire:click.prevent="resetTable" class="btn btn-{{$color ?:'primary'}}">
    <i class="{{$icon ?:"fa fa-redo-alt"}}"></i> <span class="ms-2">{{ __('future::messages.reset') }}</span>
</a>
