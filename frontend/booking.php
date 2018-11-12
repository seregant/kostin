<?php

include 'header.php';
	$dataAddon = getAllData('kostin_addons','*', null, null);
?>
<div class="container ">

	<!-- FORM BOOKING -->
	<form class="form-cust" enctype="multipart/form-data" action="data_input.php?category=booking">
	<div class="row form-bg" style="padding: 5px;">
		<div class="col-md-5 mx-auto form-border" >
  				<center style="padding-top: 1em;"><h4>Data Booking</h4></center>
  				
  					<div class="form-group">
  						<label for="usr" style="padding-top: 5px;">Nama:</label><br>
  						<input type="text" class="form-control " id="usr" name="nama">
  					</div>
  					<div class="form-group">
  						<label for="usr">Alamat:</label><br>
  						<textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
  					</div>
  					<div class="form-group">
  						<label for="usr">Email:</label><br>
  						<input type="text" class="form-control " id="usr" name="mail">
  					</div>
  					<div class="form-group">
  						<label for="usr">No. Telp/HP</label><br>
  						<input type="text" class="form-control " id="usr" name="phone">
  					</div>
  					<div class="form-group">
  						<label for="usr">Tanggal Lahir</label><br>
  						<input type="date" class="form-control " id="usr" name="tanggal-lahir">
  					</div>
  					<div class="form-group">
    					<label for="exampleFormControlSelect1">No. KTP/SIM</label><br>
     					<input type="text" class="form-control " id="usr" name="">
					</div> 
					<div class="form-group">
			  			<label for="exampleInputFile">Foto KTP/SIM</label><br>
			  			<input type="file" id="exampleInputFile">
			  			<p class="help-block">Example block-level help text here.</p>					
					</div>
					<button type="button" class="btn btn-primary" >Booking</button>

		</div>
		<div class="col-md-7" >
			<div class="container form-border" style="text-align: center;">
				<h4>Daftar Add-ons</h4>
				<div class="custom-control custom-checkbox">
  					<input type="checkbox" class="custom-control-input" id="customCheck1" style="background-color: white;">
  					<label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
				</div>
				<table>
  						<thead>
  							<tr>
  								<th></th>
  								<th>Nama</th>
  								<th>Harga</th>
  							</tr>
  						</thead>
  						<tbody>
  					<?php
  						foreach ($dataAddon as $addon) {
  							echo '
			  					<tr>
			  						<td><input type="checkbox" name="add-on[]" value="'.$addon['ao_id'].'"></td>
			  						<td>
			  							'.$addon['ao_name'].'
			  						</td>
			  						<td>
			  							'.$addon['ao_price'].'
			  						</td>
			  					</tr>
  							';
  						}
  					?>
  					</tbody>
  				</table>
			</div>			
		</div>		
	</div>
	</form>

</div>

<?php
	include 'footer.php';
?>