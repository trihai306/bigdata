@extends('future::layouts.app')
@section('content')
<div class="card">
    <div class="row g-0">
        <div class="col-12 col-lg-5 col-xl-3 border-end">
            <div class="card-header d-none d-md-block">
                <div class="input-icon">
                      <span class="input-icon-addon"> <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path d="M21 21l-6 -6"></path></svg>
                      </span>
                    <input type="text" value="" class="form-control" placeholder="Search…" aria-label="Search">
                </div>
            </div>
            <div class="card-body p-0 scrollable" style="max-height: 35rem">
                <div class="nav flex-column nav-pills" role="tablist">
                    <a href="#chat-1" class="nav-link text-start mw-100 p-3 active" id="chat-1-tab" data-bs-toggle="pill" role="tab" aria-selected="true">
                        <div class="row align-items-center flex-fill">
                            <div class="col-auto"><span class="avatar" style="background-image: url({{ asset('static/avatars/000m.jpg') }})"></span>
                            </div>
                            <div class="col text-body">
                                <div>Paweł Kuna</div>
                                <div class="text-secondary text-truncate w-100">Sure Paweł, let me pull the latest updates.</div>
                            </div>
                        </div>
                    </a>
                    <a href="#chat-1" class="nav-link text-start mw-100 p-3" id="chat-1-tab" data-bs-toggle="pill" role="tab" aria-selected="false" tabindex="-1">
                        <div class="row align-items-center flex-fill">
                            <div class="col-auto"><span class="avatar">JL</span>
                            </div>
                            <div class="col text-body">
                                <div>Jeffie Lewzey</div>
                                <div class="text-secondary text-truncate w-100">I'm on it too 👊</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-7 col-xl-9 d-flex flex-column">
            <div class="card-body scrollable" style="height: 35rem">
                <div class="chat">
                    <div class="chat-bubbles">
                        <div class="chat-item">
                            <div class="row align-items-end justify-content-end">
                                <div class="col col-lg-6">
                                    <div class="chat-bubble chat-bubble-me">
                                        <div class="chat-bubble-title">
                                            <div class="row">
                                                <div class="col chat-bubble-author">Paweł Kuna</div>
                                                <div class="col-auto chat-bubble-date">09:32</div>
                                            </div>
                                        </div>
                                        <div class="chat-bubble-body">
                                            <p>Hey guys, I just pushed a new commit on the <code>dev</code> branch. Can you have a look and tell me what you think?</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto"><span class="avatar" style="background-image: url({{ asset('static/avatars/000m.jpg') }})"></span>
                                </div>
                            </div>
                        </div>
                        <div class="chat-item">
                            <div class="row align-items-end">
                                <div class="col-auto"><span class="avatar" style="background-image: url({{ asset('static/avatars/002m.jpg') }})"></span>
                                </div>
                                <div class="col col-lg-6">
                                    <div class="chat-bubble">
                                        <div class="chat-bubble-title">
                                            <div class="row">
                                                <div class="col chat-bubble-author">Mallory Hulme</div>
                                                <div class="col-auto chat-bubble-date">09:34</div>
                                            </div>
                                        </div>
                                        <div class="chat-bubble-body">
                                            <p>Sure Paweł, let me pull the latest updates.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="input-group input-group-flat">
                    <textarea class="form-control" autocomplete="off" placeholder="Type message" ></textarea>
                    <span class="input-group-text">
                        <a href="#" class="link-secondary" data-bs-toggle="tooltip" aria-label="Clear search" data-bs-original-title="Clear search"> <!-- Download SVG icon from http://tabler-icons.io/i/mood-smile -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path><path d="M9 10l.01 0"></path><path d="M15 10l.01 0"></path><path d="M9.5 15a3.5 3.5 0 0 0 5 0"></path></svg>
                        </a>
                        <a href="#" class="link-secondary ms-2" data-bs-toggle="tooltip" aria-label="Add notification" data-bs-original-title="Add notification"> <!-- Download SVG icon from http://tabler-icons.io/i/paperclip -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5"></path></svg>
                        </a>
                      </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
