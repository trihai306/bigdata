@extends('core::layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::Row-->
        <div class="row g-6 mb-5 g-xl-3">
            <!-- Loop through modules -->
            @foreach($modules as $module)
                <!--begin::Col-->
                <div class="col-md-6 col-xl-4">
                    <!--begin::Card-->
                    <div class="card border-hover-primary h-100">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-9">
                            <!--begin::Card Title-->
                            <div class="card-title m-0">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px w-50px">
                                    <!-- You can add an icon if you have one for your module -->
                                    <i class="fa fa-window-maximize fa-lg"  aria-hidden="true"></i>
                                </div>
                                <!--end::Avatar-->
                            </div>
                            <!--end::Card Title-->
                            <!--begin::Card toolbar-->
                            <div class="card-actions">
                                <span class="badge bg-primary fw-bold me-auto px-4 py-3">{{ $moduleStatuses[$module->getName()] }}</span>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Name-->
                            <div class="fw-bold">{{ $module->getName() }}</div>
                            <!--end::Name-->
                            <!--begin::Description-->
                            <p class="fw-semibold mt-1 mb-7">{{ $module->getDescription() }}</p> <!-- Please replace 'getDescription' with actual method if different -->
                            <!--end::Description-->

                            <!--begin::Toggle Module Form-->
                            @if($module->getName() != 'Core'  && $module->getName() != 'Dashboard')
                                <form method="POST" action="{{ route('admin.modules.toggle', $module->getName()) }}">
                                    @csrf
                                    <input type="hidden" name="module_name" value="{{ $module->getName() }}">
                                    <button type="submit" class="btn {{ $moduleStatuses[$module->getName()] == 'Enabled' ? 'btn-success' : 'btn-danger' }}">
                                        {{ $moduleStatuses[$module->getName()] == 'Enabled' ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                            @else
                                <span class="badge badge-info">{{ $module->getName() }} Module không thể tắt</span>
                            @endif
                            <!--end::Toggle Module Form-->

                            <!-- You can add more module information here -->

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
            @endforeach

        </div>
        <!--end::Row-->
        <!--begin::Pagination-->
        <div class="d-flex flex-stack flex-wrap pt-10 ">
            <div class="fw-semibold text-gray-700 ">Showing {{ $modules->firstItem() }} to {{ $modules->lastItem() }} of {{ $modules->total() }} entries</div>
            <!--begin::Pages-->
            {{ $modules->links() }} <!-- This is Laravel's pagination links. -->
            <!--end::Pages-->
        </div>
        <!--end::Pagination-->
    </div>
@endsection
