<?php
	session_start();
	if ($_POST)
	{
		include('conn.php');
		$name = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$email = htmlspecialchars($_POST['email']);
		$check = htmlspecialchars($_POST['check']);
		if ($check == '')
		{
			echo '<script>alert("验证码不能为空！")</script>';
			exit;
		}
		else if($check != $_SESSION['check_checks'])
		{
			echo '<script>alert("验证码错误！")</script>';
			exit;
		}
		
		
		//$sql1 = "select * from users where name = '$name'";   #判断是否重名
		$sql1 = mysqli_prepare($db_connect,"select name from users where name=?");
		mysqli_stmt_bind_param($sql1,'s',$name);
		
		$result = mysqli_stmt_execute($sql1);
		if (!$result)
		{
			echo '<script>alert("Cannot run query!")</script>';
			exit;
		}
		$result2 = mysqli_stmt_get_result($sql1);
		//$row = mysqli_fetch_array($result2);
		if (mysqli_num_rows($result2)>=1)
		{
			echo '<script>alert("该用户名已被注册！")</script>';
			exit;
		}
		else
		{
			/*$sql = "insert into users(name,password,email) values ('$name','$password','$email')";
			$result1 = mysqli_query($db_connect,$sql);*/
			$sql =  mysqli_prepare($db_connect,"insert into users(name,password,email) values (?,?,?)");
			mysqli_stmt_bind_param($sql,'sss',$name,$password,$email);
			$result1 = mysqli_stmt_execute($sql);
			if(!$result1)
			{
				echo '<script>alert("cannot run query!")</script>';
				exit;
			}
			else
			{
				echo '<script>alert("注册成功!")</script>';
				header("refresh:0;url=login.php");
			}
		}
	}
?>