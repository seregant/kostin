<?php
  session_start();
  if(!isset($_SESSION['username'])){
    if (!isset($_GET['page'])) {
      include('frontend/index.php');
    } else {
      switch ($_GET['page']) {
        case 'booking':
          include('frontend/booking.php');
          break;
        
        default:
          # code...
          break;
      }
    }
  } else {
    if (isset($_GET['search'])) {
      if (strpos($_SERVER['HTTP_REFERER'], 'category=view&module=booking') !== false) {
          header("Location:index.php?category=view&module=booking&keyword=".$_GET['search']);
      } else {
        echo "kampret";
      }
    }
    include('template/index.php');
  }
?>