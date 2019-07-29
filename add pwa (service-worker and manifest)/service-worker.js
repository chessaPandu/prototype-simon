const cacheName = 'cache-simon';
const filesToCache = [
  '.',
  'login.php',
  'css/style.css',
  'manifest.json',
  'images/favicon.ico',
  'images/touch/simon.png'
];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(cacheName)
    .then(function(cache) {
      return cache.addAll(filesToCache);
    })
  );
});

self.addEventListener('fetch', function(event) {
  if (event.request.method === 'GET') {
    event.respondWith(
      caches.match(event.request).then(function(response) {
        if (response) {
          return response;
        }
        return fetch(event.request).then(function(response) {
          return caches.open(cacheName).then(function(cache) {
            cache.put(event.request.url, response.clone());
            return response;
          });
        });
      })
    );
  }
});
// TODO SW-5 - delete outdated caches in the activate event listener
self.addEventListener('activate', function(event) {
  console.log('Activating new service worker...');

  var cacheWhitelist = [cacheName];

  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cacheName) {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});