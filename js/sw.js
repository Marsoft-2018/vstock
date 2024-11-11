const CACHE_NAME = 'offline-cache-v1';
const urlsToCache = [
  '/complementos/js/axios.min.js',         // Ruta local de Axios
  '/complementos/js/bootstrap.min.js',// Ruta local de Bootstrap
  '/complementos/js/popper.min.js',// Ruta local de Bootstrap
  '/complementos/js/sweetalert2.min.js'// Ruta local de SweetAlert2
];

// Instalar y almacenar los archivos en caché
self.addEventListener('install', (event) => {
    event.waitUntil(
      caches.open('offline-cache-v1').then((cache) => {
        const filesToCache = [
          '/path/to/local/axios.js',
          '/path/to/local/bootstrap.min.css',
          '/path/to/local/sweetalert2.min.js'
        ];
  
        return Promise.all(filesToCache.map(file => {
          return cache.add(file).catch((error) => {
            console.error(`Falló el cacheo del archivo: ${file}`, error);
          });
        }));
      })
    );
  });
  

// Interceptar las solicitudes de red
self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      // Si el recurso está en la caché, lo devuelve
      if (response) {
        return response;
      }

      // Si no está en la caché, lo intenta obtener de la red
      return fetch(event.request).catch(() => {
        // Si no hay conexión, intenta servir archivos locales
        if (event.request.url.includes('axios')) {
          return caches.match('/path/to/local/axios.js');
        }
        if (event.request.url.includes('bootstrap')) {
          return caches.match('/path/to/local/bootstrap.min.css');
        }
        if (event.request.url.includes('sweetalert2')) {
          return caches.match('/path/to/local/sweetalert2.min.js');
        }
      });
    })
  );
});

// Actualizar caché cuando el contenido cambie
self.addEventListener('activate', (event) => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (!cacheWhitelist.includes(cacheName)) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
