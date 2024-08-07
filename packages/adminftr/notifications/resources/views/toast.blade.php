<div x-data="toastData()" class="toast position-absolute  end-0" style="z-index: 9999999;top: 60px" role="alert"
     aria-live="assertive"
     aria-atomic="true" :class="{ 'show': showToast, 'bg-dark': isDarkTheme }">
    <div class="toast-header">
        <span class="avatar avatar-xs me-2">
            <i class="fa fa-info-circle"></i>
        </span>
        <strong class="me-auto" x-text="title"></strong>
        <small x-text="time"></small>
        <button type="button" class="ms-2 btn-close" @click="hide()" aria-label="Close"></button>
    </div>
    <div class="toast-body" x-text="message">
    </div>
</div>

<script>
    function toastData() {
        return {
            showToast: false,
            isDarkTheme: document.body.dataset.bsTheme === 'dark',
            title: '',
            time: '',
            message: '',
            progress: 0,
            intervalId: null,
            show(title, time, message) {
                this.title = title;
                this.time = time;
                this.message = message;
                this.showToast = true;
            },
            hide() {
                this.showToast = false;
                this.progress = 0;
                if (this.intervalId) {
                    clearInterval(this.intervalId);
                    this.intervalId = null;
                }
            },
            init() {
                window.Echo.private(`App.Models.User.{{ auth()->id() }}`)
                    .notification((notification) => {
                        if (notification.type === 'App\\Notifications\\UserNotification') {
                            notification.time = new Date().toLocaleTimeString();
                            window.Livewire.dispatch('reloadNotification')
                            this.show(notification.title, notification.time, notification.content);
                        }
                    });
                window.Livewire.on('notification', (e) => {
                    const {title, time, message} = e[0];
                    this.show(title, time, message);
                });
            }
        }
    }
</script>
