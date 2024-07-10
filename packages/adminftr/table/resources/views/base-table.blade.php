<div x-data="tableData" @data="updateData()" @reset-select.window="selectAll = false; selectedRows = [];">
    @if ($this->defineWidgets())
        <div class="container-fuild">
            <div class="row row-cards">
                @foreach ($this->defineWidgets() as $widget)
                    {!! $widget->render() !!}
                @endforeach
            </div>
        </div>
    @endif
    @include('future::base.header')
    @include('future::base.filter')
    <div class="card rounded rounded-2" style="font-size: 12px">
        <div class="progress" wire:loading>
            <div class="progress-bar progress-bar-indeterminate bg-green" wire:loading></div>
        </div>
        @include('future::table-header')
        <div class="table-responsive table-loading py-0">
            <table class="table card-table table-vcenter align-middle table-row-dashed gy-5 base-table">
                @include('future::table-head')
                @include('future::table-body')
            </table>
        </div>
        @include('future::table-footer')
    </div>
    @if ($forms)
        @foreach ($forms as $form)
            @livewire($form['form'], ['id' => null, 'title' => $form['label'], 'name' => $form['name']])
        @endforeach
    @endif
</div>

@script
<script>
    Alpine.data('tableData', () => ({
        selectAll: false,
        selectedRows: [],
        data: [],
        length: 0,
        init() {
            this.updateData();
            this.$watch('selectedRows', () => this.syncSelectAll());
            $wire.on('reset-select', () => this.resetSelect());
        },
        updateSelectAll() {
            this.updateData()
            this.selectAll = !this.selectAll;
            if (this.selectAll) {
                this.selectedRows = this.data.map(item => item);
            } else {
                this.selectedRows = [];
            }
            this.selectedRows = this.selectAll ? [...this.data] : [];
        },
        updateData() {
            var checkboxes = document.querySelectorAll('.checkbox');
            this.data = Array.from(checkboxes).map(checkbox => checkbox.value);
            this.data = Array.from(document.querySelectorAll('.checkbox')).map(checkbox => checkbox.value);
        },

        syncSelectAll() {
            if (this.data) {
                this.selectAll = this.data.length === this.selectedRows.length;
                this.length = this.selectedRows.length;
            }
        },
        toggleSelection(id) {
            if (this.selectedRows.includes(id)) {
                this.selectedRows = this.selectedRows.filter(row => row !== id);
            } else {
                this.selectedRows.push(id);
            }
            this.syncSelectAll();
        },
        isChecked(id) {
            return this.selectAll || this.selectedRows.includes(id);
        },
        submitSelectedRows(name, type, title, description, nameMethod, labelYes = 'Yes', labelNo = 'No') {
            $wire.dispatch('comfirm', {
                name,
                type,
                title,
                message: description,
                nameMethod,
                labelYes,
                labelNo,
                params: this.selectedRows
            });
        },
        resetSelect() {
            this.selectedRows = [];
            this.selectAll = false;
        },
    }));
</script>
@endscript
