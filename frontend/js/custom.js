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
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();