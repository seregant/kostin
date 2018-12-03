<?php

	$jmlPenghuni = mysqli_num_rows(getAllData('kostin_sewa','sewa_id', null, null));
	$tagihanKamar = getTagihanData('sewa', 'tagihan_status', 'paid',null,null);
	$tagihanBooking = getTagihanData('booking', 'tagihan_status', 'paid',null,null);
	$tagihanAmount = 0;

	foreach ($tagihanKamar as $tagihan) {
		$tagihanAmount += $tagihan['tagihan_jumlah'];
	}

	foreach ($tagihanBooking as $tagihan) {
		$tagihanAmount += $tagihan['tagihan_jumlah'];
	}

	$dataOutcome = getAllData('kostin_outcome','*', null, null);
	$outcomeAmount = 0;
	foreach ($dataOutcome as $outcome) {
		$outcomeAmount += $outcome['outcm_value'];
	}

	$allTagihan = getAllData('kostin_tagihan','*', null, null);
	$allTagihanBooking = getAllData('kostin_tagihan_booking','*', null, null);
	$unpaidBill = 0;
	$expiredBill = 0;

	foreach ($allTagihan as $tagihan) {
		if ($tagihan['tagihan_status']=='pending') {
			$dueDateCount = dueDateCounter($tagihan['tagihan_duedate']);
			if ($dueDateCount > 0) {
				$unpaidBill += 1;
			} else {
				$expiredBill += 1;
			}
		}
	}

	foreach ($allTagihanBooking as $tagihan) {
		if ($tagihan['tagihan_status']=='pending') {
			$dueDateCount = dueDateCounter($tagihan['tagihan_duedate']);
			if ($dueDateCount > 0) {
				$unpaidBill += 1;
			} else {
				$expiredBill += 1;
			}
		}
	}
?>

<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">KOSTIN</h2>
        </div>
    </div>
</div>
<div class="row m-t-25">
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number"><?php echo $jmlPenghuni; ?></h2>
            <span class="desc">penghuni</span>
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">Rp <?php echo number_format($tagihanAmount); ?></h2>
            <span class="desc">total pemasukan</span>
            <div class="icon">
                <i class="zmdi zmdi-trending-up"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
            <h2 class="number">Rp <?php echo number_format($outcomeAmount); ?></h2>
            <span class="desc">Total Belanja</span>
            <div class="icon">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="statistic__item">
           <h2 class="number"><?php echo $unpaidBill; ?></h2>
           <span class="desc">Tagihan Belum Dibayar</span>
           <div class="icon">
               <i class="zmdi zmdi-file-text"></i>
            </div>
         </div>
    </div>
</div>
<div class="row">
    
</div>