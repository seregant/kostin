<?php
	include 'header.php';
?>
<div class="container ">

	<!-- FORM BOOKING -->
	<form class="form-cust">
	<div class="row form-bg" style="padding: 5px;">
		<div class="col-md-6 mx-auto form-border">
			<center style="padding-top: 1em;"><h4>Form Kontak</h4></center>
  				<div class="form-group align">
  					<label for="usr" style="padding-top: 5px;">Nama:</label><br>
  					<input type="text" class="form-control " id="usr" name="">
  				</div>
  				<div class="form-group">
  					<label for="usr">Email:</label><br>
  					<input type="text" class="form-control " id="usr" name="">
  				</div>
  				<div class="form-group">
  					<label for="usr">Subject</label><br>
  					<input type="text" class="form-control " id="usr" name="">
  				</div>
  				<div class="form-group">
    				<label for="exampleFormControlSelect1">Pesan</label><br>
     				<textarea class="form-control " id="exampleFormControlTextarea1" rows="3"></textarea>
				</div>
				<div class="col text-center">
					<button type="button" class="btn btn-primary mx-auto" style="max-width: 30%; margin: auto;">Kirim</button>
				</div>
					
		</div>
		<div class="col-md-6 " >
			<div class="container" style="text-align: center;">
				<h4>Alamat</h4>
				<table style="text-align: center; margin: auto; width: 100%;">
					<tr>
						<th>KostIn Office</th>
					</tr>
					<tr>
						<td>ALamat dan Nomor</td>
					</tr>
					<tr>
						<td><div id="our-map"></div></td>
					</tr>
				</table>
			</div>			
		</div>		
	</div>
	</form>

</div>

<?php
	include 'footer.php';
?>