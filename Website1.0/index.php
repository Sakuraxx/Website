<?php
	session_start();
	if(!isset($_SESSION['valid_name'])or!isset($_SESSION['valid_pwd']))
	{
		header("Location:login.php");
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="favicon.ico">
	<title>趣味答题网站</title>
	<link rel="stylesheet" type="text/css"   href="css/main.css">
	<link rel="stylesheet" type="text/css"   href="css/css.css">

</head>
<body class="backgroundchange">
	
		<div class="header">
			<div class="xueyuan_logo"></div><!--这里放学院logo-->
			<div class="xiehui_logo"></div><!--这里放协会logo-->
			<div class="title">
				趣味答题网站
			</div>
		</div>

		<div class="user-information">
			<div class="user">
			<a href="logout.php">退出登录</a>&nbsp;&nbsp;
			小可爱:<?php echo$_SESSION['valid_name'];?>
			</div>
		</div>
	
		<div class="container">
			<div class="content">
				<div class="slogan">
						脚踏实地，仰望星空
				</div>
				<div class="entry">

					<div class="game">
						<buttom type="submit" name="game"
						class="game buttom" value="Game">
						<a href="answer.php">答题</a>
						</buttom>
					</div>

					<div class="ranking">
						<buttom type="submit" name="ranking"
						class="ranking buttom" value="Ranking">
						<a href="rank.php">排名</a>
						</buttom>
					</div>

				</div>
			</div>

		</div>
		
		<div class="footer">
			©2017&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计算机科学学院
		</div>

</body>
</html>