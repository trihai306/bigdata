import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import Alpine from 'alpinejs';
import ClipboardJS from "clipboard";
import intersect from '@alpinejs/intersect'

Alpine.plugin(intersect)
window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY??'app-key',
    wsHost:import.meta.env.VITE_PUSHER_HOST?? '127.0.0.1',
    wsPort: import.meta.env.VITE_PUSHER_PORT??'',
    wssPort: import.meta.env.VITE_PUSHER_PORT??'',
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? "mt1",
    forceTLS: false,
    encrypted: true,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
});

// Instantiate clipboard
var clipboard = new ClipboardJS('.btn-copy');

clipboard.on('success', function(e) {
    e.clearSelection();
});

clipboard.on('error', function(e) {
});
