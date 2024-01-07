import firebaseFunction from './firebaseDataService';
import {onValue, get,child } from "firebase/database";

$(document).ready(function(){
    
    var notAccessedIncidents=[];
    var accessedIncidents=[];
    var inProgressIncidents_array=[];
            onValue( firebaseFunction.getAll(), (snapshot) => {
                notAccessedIncidents=[];
                accessedIncidents=[];
                inProgressIncidents_array=[];
                    
                snapshot.forEach((childSnapshot) => {
                    
                    // Create a location object with the desired structure
                    if(childSnapshot.val().status=='Reported'){
                        const incident  = {
                        key:childSnapshot.key,
                        status: childSnapshot.val().status,

                        }
                        notAccessedIncidents.push(incident);
                    }else if(childSnapshot.val().status=='In_progress'){
                        const incident  = {
                            key:childSnapshot.key,
                            status: childSnapshot.val().status,
    
                            }
                            inProgressIncidents_array.push(incident);
                    }
                    else{
                        const incident  = {
                            key:childSnapshot.key,
                            status: childSnapshot.val().status, 
                            }
                        accessedIncidents.push(incident);
                    };
                    
                });
                
                // Get the <p> element by its ID
                var toatlIncidents = document.getElementById("total_Incidents");
                var newIncidents = document.getElementById("new_Incidents");
                var monitoredIncidents = document.getElementById("closed_Incidents");
                var inProgressIncidents= document.getElementById("inProgess_Incidents");
                // Set the HTML content of the <p> element
                toatlIncidents.innerHTML = notAccessedIncidents.length+accessedIncidents.length+inProgressIncidents_array.length;
                newIncidents.innerHTML = notAccessedIncidents.length;
                monitoredIncidents.innerHTML = accessedIncidents.length;
                inProgressIncidents.innerHTML=inProgressIncidents_array.length;
            });

            if((notAccessedIncidents.length+accessedIncidents.length+inProgressIncidents_array.length)===0){
                    // Loop through the object and access its properties
                for (var key in locations) {
                    if (locations.hasOwnProperty(key)) {
                        var location = locations[key];
                        if(location.status=='Reported'){
                            const incident = {
                                key: location.key,
                                status: location.status,
                            };
                            notAccessedIncidents.push(incident);
                        }else if(location.status=='In_progress'){
                            const incident  = {
                                key: location.key,
                                status: location.status,
        
                                }
                                inProgressIncidents_array.push(incident);
                        }else{
                            const incident = {
                                key: location.key,
                                status: location.status,
                            };
                            accessedIncidents.push(incident);
                        }
                                        // Get the <p> element by its ID
                        var toatlIncidents = document.getElementById("total_Incidents");
                        var newIncidents = document.getElementById("new_Incidents");
                        var monitoredIncidents = document.getElementById("closed_Incidents");
                        var inProgressIncidents= document.getElementById("inProgess_Incidents");
                        // Set the HTML content of the <p> element
                        toatlIncidents.innerHTML = notAccessedIncidents.length+accessedIncidents.length+inProgressIncidents_array.length;
                        newIncidents.innerHTML = notAccessedIncidents.length;
                        monitoredIncidents.innerHTML = accessedIncidents.length;
                        inProgressIncidents.innerHTML=inProgressIncidents_array.length;
                    }
                }
            }
            
        }
);
