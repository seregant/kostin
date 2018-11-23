<?php
  include 'header.php';
?>
<!--==========================
    Slider
============================== -->
<div class="row" >
    <div id="carouselExampleIndicators" class="carousel slide mx-auto" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active ">
          <img class="slider-img" src="img/kost1.jpg" alt="First slide" >
        </div>
        <div class="carousel-item">
          <img class="slider-img"  src="img/kost2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="slider-img" src="img/kost3.jpg" alt="Third slide">
        </div>
      </div>

    </div>
</div>

<!-- End of Slider -->


<!--==========================
    Summary
============================== -->
<div class="container row  mx-auto" style="padding: 1em;" >
    <div class="col-md-12"  style="text-align: center;">
      <h4>What is KostIn?</h4></div>

    <div class="col-sm" style="text-align: justify;">
      <h6>KostIn adalah salah satu Hunian Kos Exclusive dengan harga murah dengan fasilitas yang lengkap diantarannya wifi, parkiran luas dan aman disertai dengan penjaga rumah kos, disertai dengan Air Conditioning dan juga terdapat fasilitas kolam renang yang bisa digunakan oleh penghuni secara gratis. Harga murah disini juga relatif, kami mengkategorikan harga murah disini karena harga kamar terpisah dengan add ons. Isian kamar juga bisa di isi sesuai dengan keinginan, isi kamar juga bisa merequest pada pemilik kos ataupun membeli sendiri. Kami akan selalu berupaya meningkatkan kualitas dan kuantitas hunian kos yang kami kelola. </h6> 
    </div>
     
</div>

<!-- End of Summary -->

 <hr class="hr-color">
<!--==========================
    Content
============================== -->
<div class="row">
  <div class="col-md-12" style="text-align: center;">
    <h4>What Services We Offers?</h4>
  </div>
  <div class="container row mx-auto">
    <div class="col-sm">
      <center><img class="icon" src="icons/wifi.png">
      <div class="text" >Free Wifi</div>
      </center>
    </div>
    <div class="col-sm">
      <center><img class="icon" src="icons/parking.png"><br>
      <div class="text">Area Parkir Luas</div></center>
    </div>
    <div class="col-sm">
      <center><img class="icon" src="icons/ac.png"><br>
     <div class="text">Full AC</div></center>
    </div>
    <div class="col-sm">
      <center><img class="icon" src="icons/kolamrenang.png"><br>
      <div class="text">Kolam Renang</div></center>
    </div>
  </div>
  </div>
</div>
<!-- End of Content -->
   <hr class="hr-color">
<!--==========================
    Map
============================== -->
<div class="row container-fluid">
  <div class="col-md-12" style="text-align: center;">
    <h4>Our Location</h4>
  </div>
  <div class="col-md-6 mx-auto">
      <div id="map"></div>
  </div>
    
</div>
<!-- End of Content -->
  <hr class="hr-color">

<?php
  include 'footer.php';
?>