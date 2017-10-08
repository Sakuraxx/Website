
//验证用户名和密码是否为空
function $(id){return document.getElementById(id)}

function user_input()
{
	var name = $("id").value;
	var password = $("password").value;
	if(name=="" || password=="")
	{
		alert("用户名或密码不能为空！");
		return false;
	}
	else
	{
			return true;
	}	
}