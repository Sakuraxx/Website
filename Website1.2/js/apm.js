var question = "The Communists turn their attention chiefly to Germany, because that country is on the eve of a bourgeois revolution that is bound to be carried out under more advanced conditions of European civilisation and with a much more developed proletariat than that of England was in the seventeenth, and France in the eighteenth century, and because the bourgeois revolution in Germany will be but the prelude to an immediately following proletarian revolution. In short, the Communists everywhere support every revolutionary movement against the existing social and political order of things. In all these movements, they bring to the front, as the leading question in each, the property question, no matter what its degree of development at the time. Finally, they labour everywhere for the union and agreement of the democratic parties of all countries. The Communists disdain to conceal their views and aims. They openly declare that their ends can be attained only by the forcible overthrow of all existing social conditions. Let the ruling classes tremble at a Communistic revolution. The proletarians have nothing to lose but their chains. They have a world to win. Working Men of All Countries, Unite!";
var hint = "你们呐，不要老想着搞个大新闻，把我们批判一番。你们呐，too young too simple, sometimes naive!";
var answer = "";
var diffHTML;
var keyCount = 0;
var input = 0;
var correct = 0;
var wrong = 0;
var startTime;
var notStart = true;
var timePassed;
var currTime;
var apm;
var cheatFlag = false;

$("document").ready(function()
{
	console.log('请发送邮件至scncgz@gmail.com，在标题注明：计算机协会-来自console');
	$("#origin").text(question);
	$('#text').val(null);
	$('#text').bind('input',AnswerChanged);
	$('#text').bind('paste',AntiCheat);
	$('#commit').bind('click',PostAnswer);
});

function AntiCheat()
{
	cheatFlag = true;
	return;
}

function AnswerChanged()
{
	if(cheatFlag)
	{
		$('#text').val(hint);
		cheatFlag = false;
		return;
	}
	if(notStart)
	{
		notStart = false;
		startTime = new Date().getTime();
		timePassed = 0;
	}
	keyCount++;
	currTime = new Date().getTime();
	timePassed = currTime - startTime;
	apm = input/(timePassed/1000);
	answer = document.getElementById('text').value;
	CheckDifference();
	DrawHTML();
	RefreshData();
}

function CheckDifference()
{
	answer = $('#text').val();
	input = answer.length;
	for(var p = 0; p < answer.length; p++)
	{
		if(answer[p] != question[p]) break;
	}
	correct = p;
	wrong = input - p;
}

function DrawHTML()
{
	if(input == 0)
	{
		diffHTML = question;
	}
	else
	{
		if(correct != 0)
		{
			diffHTML = '<span id="correct">'+question.substr(0,correct)+'</span>';
		}
		else
		{
			diffHTML = '';
		}
		if(wrong != 0)
		{
			diffHTML += '<span id="wrong">'+question.substr(correct,wrong)+'</span>'+question.substr(correct+wrong);
		}
		else
		{
			diffHTML += question.substr(correct);
		}
	}
	$("#origin").html(diffHTML);
}

function RefreshData()
{
	$('#time-used').text(timePassed/1000);
	$('#input-count').text(keyCount);
	$('#text-count').text(input);
	$('#correct-count').text(correct);
	$('#wrong-count').text(wrong);
	$('#apm').text(apm);
}

function PostAnswer()
{
	if(correct===question.length&&wrong===0)
	{
		//execute commit
		$.post("apm_reciever.php",{"time":timePassed,"keydown":keyCount,"length":question.length},function(data,status){PostCallback(data,status)});
	}
	else
	{
		alert('please finish your text');
	}
}

function PostCallback(data,status)
{
	console.log(data,status);
	if(status!='success') alert('commit failed, please try again later');
	else
	{
		if(data==='login') window.location.href='login.php';
		else if(data==='finish') window.location.href='rank.php';
		else alert('an error occured, please try again later');
	}
}