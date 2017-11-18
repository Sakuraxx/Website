(function($) {
    $.fn.jquizzy = function(settings) {
        var defaults = {
            questions: null,
            startImg: 'img/start.gif',
            endText: '已结束!',
            shortURL: null,
            sendResultsURL: null,
            resultComments: {
                perfect: '你是爱因斯坦么?',
                excellent: '非常优秀!',
                good: '很好，发挥不错!',
                average: '一般般了。',
                bad: '太可怜了！',
                poor: '好可怕啊！',
                worst: '悲痛欲绝！'
            }
        };
        var config = $.extend(defaults, settings);     //用传入的内容覆盖填补defaults中没有的项
        if (config.questions === null) {
            $(this).html('<div class="intro-container slide-container"><h2 class="qTitle">Failed to parse questions.</h2></div>');
            return;
        }
        var superContainer = $(this),
        answers = [],//存储用户的答案
        introFob = '	<div class="intro-container slide-container"><a class="nav-start" href="#">请认真完成测试题。准备好了吗？<br/><br/><span><img src="'+config.startImg+'"></span></a></div>	',
        exitFob = '<div class="results-container slide-container"><div class="question-number">' + config.endText + '</div><div class="result-keeper"></div></div><div class="notice">请选择一个选项！</div><div class="progress-keeper" ><div class="progress"></div></div>',
        contentFob = '',
        questionsIteratorIndex,
        answersIteratorIndex;
        superContainer.addClass('main-quiz-holder');//添加了一个类名
        for (questionsIteratorIndex = 0; questionsIteratorIndex < config.questions.length; questionsIteratorIndex++) {
            contentFob += '<div class="slide-container"><div class="question-number">' + (questionsIteratorIndex + 1) + '/' + config.questions.length + '</div><div class="question">' + config.questions[questionsIteratorIndex].question + '</div><ul class="answers">';
            for (answersIteratorIndex = 0; answersIteratorIndex < config.questions[questionsIteratorIndex].answers.length; answersIteratorIndex++) {
                contentFob += '<li>' + config.questions[questionsIteratorIndex].answers[answersIteratorIndex] + '</li>';
            }//列出每道题的几个选项
            contentFob += '</ul><div class="nav-container">';
            if (questionsIteratorIndex !== 0) {
                contentFob += '<div class="prev"><a class="nav-previous" href="#">&lt; 上一题</a></div>';//如果不是第一道题就显示“上一题”标志
            }
            if (questionsIteratorIndex < config.questions.length - 1) {
                contentFob += '<div class="next"><a class="nav-next" href="#">下一题 &gt;</a></div>';//如果不是最后一道题就显示“下一题”标志
            } else {
                contentFob += '<div class="next final"><a class="nav-show-result" href="#">完成</a></div>';
            }
            contentFob += '</div></div>';
            answers.push(config.questions[questionsIteratorIndex].correctAnswer);//将每道题的正确答案放入answers数组
        }
        superContainer.html(introFob + contentFob + exitFob);//将之前的所有拼接在一起，构成一个完整的HTML文档
		//获取HTML元素
        var progress = superContainer.find('.progress'),
        progressKeeper = superContainer.find('.progress-keeper'),
        notice = superContainer.find('.notice'),
        progressWidth = progressKeeper.width(),
        userAnswers = [],
        questionLength = config.questions.length,
        slidesList = superContainer.find('.slide-container');
        function checkAnswers() {//检查答案是否正确
            var resultArr = [],
            flag = false;
            for (i = 0; i < answers.length; i++) {
                if (answers[i] == userAnswers[i]) {
                    flag = true;
                } else {
                    flag = false;
                }
                resultArr.push(flag);//将用户答题的结果存储在该数组里
            }
            return resultArr;
        }
        function roundReloaded(num, dec) {
            var result = Math.round(num * Math.pow(10, dec)) / Math.pow(10, dec);
            return result;
        }
        function judgeSkills(score) {//根据不同分数给出评价
            var returnString;
            if (score === 100) return config.resultComments.perfect;
            else if (score > 90) return config.resultComments.excellent;
            else if (score > 70) return config.resultComments.good;
            else if (score > 50) return config.resultComments.average;
            else if (score > 35) return config.resultComments.bad;
            else if (score > 20) return config.resultComments.poor;
            else return config.resultComments.worst;
        }
        progressKeeper.hide();
        notice.hide();
        slidesList.hide().first().fadeIn(500);
        superContainer.find('li').click(function() {//当点击一个选项后，点击另一个选项时改变答案
            var thisLi = $(this);
            if (thisLi.hasClass('selected')) {
                thisLi.removeClass('selected');
            } else {
                thisLi.parents('.answers').children('li').removeClass('selected');
                thisLi.addClass('selected');
            }
        });
        superContainer.find('.nav-start').click(function() {//点击开始后，载入答题页面
            $(this).parents('.slide-container').fadeOut(500,
            function() {
                $(this).next().fadeIn(500);//.next()方法切换到下一个兄弟元素
                progressKeeper.fadeIn(500);
            });
            return false;
        });
        superContainer.find('.next').click(function() {//切换到下一个题
            if ($(this).parents('.slide-container').find('li.selected').length === 0) {//如果没有选择就会提示“请选择一个选项”
                notice.fadeIn(300);
                return false;
            }
            notice.hide();
            $(this).parents('.slide-container').fadeOut(500,
            function() {
                $(this).next().fadeIn(500);
            });
            progress.animate({
                width: progress.width() + Math.round(progressWidth / questionLength)
            },
            500);
            return false;
        });
        superContainer.find('.prev').click(function() {//切换上一题
            notice.hide();
            $(this).parents('.slide-container').fadeOut(500,
            function() {
                $(this).prev().fadeIn(500);
            });
            progress.animate({
                width: progress.width() - Math.round(progressWidth / questionLength)
            },
            500);
            return false;
        });
        superContainer.find('.final').click(function() {//点击‘完成’，开始执行下面的内容
            if ($(this).parents('.slide-container').find('li.selected').length === 0) {
                notice.fadeIn(300);
                return false;
            }
            superContainer.find('li.selected').each(function(index) {
                userAnswers.push($(this).parents('.answers').children('li').index($(this).parents('.answers').find('li.selected')) + 1);//根据用户选中的选项相对于正确答案的index来判断用户的答案是否正确
            });
			var resultSet = '';
			if (config.sendResultsURL !== null) { 
				var collate = []; 
				var myanswers = ''; 
				//获取用户所答题的答案 
				for (r = 0; r < userAnswers.length; r++) { 
					collate.push('{"questionNumber":"' + parseInt(r + 1, 10) + '", "userAnswer":"' + userAnswers[r] + '"}'); 
					myanswers = myanswers + userAnswers[r]+'|'; 
				}
				progressKeeper.hide();
				//Ajax交互 
				$.getJSON(config.sendResultsURL,{an:myanswers},function(json){ 
					if(json==null){ 
						alert('通讯失败！'); 
					}else{      
						var corects = json['res']; 
						$.each(corects,function(index,array){ 
							resultSet += '<div class="result-row">' + (corects[index] === 1 ? "<div class='correct'>#"+(index + 1)+"<span></span></div>": "<div class='wrong'>#"+(index + 1)+"<span></span></div>")+'</div>'; 
							           
						});
						resultSet = '<h2 class="qTitle">' + judgeSkills(json.score) + '<br/> 您的分数： ' + json.score + '</h2><div class="jquizzy-clear"></div>' + resultSet + '<div class="jquizzy-clear"></div><button><a href="index.php">结束</a></button>'; //buttom to index.php
									 
									 
						superContainer.find('.result-keeper').html(resultSet).show(500); 
					}     
				}); 
			}
        });
    };
})(jQuery);