<?php
  function deleteUser($userId, $imgFile, $imgThumb){
    include $_SERVER["DOCUMENT_ROOT"].'/kostin/config/database.php';
    $sql=" DELETE FROM kostin_user WHERE user_id = '".$userId."'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      echo "hapus user gagal";
      echo mysqli_error($conn);
    } else {
      unlink($imgFile);
      unlink($imgThumb);
      header("Location:../index.php?category=form&module=user");
    }
  }

  function deleteKamar($kamarId){
    include '../config/database.php';
    $sql=" DELETE FROM kostin_kamar WHERE kamar_id = '".$kamarId."'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      echo "hapus kamar gagal";
      echo mysqli_error($conn);
    } else {
      header("Location:../index.php?category=view&module=kamar");
    }
  }

  function deleteAddon($addonId){
    include '../config/database.php';
    $sql=" DELETE FROM kostin_addons WHERE ao_id = '".$addonId."'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      echo "hapus addon gagal";
      echo mysqli_error($conn);
    } else {
      header("Location:../index.php?category=view&module=addon");
    }
  }

  function deleteOutcome($outcmId){
    include '../config/database.php';
    $sql=" DELETE FROM kostin_outcome WHERE outcm_id = '".$outcmId."'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      echo "hapus pengeluaran gagal";
      echo mysqli_error($conn);
    } else {
      header("Location:../index.php?category=view&module=outcome");
    }
  }

  switch ($_POST['data']) {
  	case 'user':
  	   deleteUser($_POST['user_id_delete'],$_POST['user_image_delete'],$_POST['user_thumb_delete']);
  		break;

  	case 'kamar':
      deleteKamar($_POST['room_id_delete']);
      break;

    case 'addon':
      deleteAddon($_POST['addon_id_delete']);
      break;

    case 'outcome':
      deleteOutcome($_POST['outcm_id_delete']);
      break;

  	default:
  		echo "not found!";
  		break;
  }
?>