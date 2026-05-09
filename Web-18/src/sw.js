const CACHE_NAME = 'web18-worker-cache';

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => cache.addAll([
            '/internal/archive-note.txt'
        ])).then(() => self.skipWaiting())
    );
});

self.addEventListener('activate', event => {
    event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', event => {
    const url = new URL(event.request.url);

    if (url.pathname === '/daily-message.txt') {
        event.respondWith(new Response(
            '今日公告：一切正常，沒有任何額外線索。',
            { headers: { 'Content-Type': 'text/plain; charset=utf-8' } }
        ));
    }
});