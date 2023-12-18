<div class="card-body">
    <h2 class="h2 text-center mb-4">{{ __('auth.login_to_your_account') }}</h2>
    <form wire:submit="login" autocomplete="off" >
        <div class="mb-3">
            <label class="form-label">{{ __('auth.email_address') }}</label>
            <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{__('auth.your_email_address') }}" autocomplete="off">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
            <label class="form-label">
                {{ __('auth.password') }}
                <span class="form-label-description">
                    <a href="./forgot-password.html">{{ __('auth.i_forgot_password') }}</a>
                  </span>
            </label>
            <div class="mb-3">
                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('auth.your_password') }}" autocomplete="off">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-2">
            <label class="form-check">
                <input type="checkbox" class="form-check-input"/>
                <span class="form-check-label">{{ __('auth.remember_me_on_this_device') }}</span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">{{ __('auth.sign_in') }}</button>
        </div>
    </form>
</div>
