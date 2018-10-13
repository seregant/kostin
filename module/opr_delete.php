<?php
  function deleteUser($userId){
    include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
    $sql=" DELETE FROM kostin_user WHERE user_id = '".$userId."'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      echo "hapus gagal";
      echo mysqli_error($conn);
    } else {
      header("Location:../index.php?category=form&module=user");
    }
  }

  switch ($_POST['data']) {
  	case 'user':
  	   deleteUser($_POST['user_id_delete']);
  		break;
  	
  	default:
  		echo "not found!";
  		break;
  }
?>