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
            <div class="header-wrap" style="float: right;">
                <div class="header-button" >
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