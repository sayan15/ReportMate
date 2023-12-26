
import { getMessaging, getToken } from "firebase/messaging";


$(document).ready(function(){
    initFirebaseMessagingRegistration();
    showAlert();
})

var key="BN7z12WZZq-wdTDhkmvN82p98pfqx6t2zG6-gOJSND0-XwdUu7r5LAs_FyD8oxhTAzQkZqdW9PYdbj6ZxrZe_4E";
function initFirebaseMessagingRegistration() {

    // Get registration token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    const messaging = getMessaging();
    getToken(messaging, { vapidKey: key }).then((currentToken) => {
      if (currentToken) {
        console.log(currentToken)
        sendTokenToServer(currentToken)

        //sendMessage(message);
      } else {
        // Show permission request UI
        console.log('No registration token available. Request permission to generate one.');
        // ...
      }
    }).catch((err) => {
      console.log('An error occurred while retrieving token. ', err);
      setTokenSentToServer(false)
      // ...
    });
}


function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
        console.log('Sending token to server ...');
        setTokenSentToServer(true)
    } else {
        console.log('Token already available in the server');
    }
}
function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === '1'
}
function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0')
}

function showAlert(){
  if (status==200) {
    alert("Notification sent successfully!");
  } else if(status!=0) {
    alert("Unable to send the notification.");
  }
}



;
