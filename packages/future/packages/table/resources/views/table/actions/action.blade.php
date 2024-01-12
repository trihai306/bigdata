<a class="btn btn-{{$color ?:'primary'}}"
   @if($url)
       href="{{$url}}"
    @endif
>
    <i class="{{$icon ?:"fa fa-redo-alt"}}"></i> <span class="ms-2">{{$label}}</span>
</a>
