<?php
include '../config/db.php';
$fs = [];



$n = $_POST['i'];


$filename = 'syntax/ajax/reqs.txt';
if ($n == 0){
 	        $fp = fopen($filename, "w");
                fclose($fp);
		$f = fopen($filename, 'r+');
		fwrite($f, $n);
		$reply = true;
     fclose($f);
}
	

else{
              
	       $f = fopen($filename, 'r+');
	

	
	
		$req = fread($f, filesize($filename));
	
		$req = intval($req)+1;

	
	        
                if ($n != $req) {
	$req -= 1;
	$reply = false;
}
                          
                                   


else {

   		    $reply = true;
	   		
		}
 	        fclose($f);
                $fp = fopen($filename, "w");
                fclose($fp);
                $f = fopen($filename, 'r+');
                fwrite($f, $req);


                fclose($f);

}	
	

if ($reply == true) {
    # code...

    $sql =  "SELECT filename,views FROM blog ORDER BY id DESC LIMIT $n, 1";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
		$filename = $row['filename'];
		$views = $row['views'];
            $path = 'syntax/articles/'.$filename;
             $views += 1;
            $f = fopen($path, 'r');
            $contents = fread($f, filesize($path));
	    fclose($f);
	    $data = json_encode(array($contents,$filename,$views));
          
            $sql = "UPDATE blog SET views= '$views' WHERE filename = '$filename'";
            $conn->query($sql);
	    echo $data;
	  
        }
    }
    else{echo 'nmnr'.$req; }
        

    $conn->close();
    
}
else{echo 'nmnr'.$req; }


  
    
    
?>

