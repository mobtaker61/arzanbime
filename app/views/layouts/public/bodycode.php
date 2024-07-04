<script type="module">
    // Import the functions you need from the SDKs you need
    //import {initializeApp} from "https://www.gstatic.com/firebasejs/10.12.3/firebase-app.js";
    //import {getMessaging, getToken} from "https://www.gstatic.com/firebasejs/10.12.3/firebase-messaging.js";
    //import {getAnalytics} from "https://www.gstatic.com/firebasejs/10.12.3/firebase-analytics.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyCkeH7FmK0WRuH-jdn8PABTtxkkYlwE7UI",
        authDomain: "arzanbime.firebaseapp.com",
        projectId: "arzanbime",
        storageBucket: "arzanbime.appspot.com",
        messagingSenderId: "532740741849",
        appId: "1:532740741849:web:8582c7312668cb0c593cc8",
        measurementId: "G-Q5WLDR1WW4"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const analytics = firebase.analytics();
    const messaging = firebase.messaging();

    // Request permission to send notifications
    messaging.requestPermission()
        .then(function() {
            console.log('Notification permission granted.');
            // Get the token
            return messaging.getToken({
                vapidKey: 'BF67snExbAKukiyj32dVrstE16NomXfL00JkZvuYy1Ugs5MUN2-CBP33RJ4jiuRkI_duC9cUWecTGlX71fr7NYo'
            });
        })
        .then(function(token) {
            console.log('FCM Token:', token);
            // Save the token to your server/database
            saveTokenToServer(token);
        })
        .catch(function(err) {
            console.log('Unable to get permission to notify.', err);
        });

    function saveTokenToServer(token) {
        // Send the token to the server
        fetch('/save-token', {
            method: 'POST',
            headers: {'Content-Type': 'application/json',},
            body: JSON.stringify({token: token}),
        });
    }

    messaging.onMessage((payload) => {
        console.log('Message received. ', payload);
        // Customize notification here
        const notificationTitle = payload.notification.title;
        const notificationOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon
        };

        if (Notification.permission === 'granted') {
            new Notification(notificationTitle, notificationOptions);
        }
    });
</script>