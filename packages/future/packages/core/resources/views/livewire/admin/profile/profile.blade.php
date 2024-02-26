<div class="col-12 col-md-9 d-flex flex-column">
    <form>
        <div class="card-body">
            <h2 class="mb-4">{{ __('future::profile.my_account') }}</h2>
            <h3 class="card-title">{{ __('future::profile.profile_details') }}</h3>
            <div class="row align-items-center">
                <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url({{asset('static/avatars/001f.jpg')}})"></span>
                </div>
                <div class="col-auto"><a href="#" class="btn">
                        {{ __('future::profile.change_avatar') }}
                    </a></div>
                <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                        {{ __('future::profile.delete_avatar') }}
                    </a></div>
            </div>
            <h3 class="card-title mt-4">{{ __('future::profile.profile') }}</h3>
            <div class="row g-3">
                <div class="col-md">
                    <div class="form-label">{{ __('future::profile.name') }}</div>
                    <input type="text" class="form-control" value="Tabler">
                </div>
                <div class="col-md">
                    <div class="form-label">{{ __('future::profile.id') }}</div>
                    <input type="text" class="form-control" value="560afc32">
                </div>
                <div class="col-md">
                    <div class="form-label">{{ __('future::profile.location') }}</div>
                    <input type="text" class="form-control" value="Peimei, China">
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('future::profile.email') }}</h3>
            <p class="card-subtitle">{{ __('future::profile.email_subtitle') }}</p>
            <div>
                <div class="row g-2">
                    <div class="col-auto">
                        <input type="text" class="form-control w-auto" value="paweluna@howstuffworks.com">
                    </div>
                    <div class="col-auto"><a href="#" class="btn">
                            {{ __('future::profile.change') }}
                        </a></div>
                </div>
            </div>
            <h3 class="card-title mt-4">{{ __('future::profile.password') }}</h3>
            <p class="card-subtitle">{{ __('future::profile.password_subtitle') }}</p>
            <div>
                <a href="#" class="btn">
                    {{ __('future::profile.set_new_password') }}
                </a>
            </div>
            <h3 class="card-title mt-4">{{ __('future::profile.public_profile') }}</h3>
            <p class="card-subtitle">{{ __('future::profile.public_profile_subtitle') }}</p>
            <div>
                <label class="form-check form-switch form-switch-lg">
                    <input class="form-check-input" type="checkbox">
                    <span class="form-check-label form-check-label-on">{{ __('future::profile.currently_visible') }}</span>
                    <span class="form-check-label form-check-label-off">{{ __('future::profile.currently_invisible') }}</span>
                </label>
            </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
            <div class="btn-list justify-content-start">
                <button type="submit" class="btn btn-primary">
                    {{ __('future::profile.submit') }}
                </button>
            </div>
        </div>
    </form>
</div>
