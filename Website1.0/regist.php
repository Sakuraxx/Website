<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="favicon.ico">
  <title>注册</title>
  <link rel="stylesheet" type="text/css"   href="css/header.css">
  <link rel="stylesheet" type="text/css"   href="css/footer.css">
  <style type="text/css">
  html{
        font-size:14px;
        background-image: url(img/background.jpg);
        background-attachment: fixed;
        background-size: contain;}
  fieldset{
    width:750px; 
    margin: 0 auto;
    border-radius: 20px;
    box-shadow: 7px 7px 5px #888888;  }
  legend{
    font-size:16px;}
  label{
    float:left; 
    width:70px; 
    margin-left:10px;}
  .div{
    margin-top: 150px;
    height: 500px;
  }
  .submit{
    margin-left:160px;
    border-radius: 5px;
    background-color: rgb(253,59,59);
    opacity: 0.7;
    filter: alpha(opacity=70);
    
  }
  .submit:hover
  {
    background-color:rgb(217,223,198);
    opacity: 0.7;
    filter: alpha(opacity=70);
  }
  .input{
    width:150px;
    border-radius: 5px;}
  span{
    color:red;}


  input[type=text], input[type=password] {
  padding: 0 10px;
  width: 300px;
  height: 30px;
  color: #bbb;
  text-shadow: 1px 1px 1px black;
  background: rgba(0, 0, 0, 0.16);
  border: 0;
  border-radius: 5px;
  -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.06);
  box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.06);
}
input[type=text]:focus, input[type=password]:focus {
  color: white;
  background: rgba(0, 0, 0, 0.1);
  outline: 0;
}

  </style>
</head>
<body>
  <div class="header">
      <div class="xueyuan_logo"></div><!--这里放学院logo-->
      <div class="xiehui_logo"></div><!--这里放协会logo-->
    </div>

    <div class="div">
        <fieldset>
          <legend>小可爱快注册啦</legend>
          <form name="RegForm" method="post" action="regist.php" onSubmit="return InputCheck(this)">
          <p>
            <label for="username" class="label">用户名:</label>
            <input id="username" name="username" type="text" class="input" />
            <span>(*必填，3-15字符长度，支持汉字、字母、数字及_)</span>
          </p>
          <p>
            <label for="password" class="label">密 码:</label>
            <input id="password" name="password" type="password" class="input" />
            <span>(*必填，不得少于6位)</span>
          </p>
          <p>
            <label for="repassword" class="label">重复密码:</label>
            <input id="repassword" name="repassword" type="password" class="input" />
          </p>
  		<p>
            <label for="email" class="label">电子邮箱:</label>
            <input id="email" name="email" type="text" class="input" />
            <span>(*必填)</span>
          </p>
  		<p>
  			<label for = "check" class = "label">验证码：</label>
  			<input id = "check" name = "check" type ="text"/><image src = 'image.php'>
  		</p>
          <p>
              <input type="submit" name="submit" value="注册并登陆" class="submit" />
          </p>
          </form>
        </fieldset>
    </div>
    <div class="footer">
      ©2017&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;计算机科学学院
    </div>
  
    <!--检验用户输入是否正确-->
    <script>
		function InputCheck(RegForm)
		{
			if (RegForm.username.value == "")
			{
				alert("用户名不可为空!");
			  RegForm.username.focus();
			  return (false);
			}
			if (RegForm.password.value == "")
			{
				alert("请设定登陆密码!");
			  RegForm.password.focus();
			  return (false);
			}
			if (RegForm.repassword.value != RegForm.password.value)
			{
				alert("两次密码不一致!请重新输入");
				RegForm.repassword.focus();
			  return (false);
			}
			var reg = /^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/;
			if (RegForm.email.value == ""||!reg.test(RegForm.email.value))<!--用正则表达式检验邮箱是否输入正确-->
			{
				alert("邮箱输入有误!");
				RegForm.email.focus();
				return (false);
			}
		}
    </script>
	<?php
		include ('regist_confirm.php');
	?>
</body>
</html>