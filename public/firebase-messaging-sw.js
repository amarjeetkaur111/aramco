importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-messaging.js",);
// For an optimal experience using Cloud Messaging, also add the Firebase SDK for Analytics.
importScripts("https://www.gstatic.com/firebasejs/7.16.1/firebase-analytics.js",);



firebase.initializeApp({
    apiKey: "AIzaSyDneaAmJNSXYoVVzONYvS-EiwKoFhJBcjs",
    authDomain: "aramco-a2d38.firebaseapp.com",
    projectId: "aramco-a2d38",
    storageBucket: "aramco-a2d38.appspot.com",
    messagingSenderId: "288186139124",
    appId: "1:288186139124:web:3191e68d89853bb16039a1",
    measurementId: "G-8XEB62CP7W"
});

// const messaging = firebase.messaging();
// messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
//     return self.registration.showNotification(title,{body,icon});
// });

const messaging = firebase.messaging();
// const messaging = getMessaging(firebase);
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});
