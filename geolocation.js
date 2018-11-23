function getLocation() {
    //document.getElementById - get an element with a specific ID from the html file
    var button = document.getElementById("locateMe");
    //navigator.geolocation - get a geolocation that gives web content access to the device location
    if (navigator.geolocation) {
        button.disabled = true;
        //getCurrentPosition - get current position of the device
        navigator.geolocation.getCurrentPosition(showPosition,showError);
    } else {
        long.value = "Geolocation is not supported by this browser.";
        lat.value = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    //document.getElementById - get an element with a specific ID from the html file
    var long = document.getElementById("geoLongitude");
    var lat = document.getElementById("geoLatitude");
    //.value - sets the value of 
    //position.coords.logitude - gets the longitude of the current location
    long.value = position.coords.longitude;
    lat.value = position.coords.latitude;
}

function showError(error) {
	var long = document.getElementById("geoLongitude");
    var lat = document.getElementById("geoLatitude");
    switch(error.code) {
        //permission_denied - permission denied to access a property.
        case error.PERMISSION_DENIED:
            long.value = "User denied the request for Geolocation."
            lat.value = "User denied the request for Geolocation."
            break;
        //position_unavailable - at least one internal source of position returned an internal error.
        case error.POSITION_UNAVAILABLE:
            long.value = "Location information is unavailable."
            lat.value = "Location information is unavailable."
            break;
        //timeout - passed the set time to get geolocation.
        case error.TIMEOUT:
            long.value = "The request to get user location timed out."
            lat.value = "The request to get user location timed out."
            break;
        // unknown_error - not any of the erorrs mentioned above.
        case error.UNKNOWN_ERROR:
            long.value = "An unknown error occurred."
            lat.value = "An unknown error occurred."
            break;
    }
}
