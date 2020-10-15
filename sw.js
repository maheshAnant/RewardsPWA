var cacheName = 'V1';
var filesToCache = [
  'css/style.css'
];

/* Start the service worker and cache all of the app's content */
self.addEventListener('install', function(e) {
  e.waitUntil(
    caches
    .open(cacheName)
    .then(cache=>{
      cache.addAll(filesToCache);
    })
    .then(()=>self.skipWaiting())
  );
});

/* Serve cached content when offline */
/*self.addEventListener('fetch', function(e) {
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});*/


/* Activate event */
self.addEventListener('activate', function(e) {
    console.log("service worker activated")
    e.waitUntil(
       caches.keys().then(cacheNames => {
        return Promise.all(
          cacheNames.map(cache =>{
            if(cache!=cacheName){
               console.log("servie cklearing cache")
               return caches.delete(cache)   
            }
          })
        )  
      })
    );
});


// Call fetch event 
self.addEventListener('fetch',e=>{
   console.log("service worker fetching");
   e.respondWith(
      fetch(e.request).catch(()=>caches.match(e.request))
   )
});