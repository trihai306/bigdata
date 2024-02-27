<div>
    <div class="card rounded rounded-5" x-data="tableData" @reset-select.window="selectAll = false; selectedRows = [];">
        @include('future::components.table-header')
        <div class="card-body table-responsive table-loading py-4">
            <table class="table align-middle table-row-dashed gy-5">
                <div class="table-loading-message bg-light text-dark" wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> {{ __('future::messages.loading') }}...
                </div>
                @include('future::components.table-head')
                @include('future::components.table-body')
            </table>
            @include('future::components.table-footer')
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

@script
<script>
    Alpine.data('tableData', () => ({
        selectAll: false,
        selectedRows: [],
        data: @json($data->toArray()['data']),
        updateSelectAll() {

            this.selectAll = !this.selectAll;
            if (this.selectAll) {
                this.selectedRows = this.data.map(item => item.id);
            } else {
                this.selectedRows = [];
            }
        },

        watchSelectedRows() {
            this.$watch('data', () => {
                this.selectedRows = [];
                this.selectAll = false;
            });
            this.$watch('selectedRows', () => {
                this.selectAll = this.data.length === this.selectedRows.length;
            });
        },

        init() {
            this.watchSelectedRows();
            this.data = @json($data->toArray()['data']);
        }
    }));
    Livewire.hook('morph.updated', ({el, component}) => {

    });
</script>
@endscript
