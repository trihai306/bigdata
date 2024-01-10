<div id="chat" class="bg-body offcanvas offcanvas-end" wire:ignore.self tabindex="-1" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h3 class="mt-2">Thông báo</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="card h-100 shadow-none border-0 rounded-0 w-100" >
        <!--begin::Body-->
        <div class="card-body position-relative" >
            <!--begin::Content-->
            <div id="rv_activities_scroll" class="position-relative scroll-y me-n5">
                <!--begin::Timeline items-->
                <div class="timeline scroll-y" style="max-height: 76vh" >
                    @foreach($notifications as $notification)
                        <!--begin::Timeline item-->
                        <div class="timeline-item" wire:click="markAsRead('{{$notification->id}}')" style="cursor: pointer;">
                            <!--begin::Timeline content-->
                            <div class="timeline-content mb-10 mt-n1">
                                <!--begin::Timeline heading-->
                                <div class="pe-3 mb-5">
                                    <!--begin::Title-->
                                    <div class="{{ is_null($notification->read_at) ? 'text-danger' : 'text-success' }} fs-5 fw-semibold mb-2">
                                        {{$notification->data['title']}} -
                                        {{
                                            \Carbon\Carbon::parse($notification->created_at)->diffForHumans()
                                        }}
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="{{ is_null($notification->read_at) ? 'text-white' : 'text-secondary' }} me-2 fs-7">{{$notification->data['content']}}</div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        <!--end::Timeline item-->
                    @endforeach
                    <div x-data="{}" x-intersect="$wire.loadMore()" class="w-100 h-10px d-block">
                        <div class="spinner-border text-primary" role="status">

                        </div>
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <!--end::Timeline items-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer text-center" id="rv_activities_footer">
            <button wire:click="readAll"  class="btn btn-bg-body text-primary"> Đánh dấu tất cả đã đọc</button>
        </div>
        <!--end::Footer-->
    </div>

</div>
