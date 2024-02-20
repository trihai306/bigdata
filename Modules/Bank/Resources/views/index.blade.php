@extends('core::layouts.master')
@section('style')
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
@endsection
@section('content')
    <link href="https://fonts.cdnfonts.com/css/calvin" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <div id="kt_app_content" class="app-content">
        <div class="d-flex flex-column-fluid align-items-start container-xxl asdas">
            <div class="content flex-row-fluid">
                <div class="row gx-6 gx-xl-9">
                    <div class="col-lg-6 col-xxl-4">
                        <!--begin::Card-->
                        <div class="card h-100">
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Heading-->
                                <div class="fs-2hx fw-bold">{{ $bankCount }}</div>
                                <div class="fs-4 fw-semibold text-gray-400 mb-7">Tổng ngân hàng hiện tại</div>
                                <!--end::Heading-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-wrap">

                                    <!--begin::Labels-->
                                    <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                            <div class="bullet bg-primary me-3"></div>
                                            <div class="text-gray-400">Enabled</div>
                                            <div class="ms-auto fw-bold text-gray-700">{{ $bankCount }}</div>
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                            <div class="bullet bg-success me-3"></div>
                                            <div class="text-gray-400">Disabled</div>
                                            <div class="ms-auto fw-bold text-gray-700">0</div>
                                        </div>
                                        <!--end::Label-->

                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <div class="col-lg-6 col-xxl-4">
                        <!--begin::Budget-->
                        <div class="card h-100">
                            <div class="card-body p-9">
                                <div class="fs-2hx fw-bold">$3,290.00</div>
                                <div class="fs-4 fw-semibold text-gray-400 mb-7">Project Finance</div>
                                <div class="fs-6 d-flex justify-content-between mb-4">
                                    <div class="fw-semibold">Avg. Project Budget</div>
                                    <div class="d-flex fw-bold">
                                        <i class="ki-duotone ki-arrow-up-right fs-3 me-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>$6,570</div>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="fs-6 d-flex justify-content-between my-4">
                                    <div class="fw-semibold">Lowest Project Check</div>
                                    <div class="d-flex fw-bold">
                                        <i class="ki-duotone ki-arrow-down-left fs-3 me-1 text-danger">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>$408</div>
                                </div>
                                <div class="separator separator-dashed"></div>
                                <div class="fs-6 d-flex justify-content-between mt-4">
                                    <div class="fw-semibold">Ambassador Page</div>
                                    <div class="d-flex fw-bold">
                                        <i class="ki-duotone ki-arrow-up-right fs-3 me-1 text-success">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>$920</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Budget-->
                    </div>
                    <div class="col-lg-6 col-xxl-4">
                        <!--begin::Clients-->
                        <div class="card h-100">
                            <div class="card-body p-9">
                                <!--begin::Heading-->
                                <div class="fs-2hx fw-bold">49</div>
                                <div class="fs-4 fw-semibold text-gray-400 mb-7">Our Clients</div>
                                <!--end::Heading-->
                                <!--begin::Users group-->
                                <div class="symbol-group symbol-hover mb-9">
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                                        <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                                    </div>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                                        <img alt="Pic" src="{{asset('assets/media/avatars/300-11.jpg')}}" />
                                    </div>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michelle Swanston">
                                        <img alt="Pic" src="{{asset('assets/media/avatars/300-7.jpg')}}" />
                                    </div>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Francis Mitcham">
                                        <img alt="Pic" src="{{asset('assets/media/avatars/300-20.jpg')}}" />
                                    </div>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                                        <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                                    </div>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                                        <img alt="Pic" src="{{asset('assets/media/avatars/300-2.jpg')}}" />
                                    </div>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                                        <span class="symbol-label bg-info text-inverse-info fw-bold">P</span>
                                    </div>
                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
                                        <img alt="Pic" src="{{asset('assets/media/avatars/300-12.jpg')}}" />
                                    </div>
                                    <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                                        <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+42</span>
                                    </a>
                                </div>
                                <!--end::Users group-->
                                <!--begin::Actions-->
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">All Clients</a>
                                    <a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_users_search">Invite New</a>
                                </div>
                                <!--end::Actions-->
                            </div>
                        </div>
                        <!--end::Clients-->
                    </div>
                </div>
                <div class="d-flex flex-wrap flex-stack my-5">
                    <!--begin::Heading-->
                    <h2 class="fs-2 fw-semibold my-2">Banks
                        <span class="fs-6 text-gray-400 ms-1">by Status</span></h2>
                    <!--end::Heading-->

                </div>
                <div class="row g-6 g-xl-9">
                    <div class="col-md-6 col-xl-4">
                        <!--begin::Card-->
                        <a href="{{ route('banks.nn1') }}" class="card border-hover-primary">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-9">
                                <!--begin::Card Title-->
                                <div class="card-title m-0">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px w-50px bg-light">
                                        <!-- You can add an image if you have one for your module -->
                                        <img src="{{asset('assets/media/svg/brand-logos/plurk.svg')}}" alt="image" class="p-3" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::Card Title-->
                                <!--begin::Card toolbar-->
                            {{--                    <div class="card-toolbar">--}}
                            {{--                        <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">{{ $moduleStatuses[$module->getName()] }}</span>--}}
                            {{--                    </div>--}}
                            <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Name-->
                                <div class="fs-3 fw-bold text-dark">Remitly</div>
                                <!--end::Name-->
                                <!--begin::Description-->
                                <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"></p>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </a>
                        <!--end::Card-->
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <!--begin::Card-->
                        <a href="{{ route('banks.nn2') }}" class="card border-hover-primary">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-9">
                                <!--begin::Card Title-->
                                <div class="card-title m-0">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px w-50px bg-light">
                                        <!-- You can add an image if you have one for your module -->
                                        <img src="{{asset('assets/media/svg/brand-logos/plurk.svg')}}" alt="image" class="p-3" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::Card Title-->
                                <!--begin::Card toolbar-->
                            {{--                    <div class="card-toolbar">--}}
                            {{--                        <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">{{ $moduleStatuses[$module->getName()] }}</span>--}}
                            {{--                    </div>--}}
                            <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Name-->
                                <div class="fs-3 fw-bold text-dark">Ria</div>
                                <!--end::Name-->
                                <!--begin::Description-->
                                <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"></p>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </a>
                        <!--end::Card-->
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <!--begin::Card-->
                        <a href="{{ route('banks.nn3') }}" class="card border-hover-primary">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-9">
                                <!--begin::Card Title-->
                                <div class="card-title m-0">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px w-50px bg-light">
                                        <!-- You can add an image if you have one for your module -->
                                        <img src="{{asset('assets/media/svg/brand-logos/plurk.svg')}}" alt="image" class="p-3" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::Card Title-->
                                <!--begin::Card toolbar-->
                            {{--                    <div class="card-toolbar">--}}
                            {{--                        <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">{{ $moduleStatuses[$module->getName()] }}</span>--}}
                            {{--                    </div>--}}
                            <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Name-->
                                <div class="fs-3 fw-bold text-dark">Send Wave</div>
                                <!--end::Name-->
                                <!--begin::Description-->
                                <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"></p>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </a>
                        <!--end::Card-->
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <!--begin::Card-->
                        <a href="{{ route('banks.nn4') }}" class="card border-hover-primary">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-9">
                                <!--begin::Card Title-->
                                <div class="card-title m-0">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px w-50px bg-light">
                                        <!-- You can add an image if you have one for your module -->
                                        <img src="{{asset('assets/media/svg/brand-logos/plurk.svg')}}" alt="image" class="p-3" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::Card Title-->
                                <!--begin::Card toolbar-->
                            {{--                    <div class="card-toolbar">--}}
                            {{--                        <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">{{ $moduleStatuses[$module->getName()] }}</span>--}}
                            {{--                    </div>--}}
                            <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Name-->
                                <div class="fs-3 fw-bold text-dark">Westen Union</div>
                                <!--end::Name-->
                                <!--begin::Description-->
                                <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"></p>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </a>
                        <!--end::Card-->
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <!--begin::Card-->
                        <a href="{{ route('banks.nn5') }}" class="card border-hover-primary">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-9">
                                <!--begin::Card Title-->
                                <div class="card-title m-0">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px w-50px bg-light">
                                        <!-- You can add an image if you have one for your module -->
                                        <img src="{{asset('assets/media/svg/brand-logos/plurk.svg')}}" alt="image" class="p-3" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::Card Title-->
                                <!--begin::Card toolbar-->
                            {{--                    <div class="card-toolbar">--}}
                            {{--                        <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">{{ $moduleStatuses[$module->getName()] }}</span>--}}
                            {{--                    </div>--}}
                            <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Name-->
                                <div class="fs-3 fw-bold text-dark">Ngân hàng 5</div>
                                <!--end::Name-->
                                <!--begin::Description-->
                                <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"></p>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </a>
                        <!--end::Card-->
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <!--begin::Card-->
                        <a href="{{ route('banks.techcombank') }}" class="card border-hover-primary">
                            <!--begin::Card header-->
                            <div class="card-header border-0 pt-9">
                                <!--begin::Card Title-->
                                <div class="card-title m-0">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-50px w-50px bg-light">
                                        <!-- You can add an image if you have one for your module -->
                                        <img src="{{asset('assets/media/svg/brand-logos/plurk.svg')}}" alt="image" class="p-3" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::Card Title-->
                                <!--begin::Card toolbar-->
                            {{--                    <div class="card-toolbar">--}}
                            {{--                        <span class="badge badge-light-primary fw-bold me-auto px-4 py-3">{{ $moduleStatuses[$module->getName()] }}</span>--}}
                            {{--                    </div>--}}
                            <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Name-->
                                <div class="fs-3 fw-bold text-dark">Techcombank</div>
                                <!--end::Name-->
                                <!--begin::Description-->
                                <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"></p>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </a>
                        <!--end::Card-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@stack('script')
@endsection


