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
						foreach ($userdata as $users) {
							$sqlRole = "select * from kostin_user_role where role_id = ".$users['role_id'];
							$roleName = mysqli_fetch_assoc(mysqli_query($conn, $sqlRole));
							echo '
								<tr>
									<td>'.$users['user_fullname'].'</td>
									<td>'.$users['user_name'].'</td>
									<td>'.$users['user_email'].'</td>
									<td>'.$roleName['role_name'].'</td>
									<td>
                                      <div class="table-data-feature">
                                          <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                              <i class="zmdi zmdi-mail-send"></i>
                                          </button>
                                          <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                              <i class="zmdi zmdi-edit"></i>
                                          </button>
                                          <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                              <i class="zmdi zmdi-delete"></i>
                                          </button>
                                          <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                              <i class="zmdi zmdi-more"></i>
                                          </button>
                                      </div>
                                  </td>
								</tr>
							';
						}
					?>
				</tbody>
			</table>
		</div>
	</div>