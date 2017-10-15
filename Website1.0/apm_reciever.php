<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
echo 123;
	session_start();
	if(!isset($_SESSION['valid_name'])or!isset($_SESSION['valid_pwd']))
	{
		echo 123;
		die();
	}
	echo 1232;
	require ('conn.php');

	$sql = "select score from apm where name = '$_SESSION[valid_name]'";
	$result = mysqli_query($db_connect,$sql);
	$row = mysqli_fetch_array($result);
	if ($row['apm']!=null)
	{
		die();
	}
	echo 123;
	$sql =  mysqli_prepare($db_connect,"insert into apm(name,time,keys,apm) values (?,?,?,?)");
	//"time":timePassed,"keydown":keyCount,"length":question.length
	mysqli_stmt_bind_param($sql,'ssss',$_SESSION['valid_name'],$_POST['time'],$_POST['keydown'],$_POST['time']/$_POST['length']);
	$result1 = mysqli_stmt_execute($sql);
	if(!$result1)
	{
		echo '<script>alert("cannot run query!")</script>';
		exit;
	}
	else
	{
		echo '<script>alert("finished!")</script>';
		header("refresh:0;url=/");
	}