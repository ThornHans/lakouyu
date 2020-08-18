<?php
session_set_cookie_params(0);
session_start();

include "config.php";
include '../head.php';
?>

<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

	<title>高登&洛杉矶英语——考试中心</title>

	<style type="text/css">
		
	    #quiz{
	    	font-size: 1.8em;
	    	margin-left: 15%;

	    }
		#test_btn{
		  background-color: #4CAF50;
		  border: none;
		  color: white;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 4px 2px;
		  cursor: pointer;
		  margin-left: 33hjj%;
	}
        
        .right{
        	color:green;
        }

        .wrong{
        	color:red;
        }
        #top{
        	font-size: 2.5em;
        	text-align: center;
        	color: grey;
        }

        #top input{
        	color:blue;
        	height: 3em;
        	width: 20em;
        	font-size: 0.5em;
        	color:blue;
        }

        input[type='radio']{
        	height: 3em;
        	width:3em;
        }


	</style>
</head>

<?php

include '../neck.php';

?>


<script type="text/javascript">
	admin = false;
</script>


<?php 

if ($_SESSION['in']){


	$in = true;
	echo '<script type="text/javascript">
	admin = true;

    </script>
   ';
}
$dir = '9/';
$files = scandir($dir,1);

?>
<br/>

<div class='container-fluid'>
<div id="top">请输入您的姓名：<input type='text' name='name' placeholder="请输入姓名"></input>
</div>

<hr/>
<div class="test-content" id="quiz">
<?php
include $dir.$files[2];



?> <div><button id="test_btn">交卷</button></div>
</div>
</div>
<script type="text/javascript">
	if (admin) {
		html = '';
		$('#quiz').children().each(function(index){
			if($(this).attr('type') == 'hidden' && $(this).attr('value') == ''){     
				name = $(this).attr('name');
				str = '<input type="text" class="'+name+'" placeholder="insert a key"/>'; 
			    $(this).after(str); 
			    $('.'+name).focusout(function(){
			    	v = $(this).val();
			    	$(this).prev().attr('value', v);
			    	html = $('#quiz').html();
			    	//console.log(html);
			    	$(this).attr('style','display:none;');
			    	$.ajax({
					  type: "POST",
					  url: 'testing_center.php',
					  data: {html:html},
					  success: function(res){
					  }
		            });
			    	
			    }
	     );

			}
		});
	}
	else{
	    withName = false;
        $('#top input').focusout(function(){
        	testTaker = $('#top input').val();
        	
        	if (testTaker) {
        		withName = true;
        	}
        });

		$('#test_btn').click(function(){

			 if (withName) {


			checked = $('#quiz').children('input[type="radio"]:checked').length;
			
			if (checked>0) {
				
				msg = '您的名字是'+testTaker+', 你做了'+checked+'题，确定交卷吗？';
			}
			else{
				msg = '您的名字是'+testTaker+', 你一个题也没做，想交白卷吗？';
			}

			sub = confirm(msg);
			
			qn = $('#quiz').children('input[type="hidden"]').length;
		
			rn = 0;     // number of right answers
			index = 1;
			sn = 0; // number of the seleted
            
            if (sub) {

			while(index>0){
				
				nextLen = $('input[name="'+index+'"][type="radio"]').nextAll().length;
				
				if (nextLen <=5) {
					break;
				}

				s = 'input[name="'+index+'"][type="radio"]:checked';
				
				rval = $(s).val();    //selected radio values
				
				if(rval){
					sn ++;

					
					s = 'input[name="'+index+'"][type="hidden"]';
					hval = $(s).val();

			
					if (rval == hval) {
						
						index++;
						$(s).siblings("p."+index).remove();
						html = '<p class="'+index+'" style="color:green">回答正确 Correct!<p>';
                        $(s).after(html);
                        rn++;
                        
						
					}
					else{
						index++;
						$(s).siblings("p."+index).remove();
						html = '<p class="'+index+'" style="color:red">回答错误 Incorrect!<p>';
                        $(s).after(html);
                       
					}
		
					
				}
				else{
					console.log('no answer selected!!');
                    index++;
				}
			}
		}

		

		if (sub) {
			testTaker = $('#top input').val();
			
			accuracy = 100*rn/qn;
			grade = accuracy/100;
			$('.result').remove();
			html = '<p class="result" style="color:red">在'+qn+'个题中，你回答对了'+rn+'个，正确率是'+accuracy+'%</p>';
			$('#test_btn').parent().before(html);

            $.ajax({
					  type: "POST",
					  
					  url:"test_handler.php",
					  data: {'n':testTaker, 'score':grade},
					  success:function(res){
					  console.log(res);
					  }
					 
		            });

			

		}
	}

else{
	alert('无名英雄，您还没有输入您的尊姓大名！');
	document.getElementById("top").scrollIntoView();
	$('#top input').focus();
	}
	});
	
}

</script>

<?php include '../foot.php';?>



</body>
</html>