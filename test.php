<?php
	echo $_SERVER['HTTP_REFERER']."<br>";
	if (strpos($_SERVER['HTTP_REFERER'], 'category=view&module=booking') !== false) {
    	echo 'true';
	} else {
		echo "kampret";
	}
?>