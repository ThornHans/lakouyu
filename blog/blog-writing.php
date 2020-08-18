
<!DOCTYPE html>
<html>
<head>
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
						
	<title></title>

</head>
<body>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	         <textarea name="title" rows="3" cols="30" placeholder="title">
        </textarea> 
		<input type="text" name="author" placeholder="author">
		<textarea name="content" rows="20" cols="35" placeholder="content">
	</textarea>	<input type="text" name="intro" placeholder="introduction of the author">
		<input type="text" name="number" placeholder="number">
		<input type="submit" name="submit">
	</form>
</body>
</html>
<?php
include '../config/db.php';
 

if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$author = $_POST['author'];
	$number = $_POST['number'];
	$content = $_POST['content'];
	$intro = $_POST['intro'];
	if (!empty($title) && !empty($author) && !empty($content) && !empty($intro) && !empty($number)) {
		$path = 'syntax/articles/';
		$filename = $number. '.php';
		$f = fopen($path.$filename, 'w+') or die('opening failed');
	

		$date = date("Y-m-d H:i:s");

		$html = "<div>
		<div class='title'><h1>".$title."</h1></div>
                <br/>
		
		<div class='author'>作者：".$author."  </div> <div class='date'>发表时间：".$date."  </div> <div class='views'>阅读次数：</div>
                <hr/>
		<div class='content'>".$content."  </div>
                <br/>
                <div class='intro'>作者介绍：".$intro." </div>

		</div>";
	 	fwrite($f, $html);
		fclose($f);
		echo $html;
		echo $path.$filename;
	        $views = 1;	
		$sql = "INSERT INTO blog(filename,views) VALUES('$filename','$views')";
		$conn->query($sql);
	}
	else{
	echo"something is empty";

        echo $html;}
}
else{
echo 'non triggered';}
?>
