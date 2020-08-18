<?php


$data1 = array( 
   'ip' => ip2long($_SERVER['REMOTE_ADDR']),
   'dt' => date("Y-m-d H:i:s")
   ); 
  


$data2 = array( 
   'ip' => ip2long($_SERVER['REMOTE_ADDR']),
   'dt' => date("Y-m-d H:i:s"),
   'likes_so_far' => $likes
   );



if ($dbt == 'likes'){

    $data = $data2;
    $table = 'likes';
   


}
else{
    $data = $data1;
    $table = 'ip';
}
 $this->db->insert($table ,$data);


?>