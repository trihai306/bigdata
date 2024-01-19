<div class="form-selectgroup">
    @foreach($options as $value => $label)
        <label class="form-selectgroup-item">
            <input type="checkbox" wire:model="data.{{ $name }}" name="selectgroup" value="{{ $value }}" class="selectgroup-input">
            <span class="form-selectgroup-label">{{$label}}</span>
        </label>
    @endforeach
</div>
