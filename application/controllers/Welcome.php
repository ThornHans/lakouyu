<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {


 

	
	public function index()


	{

		$likes = [];
		$ip_list = [];
		$this->load->library('session');

	    $this->load->database();

		$this->load->helper('url');
	    
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
	    
	    $query_likes = $this->db->query('SELECT likes_so_far FROM likes ORDER BY id DESC LIMIT 1');
	    $query_ip = $this->db->query('SELECT ip FROM likes');

	   foreach ($query_ip->result() as $row)
	   {
			$dip = $row->ip;
		    array_push($ip_list, $dip);
		        
	   }

	    $likes = $query_likes->row()->likes_so_far;
	    $data['likes'] = $likes;
	    if (in_array($ip,$ip_list)) {
	    	$liked = "yes";
	    	
	    }
	    else{
	    	$liked = "no";

	    }
	    $_SESSION['liked'] = $liked;
	    $_SESSION['likes'] = $likes;
		
	    $data['liked'] = $liked;
	    $data['llist'] = $ip_list; ///
	    

	    $this->load->view('welcome_msg',$data);

	  
	}
}
