<?php
session_set_cookie_params(0);
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
    if ($_SESSION['signed_in']) {
    	header("Location: member.php");
    }
    ?>
    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" name="signup">
    	<input type="text" name="usr" placeholder="名字" id="usr" class=""/><br/>
    	<input type="text" name="mail"  placeholder="电子邮件" id="mail" class=""/><br/>
    	<input type="password" name="pwd" placeholder="密码" id="pwd" class=""/><br/>
    	<input type="password" name="repwd"  placeholder="再次输入密码" id="repwd" class=""/><br/>
    	
    	<input type="submit" name="sub" value="注册" id="submit" class=""/>
    </form>
    <?php
   
    if (isset($_POST['sub'])) {

    	$db = new DB();
    	
    	$usr = $_POST['usr'];
    	$mail = $_POST['mail'];
        $pwd = $_POST['pwd'];
        if ($usr and $mail and $pwd) {
            $vals = [$usr,$mail,$pwd];
            $keys = ['usr','mail','pwd'];
        	echo $db->insert($keys, $vals, 'users');
        }
        
    }
     
    ?>
</body>
</html>