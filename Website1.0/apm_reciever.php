<?php
	session_start();
	if(!isset($_SESSION['valid_name'])or!isset($_SESSION['valid_pwd']))
	{
		die();
	}

	require ('conn.php');

	$sql = "select score from apm where name = '$_SESSION[valid_name]'";
	$result = mysqli_query($db_connect,$sql);
	$row = mysqli_fetch_array($result);
	if ($row['apm']!=null)
	{
		die();
	}
	