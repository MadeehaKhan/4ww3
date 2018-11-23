var mymap;
function show() {
	mymap = L.map('resultsMap').setView([43.255, -79.871], 17);
	//how you wanr to view the map 
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibW9zdGFmYTk0NTIiLCJhIjoiY2puM29sczBqNThoZzN4cWM4Mmh2eDF2MCJ9.E6xW8_2aP9X9eCEtOIfO7Q', 
    {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 20,
    id: 'mapbox.streets',
    accessToken: 'your.mapbox.access.token'}).addTo(mymap);
    //current location marker
    L.marker([43.255, -79.871]).addTo(mymap).bindPopup("This is your current location.").openPopup();

    mymap.on('click', onMapClick);
}

function showParking() {
	mymap = L.map('parkingMap').setView([43.262880, -79.927607], 17);
	//how you wanr to view the map 
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibW9zdGFmYTk0NTIiLCJhIjoiY2puM29sczBqNThoZzN4cWM4Mmh2eDF2MCJ9.E6xW8_2aP9X9eCEtOIfO7Q', 
    {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 20,
    id: 'mapbox.streets',
    accessToken: 'your.mapbox.access.token'}).addTo(mymap);
    //current location marker
    L.marker([43.262880, -79.927607]).addTo(mymap).bindPopup("<b>You are at Parking Lot N</b>").openPopup();

    mymap.on('click', onMapClick);
}

//when we click somewhere on the map how its geolocation
function onMapClick(e) {
	var popup = L.popup();
	console.debug("click");
    popup
    .setLatLng(e.latlng)
    .setContent("You clicked the map at " + e.latlng.toString())
    .openOn(mymap);
}
