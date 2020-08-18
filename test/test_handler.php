<?php
// $file = $dir.$files[2];
// $html = $_POST['html'];
include 'config.php';


$name = $_POST['n'];

$score = $_POST['score'];



//echo $score;

// echo $score;
// if ($html) {
// 	$h = fopen($file,'w+');
//     fwrite($h, $html);
//     fclose($h);
	
// }

if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	{
	  $ip=$_SERVER['HTTP_CLIENT_IP'];
	}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is passed from proxy
{
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
  $ip=$_SERVER['REMOTE_ADDR'];
}

$ip = ip2long($ip);

echo $ip;
$dt = date("Y-m-d H:i:s"); 

$keys = ['score','name', 'ip', 'dt'];

if ($name and $score) {
	
	$vals = [$score, $name, $ip, $dt];
    $table = 'grade';
	$db = new DB();
	$db->insert($keys,$vals,$table);
	
}

else{
	echo"failed";
}




?>
