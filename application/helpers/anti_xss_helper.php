<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

   


  


   public function anti_xss($data){
   	return $this->security->xss_clean($data);
   }
    
   





 ?>