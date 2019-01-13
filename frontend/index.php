<?php
	include 'header.php';
?>

<!-- Booking Message -->
<?php 
  if(isset($_COOKIE['confirmed'])){
    if ($_COOKIE['confirmed'] == "yes") {
      echo '
        <div class="col  mx-auto m-t-210">
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding: 1.1em; text-align: center;">
          		Pemesanan berhasil. Pemberitahuan lebih lanjut akan kami kirimkan via email .
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="max-width: 5%; position: absolute; margin-top: 0;" >
            <span aria-hidden="true" style="font-size: 0.9em;">&times;</span>
          </button>
          </div>  
         </div>';
    } 
  }

  if (isset($_COOKIE['isclear'])) {
  	echo '
        <div class="col  mx-auto m-t-20">
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding: 1.1em; text-align: center;">
          		'.$_COOKIE['message'].'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="max-width: 5%; position: absolute; margin-top: 0;" >
            <span aria-hidden="true" style="font-size: 0.9em;">&times;</span>
          </button>
          </div>  
         </div>';
  }
?>
	<div class="col  mx-auto m-t-10">
          <div class="alert alert-success alert-dismissible fade show" role="alert" style="padding: 1.1em; text-align: center;">
          		- Untuk menggunakan fitur dashboard user silahkan melakukan pemesanan kamar terlebih dahulu. <br>
          		- Akses login akan dikirimkan via email yang digunakan untuk melakukan proses pemesanan setelah tagihan booking dikonfirmasi pembayarannya<br>
          		- Pemrosesan konfirmasi tagihan harus dilakukan di back office
          		- Untuk melihat dan memroses transaksi silahkan masuk ke back office di link project.konco.online/admin<br>
          		- Untuk men-generate tagihan sewa secara sistem akan digenerate setiap 30 hari, untuk men-generate secara langsung bisa menghubungi kami di 082229142821 (whatsapp/sms)
          		- sample user penghuni menggunakan username 'indra' dan password '12345'
          <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="max-width: 5%; position: absolute; margin-top: 0;" >
            <span aria-hidden="true" style="font-size: 0.9em;">&times;</span>
          </button>
          </div>  
         </div>
	<!-- SLIDER -->
	<div class="row">
		<div class="container-fluid">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
			    	<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			    	<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			    	<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			  	</ol>
			  	
			  	<div class="carousel-inner">
			    	<div class="carousel-item active">
			      		<img class="d-block w-100" src="frontend/img/kost1.png" alt="First slide">
			      		<div class="carousel-caption d-none d-md-block">
    						<h5>Tersedia Banyak Kamar</h5>
    						<p>Terawat</p>
  						</div>
			    	</div>
			    	<div class="carousel-item">
			      		<img class="d-block w-100" src="frontend/img/kost2.png" alt="Second slide">
			      		<div class="carousel-caption d-none d-md-block">
    						<h5>Kamar Mandi Dalam</h5>
    						<p>Bersih dan Nyaman</p>
  						</div>			    	
			    	</div>
			    	<div class="carousel-item">
			      		<img class="d-block w-100" src="frontend/img/kost3.png" alt="Third slide">
			      		<div class="carousel-caption d-none d-md-block">
    						<h5>Tempat Tidur</h5>
    						<p>Sangat Nyaman</p>
  						</div>			    	
			    	</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END of SLIDER -->
	
	<!-- CONTENT -->
	<div class="row">
		<div class="container">
			<!-- Summary -->
			<div class="summary">
				<h4>What is KostIn?</h4>
				<div class="col-md-10 mx-auto">
					<h6>KostIn adalah salah satu Hunian Kos Exclusive dengan harga murah dengan fasilitas yang lengkap diantarannya wifi, parkiran luas dan aman disertai dengan penjaga rumah kos, disertai dengan Air Conditioning dan juga terdapat fasilitas kolam renang yang bisa digunakan oleh penghuni secara gratis. Harga murah disini juga relatif, kami mengkategorikan harga murah disini karena harga kamar terpisah dengan add ons. Isian kamar juga bisa di isi sesuai dengan keinginan, isi kamar juga bisa merequest pada pemilik kos ataupun membeli sendiri. Kami akan selalu berupaya meningkatkan kualitas dan kuantitas hunian kos yang kami kelola.</h6>
				</div>
				
			</div>
			<!-- End of Summary -->

			<hr>

			<!-- Service Offers-->
			<div class="serv-off">
				<h4>What Services We Offers?</h4>
				<div class="col-md-10 mx-auto">
					<ul>
						<li>
							<img src="frontend/icon/wifi.png">
							<div class="serv-off-text">Free Wifi</div>
						</li>
						<li>
							<img src="frontend/icon/parking.png">
							<div class="serv-off-text">Area Parkir Luas</div>
						</li>
						<li>
							<img src="frontend/icon/ac.png">
							<div class="serv-off-text">Full AC</div>
						</li>
						<li>
							<img src="frontend/icon/kolamrenang.png">
							<div class="serv-off-text">Kolam Renang</div>
						</li>
					</ul>
				</div>		
			</div>
			<!-- End of Service Offers-->	

			<hr>

			<!-- Maps-->
			<div class="map">
				<h4>Our Location</h4>
				<div class="col-md-10 mx-auto">
					<div id="our-map"></div>
				</div>
			</div>
			<!-- End of Maps-->
		</div>
	</div>
	<!-- END of CONTENT -->
<?php
	include 'footer.php';
?>	