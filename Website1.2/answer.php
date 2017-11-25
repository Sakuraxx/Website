<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['valid_name'])or!isset($_SESSION['valid_pwd']))
	{
		echo "YOU ARE NOT ALLOWED GET IN!";
		exit;
	}
	include ('conn.php');
	$sql = "select score from users where name = '$_SESSION[valid_name]'";
	$result = mysqli_query($db_connect,$sql);
	$row = mysqli_fetch_array($result);
	if ($row['score']!=null)//不能重复答题
	{
		header("Location:index.php");
	}
	$_SESSION['test1'] = 1;
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="favicon.ico">
	<title>趣味答题网站</title>
	<link rel="stylesheet" type="text/css"   href="css/answer.css">
	<script src="js/jquery-3.2.1.min.js"></script> 
	<script src="js/quiz1.js"></script> 
	<link rel="stylesheet" href="css/styles.css" /> 
	<link rel="stylesheet" type="text/css"   href="css/header.css">
	<link rel="stylesheet" type="text/css"   href="css/footer.css">
	<link rel="stylesheet" type="text/css"   href="css/css.css">
</head>
<body class="backgroundchange">
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
		
		<div class="container">
			<div id="quiz-container">
				<?php 
				include_once("conn.php");//连接数据库 
				 
				$sql = "select * from quiz order by id asc"; 
				$query = mysqli_query($db_connect,$sql); //查询数据 
				while($row=mysqli_fetch_array($query)){ 
					$answer = explode('|',$row['answer']); //将答案选项分开 
					$arr[] = array( 
						'question' => $row['id'].'、'.$row['question'], //题目 
						'answers' => $answer  //答案选项 
					); 
				} 
				$json = json_encode($arr); //转换json格式 
				?>
				<script>
				$(function(){ 
					$('#quiz-container').jquizzy({ 
						questions: <?php echo $json;?>, //试题信息 
						sendResultsURL: 'data.php' //结果处理地址 
					}); 
				});
				</script>
			</div>
			
		</div>
		
		<div class="footer">
			©2017&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计算机科学学院
		</div>
	</div>
</body>
</html>