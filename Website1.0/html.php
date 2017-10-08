<html>
<head>
<title>jquery</title>
<script src="jquery-3.2.1.min.js"></script> 
<script src="quiz.js"></script> 
<link rel="stylesheet" href="styles.css" /> 

</head>
<body>
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
<div id="quiz-container">
<script>
$(function(){ 
    $('#quiz-container').jquizzy({ 
        questions: <?php echo $json;?>, //试题信息 
        sendResultsURL: 'data.php' //结果处理地址 
    }); 
});
</script>
</div> 
</body>
</html>