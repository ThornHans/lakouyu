

<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <textarea name="raw" placeholder="raw materials" rows="4" cols="50"></textarea>
    <input type="text" name="grade" value="" placeholder="grade">
    <input type="text" name="dt" value="" placeholder="dt">

    <br/>
    <input type="submit" name="testmaker" value="make a test paper">
</form>



<?php




$str = $_POST['raw'];
$grade = $_POST['grade'];
$dt = $_POST['dt'].'.php';


// $str = "11. The hall ______ as a classroom for 60 students.

// A. used to being used B. was used to being used 
// C. used to be used D. was used to be used

// Key： C 这个大厅过去曾被用来做60人的教室。

// 解析：陷阱：A、B和D （1）动词use的重点句型有：used to do(过去常常）be used to do (被用来做某事） be used as (被用来做..) be used to doing sth. (习惯于做某事）

// （2）本句是把句型：used to do和be used as结合在一起使用。意为：这大厅间过去曾被用来做容纳60名学生的教室。故答案选 C

// 12.Have you ever seen ________ dog before?

// A. a such big B. such big a C. so big a D. a so big

// Key： C. so +形容词+a+可数名词单数 = such a +形容词+可数名词单数

// 13.There are many flowers on ________ side of the square.

// A. either B. any C. all D. both

// Key：B square （正方形）有四条边，side 是单数形式，所以用any

// 14. Nothing that she said in the meeting _____ to be of any use.

// A. prove B. proved C. proving D. to prove

// Key：B 他在会上所说的证明没有什么用。 proved在这里作谓语

// 15. Which do you enjoy ____ your weekend, climbing or boating?

// A. spending B. being spent C. spend D. to spend

// Key： D 你想那种活动度过周末， 爬山还是划船？ to spend 做目的状语。

// 16.The man you referred to _____ just now.

// A. comes B. come C. coming D. came

// Key： D 你提到的那个男人刚才来了。 came 作谓语 因为有just now时间状语，故用过去时。 you referred to修饰 man 作定语从句。

// 17. How excited they are! The news they have been looking forward _______ at last.

// A. to has come B. to have come C. to having come D. has come

// Key： A 他们太激动了！他们一直期待的消息终于来了。 look forward to 是固定搭配。

// 18. Mary and Jane are good friends. They _______ in the same school.

// A. all are B. are all C. both are D. are both

// Key：D 玛丽和珍妮是好朋友。她们两个都在同一所学校。both一般放在be动词、情态动词或助动词之后，行为动词之前。

// 19.Shanghai is larger and ______city in China.

// A, any B. any other C. other D. another

// Key：B 在中国上海是最大的城市。Shanghai is the largest city in China. =Shanghai is larger and other city in China.

// 20. Susan was unhappy when she heard the result of the exams _______?

// A. was she B. wasn’t she C. does she D. didn’t she

// Key: B. 当苏珊娜听到考试的结果是很不开心。 英语中 unhappy 不能当做否定词使用。 当句中有由加否定前缀或后缀构成的否定词时，后面的反意疑问句不受其影响，仍用否定形式。


// 下面布置21-30题，同学们接着练习哦！加油！

// 第三组

// 21. It’s our duty to ______ people ________ too many trees.

// A. stop; cutting down B. prevent；to cut down C. keep; cutting down D. make; cut down

// 22.----Will you please show me how to do the role play exercise?

// ----Sure. Now let me tell you _____ first.

// A. which to do B. how to do C. when to do D. what to do

// 23. Is this factory ______ some foreign friends visited last Friday?

// A. that B. where C. which D. the one

// 24. Is this the factory _____ he worked ten years ago?

// A. that B. where C. which D. the one

// 25. The principal wanted to give the work to ____ she believed had a strong sense of duty.

// A whoever B whomever C who D those

// 26. ---How long do you think it is _____ he arrived here ? ---no more than half a week .

// A when B before C after D since

// 27. The country life he was used to _____ greatly since the opening policy.

// A changed B has changed C changing D having changed

// 28. When he woke up , the man found himself in a small house and everything he _ .

// A lay , had been stolen B lay , was stolen C lying , had stolen D lying , had been stolen

// 29. He has________here for almost a year.He has made many good friends.

// A.left B.come C.been D.gone
//   ";
preg_match_all("/\d+\.+((.|\n)*?)((Key)+|D\.?.*?\n)/", $str, $matches);
$arr = [];
$array = [];
$general_array = $matches[0];

preg_match_all('/Key.+?([ABCD])/', $str, $key);
$general_key = $key[1];
for ($i=0; $i < count($general_array); $i++) { 
    $buffer = $general_array[$i];
    $buffer = preg_replace('/^\n+|^[\t\s]*\n+/m', '', $buffer);
    preg_match_all('/\d+\.((.|\n)*?)\nA/', $buffer, $quiz);
   
    preg_match_all('/\n.*?A.*?\n?B.*?\n?C.*?\n?D.+?\n/', $buffer, $answer);
    preg_match_all('/[ABCD]?\.?\,?(.+?)\n?([ABCD]|$)/', $answer[0][0], $a);
     if (!empty($general_key))
    array_push($quiz[1], $general_key[$i]);
    $arr = array_merge($quiz[1], $a[1]);
    array_push($array, $arr);
   
    
}


// print_r($array);

$html ="";

for ($i=0; $i < count($array) ; $i++) { 
    $n = $i+1;
    $html .= '
    <p>'.$n.'. '.$array[$i][0].'</p>'
    .$array[$i][2].'<input type="radio" name="'.$n.'"" value="A"><br/>'
    .$array[$i][3].'<input type="radio" name="'.$n.'" value="B"><br/>'
    .$array[$i][4].'<input type="radio" name="'.$n.'" value="C"><br/>'
    .$array[$i][5].'<input type="radio" name="'.$n.'" value="D"><br/>';
               

   if (empty($array[$i][1])) {
    $html .= '<input type="hidden" name="'.$n.'"/>';
   }

   $html .= '<input type="hidden" name="'.$n.'" value="'.$array[$i][1].'">';
   
  

}

$html .='<br/><button id="overall">交卷</button>';
$path = $grade.'/'.$dt;
$fh = fopen($path, 'w+');
fwrite($fh, $html);
echo $html;
?>




