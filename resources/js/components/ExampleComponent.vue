<template>
    <div class="z-depth-1-half map-container" style="height: 500px" id="map">

    </div>
</template>

<script>
import firebaseFunction from '../firebaseDataService';
import {onValue } from "firebase/database";


export default {
    props: {
    locations: Object, // Define the prop type
  },
  data() {
    return {
      incidents: [],
    };
  },
    mounted() {

    
    //const databaseRef = firebaseFunction.getAll(); 
    onValue( firebaseFunction.getAll(), (snapshot) => {
      console.log(snapshot.val());
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
        this.incidents.push(incident);}
        
     // Push the location object into the locations array
        
        
        
      });
      this.initMap(this.incidents);
    });

    
    //this.initMap(this.incidents); // Call the function when the component is mounted
    },
    methods: {
        async initMap(locations) {
            // Request needed libraries.
            const { Map, InfoWindow } = await google.maps.importLibrary("maps");
            const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
                "marker",
            );
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: { lat: 52.2377, lng: -0.8944 },
                mapId: "DEMO_MAP_ID",
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
                    //infoWindow.setContent(position.lat + ", " + position.lng +", "+position.title);
                    //infoWindow.open(map, marker);
                    // Inside your Vue component
                    this.$router.push('/test');
                });
                return marker;
            });

            // Add a marker clusterer to manage the markers.
            const markerCluster = new markerClusterer.MarkerClusterer({ map, markers });
        }
    }
}
</script>
