


// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging } from "firebase/messaging/sw";
import { getDatabase } from "firebase/database";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDqRMx-El9rbrI0C6Vj8pimkhuTUDNkLQA",
  authDomain: "reportmate-54c39.firebaseapp.com",
  databaseURL: "https://reportmate-54c39-default-rtdb.firebaseio.com",
  projectId: "reportmate-54c39",
  storageBucket: "reportmate-54c39.appspot.com",
  messagingSenderId: "327443911451",
  appId: "1:327443911451:web:c5382fee80a52d1b1c79be",
  measurementId: "G-N8BMJ4RPZ1"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Initialize Firebase services
const database = getDatabase(app);
const messaging = getMessaging(app);

// Export the initialized services
export { database, messaging };




