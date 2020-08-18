<?php
session_start();
include 'config.php';
function goback()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

if ($_SESSION['in']) {
   goback();
}


?>

<!DOCTYPE html>
<html>
<head>
   
	<title></title>
</head>
<body>


	


    
    <h3>请登陆</h3>

    <form action="" method="post">
    	<input type="text" name="usr" placeholder="名字" id="usr" class=""/><br/>
    	
    	<input type="password" name="pwd" placeholder="密码" id="pwd" class=""/><br/>
    	
    	
    	<input type="submit" name="sub" value="登陆" id="submit" class=""/>
    </form>

    <?php
    if (isset($_POST['sub'])) {
    $usr = $_POST['usr'];
    $pwd = $_POST['pwd'];
    if ($usr and $pwd) {
        $db = new DB();
        $table = 'users';
        $keys = ['id'];
        $conkeys = ['usr','pwd'];
        $convals = [$usr, $pwd];
    
        $row = $db->select($table,$keys,$conkeys,$convals);
        if(count($row) > 0) $_SESSION['in'] = true ;
    }
}



?>




</body>
</html>