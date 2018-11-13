//MAP
var myLatlng = new google.maps.LatLng(-7.747607,110.383692);
var mapOptions = {
  zoom: 17,
  center: myLatlng
}
var map = new google.maps.Map(document.getElementById("our-map"), mapOptions);

var marker = new google.maps.Marker({
    position: myLatlng,
    title:"KostIn"
});

// To add the marker to the map, call setMap();
marker.setMap(map); 


//VALIDATING FORM Booking
// Example starter JavaScript for disabling form submissions if there are invalid fields
