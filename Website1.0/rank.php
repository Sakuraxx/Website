<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['valid_name'])or!isset($_SESSION['valid_pwd']))
	{
		echo "YOU ARE NOT ALLOWED GET IN!";
		exit;
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="favicon.ico">
	<title>趣味答题网站</title>
	<link rel="stylesheet" type="text/css"   href="css/rank.css">
	<link rel="stylesheet" type="text/css"   href="css/header.css">
	<link rel="stylesheet" type="text/css"   href="css/footer.css">
</head>
<body class="backgroundchange">
	<div class="main">
		<div class="header">
			<div class="xueyuan_logo"></div>
			<div class="xiehui_logo"></div>
			<div class="title">
				龙虎榜
			</div>
		</div>

		<div class="user-information">
			<div class="user">
				<a href="logout.php">退出登录</a>&nbsp;&nbsp;
				小可爱:<?php echo$_SESSION['valid_name'];?>
				&nbsp;&nbsp;
				<a href="index.php">返回主页</a>
			</div>
		</div>
		
		<div class="container">
			<?php
				require ('conn.php');
				$sql = "select name,score from users order by score desc ";
				$result = mysqli_query($db_connect,$sql);
				echo "<table> ";
				$i=1;
				while ($row = mysqli_fetch_array($result))
				{
					if($row['score']==null)
					{
						$row['score']=0;
					}
					echo "<tr><td align='center'>"."NO. ".$i."		"."</td><td>".$row['name']."</td><td>".$row['score']."分"."</td></tr>";
					$i++;
				}
				echo "</table>";
				$sql = "select username,apm from apm order by apm desc ";
				$result = mysqli_query($db_connect,$sql);
				echo "<table> ";
				$i=1;
				while ($row = mysqli_fetch_array($result))
				{
					if($row['apm']==null)
					{
						$row['apm']=0;
					}
					echo "<tr><td align='center'>"."NO. ".$i."		"."</td><td>".$row['username']."</td><td>".$row['apm']."</td></tr>";
					$i++;
				}
				echo "</table>";

				$name = $_SESSION['valid_name'];
				$sql = 'select users.name, users.score, apm.apm from users,apm where users.name = apm.username and users.name = "'.$name.'"' ;
				$result = mysqli_query($db_connect,$sql);
				$row =  mysqli_fetch_array($result);
				if($row!=false)
				{
					echo '<p>'.$row['name'].', your rank in test1:'.$row['score']. 'and apm in test2:'.$row['apm'].'</p>';
				}
			?>
		</div>
		
		<div class="footer">
			©2017&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计算机科学学院
		</div>
	</div>
</body>
</html>