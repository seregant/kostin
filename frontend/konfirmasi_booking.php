<?php
    include 'header.php';
    $bookingBillData = getBookingBillData($_GET['no_invoice']);

    $bookingBill = mysqli_fetch_assoc($bookingBillData);

    $bookingData = getBookingData($bookingBill['book_id']);
    $booking = mysqli_fetch_assoc($bookingData);

    $sqlAddon = "
                SELECT
                    `kostin_addons`.`ao_name`,
                    `kostin_addons`.`ao_price`,
                    `kostin_booking_ao`.`jumlah`
                FROM `kostin_booking_ao`
                INNER JOIN `kostin_addons` ON `kostin_addons`.`ao_id` = `kostin_booking_ao`.`ao_id`
                WHERE `kostin_booking_ao`.`book_id` = '".$bookingBill['book_id']."'
            ";
    $addonsData = mysqli_query($conn, $sqlAddon);
    
    $roomData = getRoomData($booking['kamar_id']);
    $room = mysqli_fetch_assoc($roomData);

    $aoPrice = 0;

    $dueDateCount = dueDateCounter($bookingBill['tagihan_duedate']);

    if ($bookingBill['tagihan_status']=='pending' AND $dueDateCount > 0) {
        $color = 'blue';
        $status = 'Belum Dibayar';
    } else if($bookingBill['tagihan_status']=='waiting') {
        $color = 'orange';
        $status = 'Menunggu Konfirmasi';
    } else if($bookingBill['tagihan_status']=='paid') {
        $color = 'green';
        $status = 'Lunas';
    } else {
        $color = 'red';
        $status = 'Batal';
        if ($bookingBill['tagihan_status']=='cancel') {
            $keterangan = '(Transaksi dibatalkan)';
        } else {
            $keterangan = '(Sudah melewati jatuh tempo)';
        }
    }

    if (mysqli_num_rows($bookingBillData)<1) {
        include 'frontend/konfirmasi_booking/not_ok.php';
    } else {
        include 'frontend/konfirmasi_booking/ok.php';
    }
?>



<?php
    include 'footer.php';
?>