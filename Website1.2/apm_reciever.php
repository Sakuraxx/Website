<?php
	session_start();
	if(!isset($_SESSION['valid_name'])or!isset($_SESSION['valid_pwd']))
	{
		die('login');
	}
	require ('conn.php');
	$sql = "select apm from apm where username = '$_SESSION[valid_name]'";
	$result = mysqli_query($db_connect,$sql);
	$row = mysqli_fetch_array($result);
	if ($row['apm']!=null)
	{
		die('finish');
	}
	$stmt = mysqli_prepare($db_connect,"insert into apm (username,timeused,keycount,apm) values (?,?,?,?)");
	//"time":timePassed,"keydown":keyCount,"length":question.length
	$apm = $_POST['time']/$_POST['length'];
	mysqli_stmt_bind_param($stmt,'ssss',$_SESSION['valid_name'],$_POST['time'],$_POST['keydown'],$apm);
	$result1 = mysqli_stmt_execute($stmt);

	//更新users表中的成绩
	/*$sql = "select score from users where name = '$_SESSION[valid_name]'";
	$result2 = mysqli_query($db_connect,$sql);
	$row = mysql_fetch_array($result2);
	$totalscore = $row['score'] + $apm; 
	$sql = "update users set score = $totalscore where name = '$_SESSION[valid_name]' ";
	mysql_query($db_connect,$sql);
	*/

	if(!$result1)
	{
		die('error');
	}
	else
	{
		echo 'finish';
	}