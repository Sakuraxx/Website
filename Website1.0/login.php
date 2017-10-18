<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="favicon.ico">
	<title>趣味答题网站登录</title>
	<link rel="stylesheet" href="css/css.css">
	<style type="text/css">
.container{
	text-align: center;
    border: 1px solid #000;
    padding: 5em 0em;
    margin: 0 30%;
	box-shadow: 10px 10px 5px #888888;
}
label{
	position: absolute;
	left: 43%;
}
input[type=text], input[type=password] {
	position: absolute;
	left: 48%;
	padding: 0 10px;
	height: 1.7em;
	text-shadow: 1px 1px 1px #888888;
	background: rgba(255,255,255,0.16);
}
	</style>
	<script type="text/javascript">
function $(id){return document.getElementById(id)}
function user_input(){
	var name = $("id").value;
	var password = $("password").value;
	if(name=="" || password==""){
		alert("用户名或密码不能为空！");
		return false;
	}
	else{
			return true;
	}
}
	</script>
</head>
<body>
	<div class="header">
		<div class="xueyuan_logo"></div><!--这里放学院logo-->
		<div class="xiehui_logo"></div><!--这里放协会logo-->
		<div class="title">趣味答题网站登录</div>
	</div>
	<div class="container"><!--这是主体部分-->
		<form action="login.php" method="post" onsubmit="return user_input()" accept-charset="utf-8">
			<label class="inputlabel" for="login">用户名</label>
			<input type="text" name="id" id="id" value="">
			<br />
			<br />
			<label class="inputlabel" for="password">密码</label>
			<input type="password" name="password" id="password" value="">
			<br />
			<br />
		
			<div class="login_submit">
				<a href="regist.php">注册</a>
				<button type="submit" class="buttom">登录</button>
			</div>
		</form>
		<br />
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