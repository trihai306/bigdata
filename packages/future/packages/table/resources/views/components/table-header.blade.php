<div class="card-header border-0 pt-6 d-flex justify-content-between">
    <div class="card-title">
        <div class="d-flex align-items-center position-relative my-1">
            @include('future::components.search')
        </div>
    </div>
    <div class="card-toolbar">
        <div class="d-flex flex-column flex-md-row justify-content-end ">
            <div x-show="selectedRows.length == 0" class="btn-group">
                @foreach($headerActions as $headerAction)
                    {{ $headerAction->render()}}
                @endforeach
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
                                   wire:model.live.debounce.300ms="columnVisibility.{{ $column->name }}"
                                {{ $column->visible ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $column->name }}">
                                {{ $column->label }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div x-show="selectedRows.length > 0" class="btn-group" style="display: none">
                <button x-on:click="
                $wire.SelectedRows(selectedRows,'deletes','bạn có chắc chắn muốn xóa?');
                " class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                    <span class="ms-2">{{ __('future::messages.delete_all') }}</span>
                </button>
            </div>
        </div>
    </div>
</div>
