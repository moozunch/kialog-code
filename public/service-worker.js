importScripts("https://js.pusher.com/beams/service-worker.js");

self.addEventListener('push', function(event) {
  const data = event.data.json();
  const options = {
    body: data.notification.body,
    icon: '/path/to/icon.png',
    data: {
      url: data.notification.deep_link
    }
  };
  event.waitUntil(
    self.registration.showNotification(data.notification.title, options)
  );
});

self.addEventListener('notificationclick', function(event) {
  event.notification.close();
  event.waitUntil(
    clients.openWindow(event.notification.data.url)
  );
});
