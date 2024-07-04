<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.3/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.12.3/firebase-analytics.js";
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
</script>