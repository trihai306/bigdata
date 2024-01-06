<div>
    <form wire:submit.prevent="save" wire:ignore>
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-end">
                <button type="button" class="btn btn-light me-2" onclick="history.back()">
                    <i class="fas fa-arrow-left"></i> {{ __('forms.back') }}
                </button>
                <button type="submit" class="btn btn-primary me-2">
                    <span class="indicator-label" wire:loading.remove> <i class="fas fa-save"></i> {{ __('forms.save') }}</span>
                    <span class="indicator-progress" wire:loading>{{ __('forms.please_wait') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>

                </button>
                <button type="reset" class="btn btn-secondary ">
                    <i class="fas fa-undo"></i> {{ __('forms.reset') }}
                </button>
            </div>
        </div>
        @foreach($inputs as $input)
            {!! $input->render() !!}
        @endforeach

    </form>
</div>
