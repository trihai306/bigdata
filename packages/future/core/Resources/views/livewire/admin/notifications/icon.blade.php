<!--begin::Drawer toggle-->
<div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline btn-active-bg-light w-30px h-30px w-lg-40px h-lg-40px" id="kt_activities_toggle">
    <i class="ki-duotone ki-notification fs-1">
        <span class="path1"></span>
        <span class="path2"></span>
        <span class="path3"></span>
        <span class="path4"></span>
    </i>
    <!--begin::Badge for unread notifications-->
    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle p-2" id="unread_notifications">{{ $count }}</span>
    <!--end::Badge for unread notifications-->
</div>
<!--end::Drawer toggle-->
