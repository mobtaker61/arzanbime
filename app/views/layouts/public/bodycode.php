<script type="module">
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


    getToken(messaging, {
        vapidKey: 'BF67snExbAKukiyj32dVrstE16NomXfL00JkZvuYy1Ugs5MUN2-CBP33RJ4jiuRkI_duC9cUWecTGlX71fr7NYo'
    }).then((currentToken) => {
        if (currentToken) {
            // Send the token to your server and update the UI if necessary
            // ...
        } else {
            // Show permission request UI
            console.log('No registration token available. Request permission to generate one.');
            // ...
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        // ...
    });

    function requestPermission() {
        messaging.requestPermission()
            .then(() => messaging.getToken())
            .then((token) => {
                console.log('Token received: ', token);
                // Send the token to your server for further processing
                // You can save the token to the user's profile in the database
            })
            .catch((err) => {
                console.error('Unable to get permission to notify.', err);
            });
    }

    // Call the requestPermission function
    requestPermission();

</script>