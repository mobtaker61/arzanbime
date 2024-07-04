<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.3/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.3/firebase-analytics.js";
    import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.12.3/firebase-messaging.js";
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
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    // Get registration token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    const messaging = getMessaging();
    getToken(messaging, {vapidKey: 'BF67snExbAKukiyj32dVrstE16NomXfL00JkZvuYy1Ugs5MUN2-CBP33RJ4jiuRkI_duC9cUWecTGlX71fr7NYo'}).then((currentToken) => {
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
</script>