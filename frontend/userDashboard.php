<?php
	include 'header.php';
?>

<div class="container-fluid " style="padding-top: 2em;">
	<nav>
		<div class="nav nav-tabs user-dboard" id="nav-tab" role="tablist">
	    	<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile Penghungi</a>
		    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tagihan</a>
		    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Konfirmasi</a>
	  	</div>
	</nav>
	<div class="tab-content" id="nav-tabContent" style="padding-bottom: 10em;">
		<!-- Profile Penghuni -->
  		<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  			<div class="row" style="padding: 1em;" >
  				<!-- Foto -->
  				<div class="col-md-3">
  					<img src="https://3.bp.blogspot.com/-y-jsCidy594/W5JnYoVLBoI/AAAAAAAAAAU/2Y7yV4PIARAyVYUv3zwpy_qkAPQO12C1QCLcBGAs/s400/Photo%2Bfrom%2BReno%2BFaizal.jpg" alt="..." class="img-thumbnail rounded mx-auto d-block">
  				</div>
  				<!-- Data Penghuni -->
  				<div class="col-md-6">
  					<div class="table-responsive table-padding" style="padding-left: 2em;">
						<table class="table table-hover">
							<thead>
								<tr>
							    	<th scope="col" colspan="2">DATA PENGHUNI</th>
						    	</tr>
						  	</thead>
						  	<tbody>
						    	<tr>
						      	<th scope="row">Nama</th>
						      	<td>Reno Faizal Mubaroch</td>
						    </tr>
						    <tr>
						    	<th scope="row">Alamat</th>
						      	<td>Maguwo</td>
						    </tr>
						    <tr>
						      	<th scope="row">No. Telp</th>
						      	<td colspan="2">08xxxxxxxx</td>
						    </tr>
						    <tr>
						      	<th scope="row">Email</th>
						      	<td colspan="2">Ren@gmail.com</td>
						    </tr>
						  </tbody>
						</table> 						
  					</div>
  				</div>
  			</div>
  			<button type="button" class="btn btn-primary" style="width: 12%; float: right; margin-right: 10em;">Edit Profile</button>
  		</div>

  		<!-- Tagihan -->
		<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
			
		</div>

		<!-- Konfirmasi -->
  		<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
  			<div class="container-fluid">
  				<form class="form-cust">
  					<div class="form-group">
  						<label for="usr">No. Kamar:</label><br>
  						<input type="text" class="form-control form-width" id="usr" name="">
  					</div>
  					<div class="form-group">
  						<label for="usr">Tanggal Transfer:</label><br>
  						<input type="date" class="form-control form-width" id="usr" name="">
  					</div>
  					<div class="form-group">
  						<label for="usr">Nama Pemilik Rekening:</label><br>
  						<input type="text" class="form-control form-width" id="usr" name="">
  					</div>
  					<div class="form-group">
  						<label for="usr">Jumlah Transfer</label><br>
  						<input type="text" class="form-control form-width" id="usr" name="">
  					</div>
  					<div class="form-group">
    					<label for="exampleFormControlSelect1">Rekening Tujuan</label><br>
    					<select class="form-control form-width" id="exampleFormControlSelect1">
    						<option>Bank Rakyat Indonesia (BRI)</option>
    						<option>Bank Central Asia (BCA)</option>
    						<option>Bank Mandiri</option>

					    </select>
					</div> 
					<div class="form-group">
			  			<label for="exampleInputFile">Upload ukti Bayar</label><br>
			  			<input type="file" id="exampleInputFile">
			  			<p class="help-block">Example block-level help text here.</p>					
					</div>
					<button type="button" class="btn btn-primary" style="width: 10%">Kirim</button>
  				</form>
  			</div>
  		</div>
	</div>
</div>

<?php
	include 'footer.php';
?>	