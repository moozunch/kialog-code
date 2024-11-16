<!-- Notification Scripts -->
<script>
  const beamsClient = new PusherPushNotifications.Client({
    instanceId: '{{ env('PUSHER_BEAMS_INSTANCE_ID') }}' // Replace with your Beams Instance ID
  });

  beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('general')) // Subscribe to an interest group
    .then(() => console.log('Beams setup successful!'))
    .catch(err => console.error('Beams setup failed:', err));

  // Register the service worker
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker
      .register('/service-worker.js')
      .then(registration => {
        console.log('Service Worker registered with scope:', registration.scope);

        beamsClient.onNotificationReceived = ({ payload }) => {
          const { title, body, deep_link } = payload.notification;
          showCustomNotification(title, body, null, deep_link);
        };
      })
      .catch(error => console.error('Service Worker registration failed:', error));
  } else {
    console.error('Service Worker not supported in this browser.');
  }

  function showCustomNotification(title, body, icon, link) {
    const options = {
      body: body,
      icon: icon || '/path/to/default-icon.png', // Replace with your default icon path
      data: { url: link },
    };

    if (Notification.permission === 'granted') {
      navigator.serviceWorker.getRegistration().then(reg => {
        if (reg) {
          reg.showNotification(title, options);
        }
      });
    }
  }

  // Request notification permissions
  if (Notification.permission !== 'granted') {
    Notification.requestPermission().then(permission => {
      if (permission === 'granted') {
        console.log('Notification permission granted.');
      } else {
        console.error('Notification permission denied.');
      }
    });
  }
</script>
