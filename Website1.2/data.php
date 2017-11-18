<?php
session_start();
$name = $_SESSION['valid_name'];
include("conn.php"); //连接数据库 
$data = $_REQUEST['an']; //获取答题信息 
$answers = explode('|',$data); //分析数据 
$an_len = count($answers)-1; //题目数 
 
$sql = "select correct from quiz order by id asc"; 
$query = mysqli_query($db_connect,$sql); //查询表 
$i = 0; 
$score = 0; //初始得分 
$q_right = 0; //答对的题数 
while($row=mysqli_fetch_array($query)){ 
    if($answers[$i]==$row['correct']){ //比对正确答案 
        $arr['res'][] = 1; //正确 
        $q_right += 1; //正确答题数+1 
    }else{ 
        $arr['res'][] = 0; //错误 
    } 
    $i++; 
} 
$arr['score'] = round(($q_right/$an_len)*100); //计算总得分
$in_sql = "update users  set score=".$arr['score']." where name ='$name'";
$result = mysqli_query($db_connect,$in_sql);
echo json_encode($arr);


