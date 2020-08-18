<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Like_search extends CI_Controller {

 

     
 

	public function index()
       {

        $this->load->database();
        $query_likes = $this->db->query('SELECT likes_so_far FROM likes ORDER BY id DESC LIMIT 1');
        echo $query_likes->row()->likes_so_far;
		
	
		
      }
       

  
}
