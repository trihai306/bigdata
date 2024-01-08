<div>
    <div class="card" wire:ignore.self>
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 d-flex justify-content-between">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <label>
                        <input type="text" class="form-control form-control-solid w-250px ps-13"
                               wire:model.live="search"
                               placeholder="Tìm kiếm"/>
                        <span class="input-icon-addon">
                              <div class="spinner-border spinner-border-sm text-secondary" wire:loading
                                   wire:target="search" role="status"></div>
                                  <svg xmlns="http://www.w3.org/2000/svg" wire:loading.class="d-none"
                                       wire:target="search" class="icon" width="24" height="24"
                                       viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                       stroke-linecap="round" stroke-linejoin="round"><path stroke="none"
                                                                                            d="M0 0h24v24H0z"
                                                                                            fill="none"></path><path
                                          d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path><path
                                          d="M21 21l-6 -6"></path></svg>
                                </span>
                    </label>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                @if($selectedRows == [])
                    <div class="d-flex flex-column flex-md-row justify-content-end btn-group">
                        <a wire:click.prevent="resetTable" class="btn btn-primary">
                            <i class="fa fa-redo-alt"></i> <span class="ms-2">Reset</span>
                        </a>
                        <a class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#modal_import">
                            <span class="ms-2">Import file</span>
                        </a>
                        <!--begin::Export-->
                        <a class="btn btn-light-primary" data-bs-toggle="modal"
                           data-bs-target="#modal_export">
                            Export dữ liệu
                        </a>
                        <!--end::Export-->
                        <!--begin::Add user-->
                        @if($this->canCreate())
                            @if($urlCreate)
                                <a class="btn  btn-light-primary" href="{{route($urlCreate) }}">
                                    <i class="ki-duotone ki-plus fs-2"></i>Thêm dữ liệu
                                </a>
                            @endif
                        @endif

                        <button class="btn  btn-light-primary " data-bs-toggle="modal"
                                data-bs-target="#filter">
                            <i class="ki-duotone ki-filter fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> Lọc
                        </button>
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="ki-duotone ki-abstract-30 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                        <div class="dropdown-menu">
                            @foreach($this->defineColumns() as $column)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           wire:model.live="columnVisibility.{{ $column->name }}"
                                           id="{{ $column->name }}" {{ $column->visible ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $column->name }}">
                                        {{ $column->label }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <!--end::Add user-->
                    </div>
                @else
                    <div class="d-flex flex-column flex-md-row justify-content-end btn-group">
                        <button wire:click.prevent="$dispatch('swalConfirm', {
                    message: 'Are you sure you want to delete all this permission?',
                    nameMethod: 'deleteSelect'
                })" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <span class="ms-2">Xóa tất cả</span>
                        </button>
                    </div>
                @endif
                <!--end::Toolbar-->
                <!--begin::Modal - Adjust Balance-->

                <!--end::Modal - New Card-->
            </div>

            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body table-responsive table-loading py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed gy-5">
                <div class="table-loading-message bg-light text-dark" wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> Đang tải...
                </div>
                <thead>
                <tr class="text-start text-muted fw-bold gs-0">
                    @if($this->canSelect())
                        <th>
                            <label>
                                <input type="checkbox" class="form-check-input" wire:model.live="selectAll"
                                       wire:change="selectAllData">
                            </label>
                        </th>
                    @endif
                    @foreach($this->defineColumns() as $column)
                        @if($column->visible)
                            <th style="width: {{ $column->width }}; text-align: {{ $column->textAlign }};"
                                wire:click="sortBy('{{ $column->name }}')" style="cursor: pointer;">
                                {{ $column->label }}
                                @if($column->sortable)
                                    @if($sortColumn == $column->name)
                                        {!! $sortDirection == 'asc' ? '&#9650;' : '&#9660;' !!}
                                    @endif
                                @endif
                            </th>
                        @endif
                    @endforeach
                    <th class="text-end min-w-100px">
                        Hành động
                    </th>
                </tr>
                </thead>
                <tbody id="table-body" class="text-gray-600">
                @if($data)
                    @foreach($data as $item)
                        <tr>
                            @if($this->canSelect())
                                <td>
                                    <label>
                                        <input type="checkbox" class="form-check-input" value="{{ $item->id }}"
                                               wire:model="selectedRows" wire:change="SelectedRows">
                                    </label>
                                </td>
                            @endif
                            @foreach($this->defineColumns() as $column)
                                @if($column->visible)
                                    <td>{!! $column->render($item) !!}</td>
                                @endif
                            @endforeach
                            @if($this->defineActions($item))
                                <td class="text-end">
                                    {{ $this->defineActions($item) }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <div class="row mt-2">
                <div
                    class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-start">
                    Đang hiển thị từ {{ $data->firstItem() }} đến {{ $data->lastItem() }} trong tổng
                    số {{ $data->total() }} bản ghi
                </div>

                <div
                    class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-center">
                    <div class="dataTables_length" wire:model.live="perPage">
                        <label>
                            <select class="form-select form-select-solid">
                                @foreach($this->pages as $page)
                                    @if($page == $perPage)
                                        <option value="{{ $page }}" selected>{{ $page }}</option>
                                    @else
                                        <option value="{{ $page }}">{{ $page }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-end">
                    {{
                       $data->links(data: ['scrollTo' => false])
                    }}
                </div>
            </div>

            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    @include('future::livewire.table.export')
    @include('future::livewire.table.import')
    @include('future::livewire.table.filter')
</div>
