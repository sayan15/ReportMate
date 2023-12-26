import { initializeApp } from "firebase/app";
import { getMessaging } from "firebase/messaging/sw";

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
const firebaseApp = initializeApp({
    apiKey: "AIzaSyDqRMx-El9rbrI0C6Vj8pimkhuTUDNkLQA",
    authDomain: "reportmate-54c39.firebaseapp.com",
    databaseURL: "https://reportmate-54c39-default-rtdb.firebaseio.com",
    projectId: "reportmate-54c39",
    storageBucket: "reportmate-54c39.appspot.com",
    messagingSenderId: "327443911451",
    appId: "1:327443911451:web:c5382fee80a52d1b1c79be",
    measurementId: "G-N8BMJ4RPZ1"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = getMessaging();
s