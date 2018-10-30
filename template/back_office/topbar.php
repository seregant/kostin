<?php 
    include 'config/app.php';
    include 'config/database.php';
    include 'module/data_get.php';
    
    $notifBooking = getBookingNotif();
    $jmlNotif = mysqli_num_rows($notifBooking);

?>
<header class="header-desktop" style="background-color: #2bb1ff;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap" >
                <form class="form-header" action="" method="POST">
                   
                </form>
                <div class="header-button" >
                    <div class="noti-wrap">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications" style="color: white;"></i>
                            <?php if ($jmlNotif > 0) {
                                echo '<span class="quantity">'.$jmlNotif.'</span>'; 
                            } ?>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                   Notifikasi Booking
                                </div>
                                <?php
                                    if ($jmlNotif > 0) {
                                        foreach ($notifBooking as $notif) {
                                            // echo '';
                                            echo '<div class="notifi__item">
                                                    <div class="bg-c1 img-cir img-40">
                                                        <a href="index.php?category=detail&module=booking&id='.$notif['book_id'].'"><i class="zmdi zmdi-check"></i></a>
                                                    </div>
                                                    <div class="content">
                                                        <a href="index.php?category=detail&module=booking&id='.$notif['book_id'].'"><p>Booking dari : <strong>'.$notif['book_name'].'</strong></p><span class="date">'.$notif['book_date'].'</span></a>
                                                    </div>
                                                </div>';

                                        }
                                    }
                                ?>
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="<?php echo $_SESSION['images']; ?>" alt="<?php echo $_SESSION['name'];?>" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#"><?php echo $_SESSION['name']; ?></a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="<?php echo $_SESSION['images']; ?>" alt="<?php echo $_SESSION['name']; ?>" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#"><?php echo $_SESSION['name']; ?></a>
                                        </h5>
                                        <span class="email"><?php echo $_SESSION['email']; ?></span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-settings"></i>Setting</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <a href="#">
                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="logout.php">
                                        <i class="zmdi zmdi-power"></i>Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>