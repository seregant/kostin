<!--==========================
    Footer
============================== -->
<div class="footer" >
  <div class="row container-fluid">
      <div class="col-sm-6 footer-logo">
        <a href="#"><img src="img/company2.png" alt=""></a>
      </div>
      <div class="col-sm-6 footer-text">
        <p>© Copyright 2018 <span>KostIn</span>.</p>
      </div>  
  </div>
</div>
<!-- End of Footer -->


<!-- =========================
     Scripts   
============================== --> 
<!-- End of Responsive navigation bar-->

<!-- Jquery --> 
<script src="js/jquery-3.3.1.min.js"></script> 

<!-- Bootstrap --> 
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!-- Magnific Popup core JS file -->
<script src="js/jquery.magnific-popup.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?keyAIzaSyB0BYbLL8tpdy1U13A3gjpfvhkbxZ8g8KQ"></script>

<script>
/*  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -7.7556162, lng: 110.3729705},
    zoom: 14
  });
*/
var myLatlng = new google.maps.LatLng(-7.747607,110.383692);
var mapOptions = {
  zoom: 17,
  center: myLatlng
}
var map = new google.maps.Map(document.getElementById("map"), mapOptions);

var marker = new google.maps.Marker({
    position: myLatlng,
    title:"KostIn"
});

// To add the marker to the map, call setMap();
marker.setMap(map);  
</script>
<!-- Custom JS  
<script src="js/custom.js"></script>

 Google Map API
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAU5h2oa8HYtprP_xoAFKIJcu5A1KeWrRQ
"></script>


-->
</div>
</body>
</html>