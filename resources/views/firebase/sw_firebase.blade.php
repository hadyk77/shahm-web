importScripts('//www.gstatic.com/firebasejs/8.6.1/firebase-app.js');
importScripts('//www.gstatic.com/firebasejs/8.6.1/firebase-messaging.js');

@include('firebase.init_firebase')

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
const notificationTitle = payload.notification.title;
const notificationOptions = {
body: payload.notification.body,
icon: payload.notification.icon,
};
return self.registration.showNotification(notificationTitle,notificationOptions);
});
