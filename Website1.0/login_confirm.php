<?php
session_start();
if ($_POST)
{
	require ('conn.php');
	$name = $_POST['id'];
	//$password = $_POST['password'];
	$password = md5($_POST['password']);
	//$sql =  "select * from users where name = ? and password = ?";
	$sql_p = mysqli_prepare($db_connect,"select * from users where name = ? and password = ?");
	mysqli_stmt_bind_param($sql_p,'ss',$name,$password);
	
	if (!mysqli_stmt_execute($sql_p))
	{
		echo '<script>alert("cannot run query!");</script>';
		exit;
	}
	@mysqli_stmt_bind_result($sql_p,$r_name,$r_password,$r_email);
	if (mysqli_stmt_fetch($sql_p))
	{
		$_SESSION['valid_name'] = $name;
		$_SESSION['valid_pwd'] = $password;
		header("Location:index.php");
	}
	else
	{
		echo '<script>alert("用户名或密码错误")</script>';
	}
	mysqli_close($db_connect);
}
?>