<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="favicon.ico">
	<title>趣味答题网站登录</title>
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/css.css">
	<script type="text/javascript" src="js/login.js"></script>
</head>
<body >
	
	<div class="header">
		<div class="xueyuan_logo"></div><!--这里放学院logo-->
		<div class="xiehui_logo"></div><!--这里放协会logo-->
	</div>
	<div class="mainbody"><!--这是主体部分-->
		<div class="loginbox">
				<form action="login.php" method="post" onsubmit="return user_input()" accept-charset="utf-8">
					<h1>趣味答题网站登录界面</h1>
					<div class="inputuser">
					    <label for="login">User&nbsp;</label>
					    <input type="text" name="id" id="id" value="">
				    </div>
				    <div class="inputpwd">
					    <label for="password">Password&nbsp;</label>
					    <input type="password" name="password" id="password" value="">
				    </div>
				
				    <div class="login_submit">
				        <div class="submit">
				        	<button type="submit" class="buttom">Login</button>
				        </div>
				    </div>
				</form>
				<br>
				
		</div>
	</div> 

	<div class="footer">
			©2017&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计算机科学学院
	</div>

	<?php
		session_start();
		if ($_POST)
		{
			require ('conn.php');
			$name = $_POST['id'];
			$password = hash("sha256",$_POST['password']);
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
				$_SESSION['testone'] = 0;//先做完答题test1才可以测试字速
				header("Location:index.php");
			}
			else
			{
				echo '<script>alert("用户名或密码错误")</script>';
			}
			mysqli_close($db_connect);
		}
	?>
</body>
</html>