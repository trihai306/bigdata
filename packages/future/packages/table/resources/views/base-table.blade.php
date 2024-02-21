<div x-data="{ selectAll: false, selectedRows: [], data: {{ json_encode($data->toArray()['data']) }} }">
    <div class="card rounded rounded-5">
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
                        $wire.SelectedRows(selectedRows);
                        " class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                            <span class="ms-2">{{ __('future::messages.delete_all') }}</span>
                        </button>
                    </div>

                </div>
            </div>

        </div>
        <div class="card-body table-responsive table-loading py-4">
            <table class="table align-middle table-row-dashed gy-5">
                <div class="table-loading-message bg-light text-dark" wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> {{ __('future::messages.loading') }}...
                </div>
                <thead>
                <tr class="text-start text-muted fw-bold gs-0">
                    @if($this->canSelect())
                        <th>
                            <div>
                                <label>
                                    <input type="checkbox" class="form-check-input" x-bind:checked="selectAll"
                                           x-on:click="selectAll = !selectAll; selectedRows = selectAll ? (Array.isArray(data) ? data.map((item) => item.id) : []) : [];">
                                </label>
                            </div>
                        </th>
                    @endif
                    @foreach($this->defineColumns() as $column)
                        @if($column->visible)
                            <th style="
                           @if($column->width)
                                width: {{ $column->width }};
                                @endif
                             text-align: {{ $column->textAlign ?? 'left' }};"
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
                    @if($actions)
                        <th class="text-end min-w-100px">
                            {{ __('future::messages.actions') }}
                        </th>
                    @endif
                </tr>
                </thead>
                <tbody id="table-body" class="text-gray-600">
                @if($data)
                    @foreach($data as $item)
                        <tr wire:key="data-{{$item->id}}">
                            @if($this->canSelect())
                                <td>
                                    <div x-data="{ item: {{ json_encode($item) }} }">
                                        <label>
                                            <input type="checkbox" class="form-check-input" :value="item.id"
                                                   x-bind:checked="selectAll || selectedRows.includes(item.id)"
                                                   x-on:click="
                                          if(selectedRows.includes(item.id)) {
                                            selectAll = false;
                                            selectedRows = selectedRows.filter((id) => id !== item.id);
                                        } else {
                                            selectedRows.push(item.id);
                                        }
                                        if(data.length == selectedRows.length) {
                                            selectAll = true;
                                            return;
                                        }
                                        ">
                                        </label>
                                    </div>
                                </td>
                            @endif
                            @foreach($this->defineColumns() as $column)
                                @if($column->visible)
                                    <td>{!! $column->render($item) !!}</td>
                                @endif
                            @endforeach
                                @if($actions)
                                    @if($this->defineActions($item))
                                        <td class="text-end">
                                            {{ $this->defineActions($item) }}
                                        </td>
                                    @endif
                                @endif
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            <div class="row mt-2">
                <div
                    class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-start">
                    {{ __('future::messages.showing_from_to', ['first' => $data->firstItem(), 'last' => $data->lastItem(), 'total' => $data->total()]) }}
                </div>

                <div
                    class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-center">
                    <div class="dataTables_length">
                        <label>
                            <select class="form-select form-select-solid" wire:model.live.debounce.300ms="perPage">
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
        </div>
    </div>
    @if($forms)
        @foreach($forms as $form)
            @livewire($form['form'],[
    'id' => null,
    'title' => $form['label'],
    'name' => $form['name'],
])
        @endforeach
    @endif
    @include('future::table.filter')
</div>
