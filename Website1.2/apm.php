<!DOCTYPE html>
<?php
	session_start();
	if($_SESSION['test1'] != 1)
	{
		header("Location:index.php");
	}
?>
<html>
<head>
<meta charset="utf-8" />
<title>APM Test</title>
<link rel="stylesheet" type="text/css" href="css/apm.css" />
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="stylesheet" type="text/css"   href="css/footer.css">

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/apm.js"></script>
</head>
<body>
	<div class="main">
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
				小可爱:<?php echo $_SESSION['valid_name'];?>
				&nbsp;&nbsp;
				<a href="index.php">返回主页</a>
			</div>
		</div>
	</div>
	
	<div class="middle">
		<div class="midbox">
		
			<div id="inputs">
			<form>
				<textarea name="text" id="text" cols="50" rows="20">
				</textarea>
				<!--<button type="button" id="commit" class="submit">提交</button>-->
			</form>
			</div>
			
			<div id="statistic">
				<span id="origin"></span>
				<br />
				<br />
				<ul id="result">
					<li id="time-used-txt">耗时：<span id="time-used">----.---</span>秒</li>
					<li id="input-count-txt">输入：<span id="input-count">----</span>次</li>
					<li id="text-count-txt">已输入字符：<span id="text-count">----</span>个</li>
					<li id="correct-count-txt">正确：<span id="correct-count">----</span>个</li>
					<li id="wrong-count-txt">错误：<span id="wrong-count">----</span>个</li>
					<li id="apm-txt">打字速度：<span id="apm">----.---</span>字/秒</li>
				<!--看上去你是个会查看源代码的同学啊，或许你应该试着了解一下JavaScript，那是赋予这个网页变化的东西-->
				</ul>
				<button type="button" id="commit" class="submit">提交</button>
			</div>

		</div>

	</div>

	<div class="footer">
			©2017&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计算机科学学院
		</div>
</body>

</html>