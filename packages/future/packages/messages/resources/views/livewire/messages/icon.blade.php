<div class="nav-item dropdown d-none d-md-flex">
    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
             stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <rect x="3" y="5" width="18" height="14" rx="2"/>
            <polyline points="3 7 12 13 21 7"/>
        </svg>
        <span class="badge bg-primary text-white badge-notification badge-pill">{{$count}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách tin nhắn <span
                        class="badge text-white bg-primary ms-2">{{$count}}</span>
                </h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
                @foreach($conversations as $conversation)
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col-auto">
                            <span class="avatar avatar-sm">
                                <img src="{{ asset($conversation->users[0]->avatar ?? 'static/avatars/001f.jpg') }}"
                                     alt="..."
                                     class="avatar-img rounded-circle">
                            </span>
                            </div>
                            <div class="col
                                @if($conversation->userConversations[0]->last_seen_message_id == $conversation->lastMessage->id)
                                font-weight-bold text-white
                                @endif
                            ">
                                <a href="#" class="text-body d-block">{{$conversation->users[0]->name}}</a>
                                <div class="d-block text-muted text-truncate mt-n1">
                                    {{$conversation->lastMessage->content}}
                                </div>
                            </div>
                            <div class="col-auto text-secondary
                            @if($conversation->userConversations[0]->last_seen_message_id == $conversation->lastMessage->id)
                                font-weight-bold text-white
                                @endif
                            ">
                                <p>   {{$conversation->lastMessage->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col text-center">
                            <a href="#" class="btn w-100">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
