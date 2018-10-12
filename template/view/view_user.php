<?php
	include $_SERVER["DOCUMENT_ROOT"]."/kostin/config/app.php";
	include $base_url.'/config/database.php';
	include $base_url."/module/data_get.php";

	$userdata = getAllData('kostin_user','*');
?>

	<div class="col-lg-6">
		<div class="table-responsive table-date">
			<table class="table">
				<thead>
					<tr>
						<td>Nama User</td>
						<td>Username</td>
						<td>E-Mail</td>
						<td>Akses</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($userdata as $uers) {
							$sqlRole = "select * from kostin_user_role where roole_id = ".$users['role_id'];
							$userRole = mysqli_query($conn, $sqlRole);
							$roleName = mysqli_fetch_assoc($userRole);
							echo "
								<tr>
									<td>".$users['user_fullname']."</td>
									<td>".$users['user_name']."</td>
									<td>".$users['user_email']."</td>
									<td>".$roleName['role_name']."</td>
									<td></td>
								</tr>
							";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>