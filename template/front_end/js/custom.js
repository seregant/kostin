	/* ==========================
	   MAP
	=============================*/
	(function ourLocation(w, g){
		var latlng = new google.maps.LatLng(-6.21, 108.85),
		options = {
			center: latlng,
			zoom: 12
		},
		 map = new google.maps.Map.(document.getElementById('map'), options);
	} (window,google));

	/* ==========================
	   PRE-LOADER
	=============================*/
	

	/* ==========================
	   VIDEO POPUP
	=============================*/

	$(document).ready(function() {
		$('.pop-up').magnificPopup({
			items: {
			  src: 'http://www.youtube.com/watch?v=7HKoqNJtMTQ',
       		  type: 'iframe' // this overrides default type
			},
			type: 'image' // this is default type
		});
	});

