<?php

$this->db->select("ip"); 
  $this->db->from('ip');
  $query = $this->db->get();
  foreach ($query as $ip){
      echo $ip[11];
  }
  

  ?>