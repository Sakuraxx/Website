<?php
$db_connect = mysqli_connect('p:localhost','root','xia123456');
mysqli_query($db_connect,'SET NAMES utf8');
if (!$db_connect)
{
	die("连接数据库失败：" . mysql_error());
}
mysqli_select_db($db_connect,'game_website');

?>