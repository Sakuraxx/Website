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
					    <label for="login">User&nbsp;&nbsp;</label>
					    <input type="text" name="id" id="id" value="">
				    </div>
				    <div class="inputpwd">
					    <label for="password">Password</label>
					    <input type="password" name="password" id="password" value="">
				    </div>
				
				    <div class="login_submit">
				    	<div class="regist">
				    		<a href="regist.php">Regist</a>
				    	</div>
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
		include ('login_confirm.php');
	?>
</body>
</html>