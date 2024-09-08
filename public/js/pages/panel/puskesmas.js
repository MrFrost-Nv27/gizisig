var mymap = L.map("map").setView([-7.247886, 109.007832], 14);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(mymap);

var latitudeField = document.getElementById("latitude");
var longitudeField = document.getElementById("longitude");
var marker;

if (latitudeField.value !== "" && longitudeField.value !== "") {
  var latlng = L.latLng(parseFloat(latitudeField.value), parseFloat(longitudeField.value));
  marker = new L.Marker(latlng).addTo(mymap);
  mymap.setView(latlng, 13);
}

mymap.on("click", function (e) {
  if (marker) {
    mymap.removeLayer(marker);
  }
  marker = new L.Marker(e.latlng).addTo(mymap);
  latitudeField.value = e.latlng.lat;
  longitudeField.value = e.latlng.lng;
});

function updateLocation(lat, lng) {
  if (marker) {
    mymap.removeLayer(marker);
  }
  mymap.setView([lat, lng], 13);
  marker = new L.Marker([lat, lng]).addTo(mymap);
  document.getElementById("latitude").value = lat;
  document.getElementById("longitude").value = lng;
}

function getCurrentLocation() {
  if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function (position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      updateLocation(latitude, longitude);
    });
  } else {
    alert("Geolocation tidak didukung oleh browser ini.");
  }
}
