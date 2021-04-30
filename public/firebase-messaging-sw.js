importScripts('https://www.gstatic.com/firebasejs/8.4.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.4.2/firebase-messaging.js');

var firebaseConfig = {
    apiKey: "AIzaSyCdyxuNQitr6c7aZ_wTe1mPFuHiVuAqwRc",
    authDomain: "web-send-msg-test.firebaseapp.com",
    projectId: "web-send-msg-test",
    storageBucket: "web-send-msg-test.appspot.com",
    messagingSenderId: "282801977342",
    appId: "1:282801977342:web:c3fb53d9353a75a15a72af",
    measurementId: "G-EG013LZN77"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();
