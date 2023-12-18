<div id="chat" class="bg-body offcanvas offcanvas-end" tabindex="-1" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h3 class="mt-2">Thông báo</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="card h-100 shadow-none border-0 rounded-0 w-100">
        <!--begin::Body-->
        <div class="card-body position-relative" >
            <!--begin::Content-->
            <div id="rv_activities_scroll" class="position-relative scroll-y me-n5 pe-5">
                <!--begin::Timeline items-->

                <livewire:core::admin.notifications.lists lazy />


                <!--end::Timeline items-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer py-5 text-center" id="rv_activities_footer">
            <a href="#" class="btn btn-bg-body text-primary">Xem thêm
                <i class="ki-duotone ki-arrow-right fs-3 text-primary">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i></a>
        </div>
        <!--end::Footer-->
    </div>

</div>
