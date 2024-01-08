
import { getMessaging, getToken } from "firebase/messaging";



async function initMap() {
  // Request the needed libraries.
  const { Map, InfoWindow } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");

  // Load the Autocomplete feature once the libraries are ready.
  autoLocationLoader();
}

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


// Define a global variable to hold the Autocomplete object.
let userLocation;


function autoLocationLoader() {
    // Get userLocation
        // Ensure the google.maps object is defined before accessing Autocomplete.
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            userLocation = new google.maps.places.Autocomplete(document.getElementById('locationInput'));
            // Listen for the 'place_changed' event when a place is selected in the Autocomplete input.
            userLocation.addListener('place_changed', function() {
                // Get the selected place from the Autocomplete input.
                const place = userLocation.getPlace();

                if (place.geometry) {
                    // Get the latitude and longitude from the selected place.
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();

                    // Now, 'lat' and 'lng' contain the latitude and longitude of the selected place.
                    document.getElementById('latitudeInput').value=lat;
                    document.getElementById('longitudeInput').value=lng;
                }
            });
        }
        
}

$(document).ready(function(){
  initFirebaseMessagingRegistration();
  showAlert();
  initMap();
})


