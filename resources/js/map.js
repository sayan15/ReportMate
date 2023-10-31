
import firebaseFunction from './firebaseDataService';
import {onValue } from "firebase/database";


let map,directionsService,directionsRenderer;

async function initMap(locations) {
    
    
    // Request needed libraries.
    const { Map, InfoWindow } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
        "marker",
    );
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: { lat: 52.23023, lng: -0.88680 },
        mapId: "University Of Northampton",
    });
    const infoWindow = new google.maps.InfoWindow({
        content: "",
        disableAutoPan: true,
    });
    // Create an array of alphabetical characters used to label the markers.
    const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    // Add some markers to the map.
    const markers = locations.map((position, i) => {
        const label = labels[i % labels.length];
        const pinGlyph = new google.maps.marker.PinElement({
            glyph: label,
            glyphColor: "white",
        });
        const marker = new google.maps.marker.AdvancedMarkerElement({
            position,
            content: pinGlyph.element,
        });

        // markers can only be keyboard focusable when they have click listeners
        // open info window when marker is clicked
        marker.addListener("click", () => {
            infoWindow.setContent(position.lat + ", " + position.lng +", "+position.title);
            infoWindow.open(map, marker);
            // Inside your Vue component
            
            if (window.location.href.indexOf("map") > -1) {
                window.location.href =  "/incidentDetail/"+position.key;
                
            }
            
        });
        return marker;
    });

    // Add a marker clusterer to manage the markers.
    const markerCluster = new markerClusterer.MarkerClusterer({ map, markers });
}

async function specificIncidentMap(locations) {
    
    
    // Request needed libraries.
    const { Map, InfoWindow } = await google.maps.importLibrary("maps");
    const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
        "marker",
    );
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: { lat: 52.23023, lng: -0.88680 },
        mapId: "University Of Northampton",
    });

    google.maps.event.addListener(map,"click",function(event){
        this.setOptions({scrollwheel:true});
    });

    directionsService=new google.maps.DirectionsService();
    directionsRenderer=new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);

    var start = new google.maps.LatLng(52.23023, -0.88680);
    var end = new google.maps.LatLng(locations[0].lat, locations[0].lng);

    calcRoute(start,end);



}

function calcRoute(origin,destination){
    directionsService
    .route({
      origin: origin,
      destination: destination,
      travelMode: google.maps.TravelMode.DRIVING,
      avoidTolls: true,
    })
    .then((result) => {
        directionsRenderer.setDirections(result);
            //calculate route distatnce
        const directions = directionsRenderer.getDirections();

        if (directions) {
        computeTotalDistance(directions);
        }
    })
    .catch((e) => {
      alert("Could not display directions due to: " + e);
    });
}

function computeTotalDistance(result) {
    let total = 0;
    const myroute = result.routes[0];
  
    if (!myroute) {
      return;
    }
  
    for (let i = 0; i < myroute.legs.length; i++) {
      total += myroute.legs[i].distance.value;
    }
  
    total = total / 1000;
    
    document.getElementById("grid-distance").value = total + " km";
  }

$(document).ready(function(){
    var incidents=[];
    if (window.location.href.indexOf("map") > -1) {
        // Code to run on the specific page
            onValue( firebaseFunction.getAll(), (snapshot) => {

                    
                snapshot.forEach((childSnapshot) => {
                
                // Create a location object with the desired structure
                if(childSnapshot.val().status=='no'){
                    const incident  = {
                    key:childSnapshot.key,
                    lat: childSnapshot.val().lat,
                    lng: childSnapshot.val().lng,
                    title: childSnapshot.val().title,
                    
                    description: childSnapshot.val().description,
                };
                incidents.push(incident);}
                
            // Push the location object into the locations array
                
                
                
                });
                initMap(incidents);
        });
    }else{
        const incident={key:"-NhBTGmG4VrGtP_HQhuC",lat:Speclocation[0].lat , lng:Speclocation[0].lng,title:Speclocation[0].title,description:Speclocation[0].description};
        incidents.push(incident);
        specificIncidentMap(incidents);
    }
        
    
});


