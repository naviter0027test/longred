$(document).ready(function() {
    if(location.protocol == "https:") {
        var firebaseConfig = {
            apiKey: "AIzaSyCdyxuNQitr6c7aZ_wTe1mPFuHiVuAqwRc",
            authDomain: "web-send-msg-test.firebaseapp.com",
            projectId: "web-send-msg-test",
            storageBucket: "web-send-msg-test.appspot.com",
            messagingSenderId: "282801977342",
            appId: "1:282801977342:web:c3fb53d9353a75a15a72af",
            measurementId: "G-EG013LZN77"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();
        const messaging = firebase.messaging();
        var deviceToken = sessionStorage.getItem('deviceToken');
        if(deviceToken == null || deviceToken == '') {
            messaging.requestPermission().then(function () {
                console.log('have permission');
                return messaging.getToken();
            }).then(function(token) {
                console.log(token);
                var postData = {
                    'appleToken': token,
                    'tokenMode': 2
                };
                console.log(postData);
                $.post('/account/apple-token/set', postData, function(data) {
                    console.log(data);
                    if(data['status'] == true) {
                        window.sessionStorage.setItem('deviceToken', token)
                    }
                    else
                        alert('FCM set err:'+data['message']);
                });
            }).catch(function(err) {
                console.log('err', err);
            });
        }

        messaging.onMessage(function (payload) {
            console.log('on message', payload);
        });
    }
    else
        console.log('not https');
});
