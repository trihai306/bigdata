<div class="col-12 col-lg-5 col-xl-3 border-end">
    <div class="card-header d-none d-md-block">
        <div class="input-icon">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path
                        stroke="none" d="M0 0h24v24H0z" fill="none"></path><path
                        d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>
            </span>
            <input type="text" wire:model.live.200="search" value="" class="form-control" placeholder="Search…"
                   aria-label="Search">
        </div>
    </div>
    <div class="card-body p-0 scrollable" style="max-height: 35rem">
        <div class="nav flex-column nav-pills" role="tablist">
            @foreach($conversations as $conversation)
                <a href="#chat-{{$conversation->id}}"
                   class="nav-link text-start mw-100 p-3 {{ $loop->first ? 'active' : '' }}" id="chat-1-tab"
                   data-bs-toggle="pill" role="tab" aria-selected="true">
                    <div class="row align-items-center flex-fill">
                        <div class="col-auto">
                            @if($conversation->users[0]->avatar)
                                <span class="avatar"
                                      style="background-image: url({{ asset($conversation->users[0]->avatar) }})"></span>
                            @else
                                <span class="avatar">
                                    {{ $conversation->users[0]->name[0] }}
                                </span>
                            @endif
                        </div>
                        <div class="col text-body">
                            <div>{{ $conversation->users[0]->name }}</div>
                            <div class="text-secondary text-truncate w-100">
                                {{$conversation->lastMessage->content}}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
            <div x-data="{}" x-intersect="$wire.loadMore()" class="w-100 d-block" style="height: 10px">
            </div>
        </div>
    </div>
</div>
