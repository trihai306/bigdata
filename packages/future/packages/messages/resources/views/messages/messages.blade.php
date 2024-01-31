<div class="col-12 col-lg-7 col-xl-9 " id="chat" wire:ignore.self>
    @if($user)
        <div class="card position-relative">
            <div class="card-header">
                <div>
                    <div class="row align-items-center">
                        <div class="col-auto">
                            @if($user->avatar)
                                <span class="avatar" style="background-image: url({{asset($user->avatar)}})"></span>
                            @else
                                <span class="avatar">
                                    {{ $user->name[0] }}
                                </span>
                            @endif
                        </div>
                        <div class="col">
                            <div class="card-title">{{$user->name}}</div>
                            <div class="card-subtitle">{{$user->type}}</div>
                        </div>
                    </div>
                </div>
                <div class="card-actions">
                    <a href="#" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                        </svg>
                        Phone
                    </a>
                    @include('future::messages.components.profile',['user' => $user])
                </div>
            </div>
            <div class="card-body d-flex flex-column">
                @if($messages)
                    <div class="card-body scrollable" style="height: 35rem ; display: flex;
    flex-direction: column-reverse;
    overflow-y: auto;">
                        <div class="chat">
                            @if($messages->total() > 10 && $messages->currentPage() < $messages->lastPage())
                                <div class="chat-bubbles mb-3" x-data="{}" x-intersect="$wire.loadMore()">
                                    <div class="chat-item mt-5">
                                        <div class="row align-items-end">
                                            <div class="col-auto">
                                                <span class="avatar">
                                                    <div class="placeholder bg-secondary" style="width: 50px; height: 50px;"></div>
                                                </span>
                                            </div>
                                            <div class="col col-lg-6">
                                                <div class="chat-bubble">
                                                    <div class="chat-bubble-title">
                                                        <div class="row">
                                                            <div class="col chat-bubble-author">
                                                                <div class="placeholder-glow">
                                                        <span class="placeholder bg-secondary"
                                                              style="width: 400px;"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto chat-bubble-date">
                                                                <div class="placeholder-glow">
                                                        <span class="placeholder bg-secondary"
                                                              style="width: 400px;"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="chat-bubble-body">
                                                        <div class="placeholder-glow">
                                                            <span class="placeholder bg-secondary"
                                                                  style="width: 100%;"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="chat-bubbles" id="chat-bubbles">
                                @foreach($messages->reverse() as $message)
                                    @if($message->sender->id == Auth::user()->id)
                                        <div class="chat-item">
                                            <div class="row align-items-end justify-content-end">
                                                <div class="col col-lg-6">
                                                    <div class="chat-bubble chat-bubble-me" style="">
                                                        <div class="chat-bubble-title">
                                                            <div class="row">
                                                                <div
                                                                    class="col chat-bubble-author">{{$message->sender->name}}</div>
                                                                <div class="col-auto chat-bubble-date">{{
                                            $message->created_at->diffForHumans() }} </div>
                                                            </div>
                                                        </div>
                                                        <div class="chat-bubble-body">
                                                            <p>
                                                                {{$message->content}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    @if($message->sender->avatar)
                                                        <span class="avatar"
                                                              style="background-image: url({{ asset($message->sender->avatar) }})"></span>
                                                    @else
                                                        <span class="avatar">
                                        {{ $message->sender->name[0] }}
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="chat-item">
                                            <div class="row align-items-end">
                                                <div class="col-auto">
                                                    @if($message->sender->avatar)
                                                        <span class="avatar"
                                                              style="background-image: url({{ asset($message->sender->avatar) }})"></span>
                                                    @else
                                                        <span class="avatar">
                                        {{ $message->sender->name[0] }}
                                    </span>
                                                    @endif
                                                </div>
                                                <div class="col col-lg-6">
                                                    <div class="chat-bubble">
                                                        <div class="chat-bubble-title">
                                                            <div class="row">
                                                                <div
                                                                    class="col chat-bubble-author">{{$message->sender->name}}</div>
                                                                <div class="col-auto chat-bubble-date">{{
                                            $message->created_at->diffForHumans() }} </div>
                                                            </div>
                                                        </div>
                                                        <div class="chat-bubble-body">
                                                            <p>
                                                                {{$message->content}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @livewire('future::messages.create-message', ['conversationId' => $conversationId, 'userId' => $user->id])
                @else
                    <div class="card-body scrollable" style="height: 35rem ; display: flex;
    flex-direction: column-reverse;
    overflow-y: auto;">
                        <div class="chart">
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered rounded rounded-">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">File Upload</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="list-group list-group-flush list-group-hoverable" id="list-file">
                        </div>
                        <input type="file" multiple id="fileUpload" class="form-control" style="display: none;"
                               onchange="handleFiles(this.files)" accept=".doc,.docx,.xls,.xlsx,image/*">
                        <textarea
                            class="form-control mt-4"
                            placeholder="Write a message..."
{{--                            wire:model="content"--}}
                            {{--                            wire:keydown.enter="send"--}}
                        ></textarea>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="sendFile" type="button" class="btn w-100 btn-primary">Send</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <emoji-picker style="position: absolute;z-index: 99999;top: 35%;left: 59%;display: none"></emoji-picker>
</div>
@script
<script>
    $wire.on('messageSent', (e) => {
        e = e[0].message;
        var conversationId = e.conversation_id;
        let chatItem = createChatItem(e.content, e.sender.name, e.sender.avatar, e.sender.id === {{Auth::user()->id}}, e.created_at);
        document.getElementById('chat-bubbles').appendChild(chatItem);
    });
    function createChatItem(message, senderName, senderAvatar, isUser, time) {
        // Create chat item
        var chatItem = document.createElement('div');
        chatItem.className = 'chat-item';

        // Create row
        var row = document.createElement('div');
        row.className = isUser ? 'row align-items-end justify-content-end' : 'row align-items-end';

        // Create column for chat bubble
        var colBubble = document.createElement('div');
        colBubble.className = 'col col-lg-6';

        // Create chat bubble
        var chatBubble = document.createElement('div');
        chatBubble.className = isUser ? 'chat-bubble chat-bubble-me' : 'chat-bubble';

        // Create chat bubble title
        var bubbleTitle = document.createElement('div');
        bubbleTitle.className = 'chat-bubble-title';
        var bubbleTitleRow = document.createElement('div');
        bubbleTitleRow.className = 'row';
        bubbleTitle.appendChild(bubbleTitleRow);
        // Create author and time
        var author = document.createElement('div');
        author.className = 'col chat-bubble-author';
        author.textContent = senderName;

        var date = document.createElement('div');
        date.className = 'col-auto chat-bubble-date';
        date.textContent = time;

        // Append author and time to bubbleTitle
        bubbleTitleRow.appendChild(author);
        bubbleTitleRow.appendChild(date);

        // Create chat bubble body
        var bubbleBody = document.createElement('div');
        bubbleBody.className = 'chat-bubble-body';

        // Create paragraph for message content
        var p = document.createElement('p');
        p.textContent = message;

        // Append elements
        bubbleBody.appendChild(p);
        chatBubble.appendChild(bubbleTitle);
        chatBubble.appendChild(bubbleBody);
        colBubble.appendChild(chatBubble);
        row.appendChild(colBubble);
        chatItem.appendChild(row);

        // Create avatar
        var avatar = document.createElement('span');
        avatar.className = 'avatar';
        if (senderAvatar) {
            avatar.style.backgroundImage = 'url(' + senderAvatar + ')';
        } else {
            avatar.textContent = senderName[0];
        }

        // Append avatar to the correct column based on whether the message is from the user or not
        if (isUser) {
            var colAvatar = document.createElement('div');
            colAvatar.className = 'col-auto';
            colAvatar.appendChild(avatar);
            row.appendChild(colAvatar);
        } else {
            var colAvatar = document.createElement('div');
            colAvatar.className = 'col-auto';
            colAvatar.appendChild(avatar);
            row.insertBefore(colAvatar, row.firstChild);
        }

        return chatItem;
    }
    window.Echo.private(`App.Models.User.{{Auth::user()->id}}`)
        .listen('UserMessageEvent', (e) => {
            var sender = e.sender;
            var message = e.message;
            let chatItem = createChatItem(message.content, sender.name, sender.avatar, sender.id === {{Auth::user()->id}}, message.created_at);
            document.getElementById('chat-bubbles').appendChild(chatItem);
        });
</script>
@endscript
