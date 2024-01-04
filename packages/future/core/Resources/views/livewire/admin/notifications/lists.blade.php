<div class="timeline scroll-y" style="max-height: 77vh">
    @foreach($notifications as $notification)
        <!--begin::Timeline item-->
        <div class="timeline-item" wire:click="markAsRead('{{$notification->id}}')" style="cursor: pointer;">
            <!--begin::Timeline content-->
            <div class="timeline-content mb-10 mt-n1">
                <!--begin::Timeline heading-->
                <div class="pe-3 mb-5">
                    <!--begin::Title-->
                    <div class="{{ is_null($notification->read_at) ? 'text-danger' : 'text-success' }} fs-5 fw-semibold mb-2">{{$notification->data['title']}}</div>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="d-flex align-items-center mt-1 fs-6">
                        <!--begin::Info-->
                        <div class="{{ is_null($notification->read_at) ? 'text-white' : 'text-secondary' }} me-2 fs-7">{{$notification->data['content']}}</div>
                        <!--end::Info-->
                        <!--begin::Info-->
                        <div class="text-muted me-2 fs-7">Added at
                            {{
                        \Carbon\Carbon::parse($notification->created_at)->diffForHumans()
                    }}
                            PM
                        </div>
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
    <div x-data="{}" x-intersect="$wire.loadMore()" class="w-100 h-10px"></div>
</div>
