@php use Carbon\Carbon; @endphp
<div id="notification" class="bg-body offcanvas offcanvas-end" wire:ignore.self tabindex="-1"
     aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h3 class="mt-2">Thông báo</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="card h-100 shadow-none border-0 rounded-0 w-100">
        <div class="card-body position-relative">
            <div id="rv_activities_scroll" class="position-relative scroll-y me-n5">
                <div class="timeline scroll-y" style="max-height: 76vh">
                    @if($notifications)
                        @foreach($notifications as $notification)
                            <div class="timeline-item" wire:click="markAsRead('{{$notification->id}}')"
                                 style="cursor: pointer;">
                                <div class="timeline-content mb-10 mt-n1">
                                    <div class="pe-3 mb-5">
                                        <div
                                            class="{{ is_null($notification->read_at) ? 'text-danger' : 'text-success' }} fs-5 fw-semibold mb-2">
                                            {{$notification->data['title']}} -
                                            {{
                                                Carbon::parse($notification->created_at)->diffForHumans()
                                            }}
                                        </div>
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <div
                                                class="{{ is_null($notification->read_at) ? 'text-white' : 'text-secondary' }} me-2 fs-7">{{$notification->data['content']}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($notifications->total() > 10 && $notifications->currentPage() < $notifications->lastPage())
                            <div x-data="{}" x-intersect="$wire.loadMore()" class="w-100 h-10px d-block">
                                <ul class="list-group list-group-flush placeholder-glow">
                                    <li class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <div class="avatar avatar-rounded placeholder"></div>
                                            </div>
                                            <div class="col-7">
                                                <div class="placeholder placeholder-xs col-9"></div>
                                                <div class="placeholder placeholder-xs col-7"></div>
                                            </div>
                                            <div class="col-2 ms-auto text-end">
                                                <div class="placeholder placeholder-xs col-8"></div>
                                                <div class="placeholder placeholder-xs col-10"></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer text-center" id="rv_activities_footer">
            <button wire:click="readAll" wire:loading.remove class="btn btn-bg-body text-primary"> Đánh dấu tất cả đã đọc</button>
            <button wire:loading wire:target="readAll" class="btn btn-bg-body text-primary" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Đang xử lý...
            </button>
        </div>
    </div>
</div>
