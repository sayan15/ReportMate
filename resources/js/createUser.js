// Define a global variable to hold the Autocomplete object.
let userLocation;

async function initMap() {
    // Request the needed libraries.
    const { Map, InfoWindow } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");

    // Load the Autocomplete feature once the libraries are ready.
    autoLocationLoader();
}

function autoLocationLoader() {
    // Get userLocation
        // Ensure the google.maps object is defined before accessing Autocomplete.
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            userLocation = new google.maps.places.Autocomplete(document.getElementById('officer_location'));
            // Listen for the 'place_changed' event when a place is selected in the Autocomplete input.
            userLocation.addListener('place_changed', function() {
                // Get the selected place from the Autocomplete input.
                const place = userLocation.getPlace();

                if (place.geometry) {
                    // Get the latitude and longitude from the selected place.
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();

                    // Now, 'lat' and 'lng' contain the latitude and longitude of the selected place.
                    document.getElementById('lat').value=lat;
                    document.getElementById('lng').value=lng;
                }
            });
        }
        
}

$(document).ready(function() {
    initMap();
});
