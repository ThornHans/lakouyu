<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Search extends CI_Controller {

	  public function __construct() 
       {
                parent::__construct();
                 $this->load->library('file');
           }

	public function index()


	{
	   // $this->load->helper('path');
		//$this->load->helper('directory');

//		$this->load->library('file');
	  $q = $_POST['q'];
	  $urls = [];
	 

	  $files = $this->file->get_filelist_as_array('/application/views/',
	  	true,'',false);


      if($files){
		foreach ($files as $file) {
		    // $file = str_replace('/var/www/html/', 'http://lakouyu.com/', $file);

		    // //$data = file_get_contents($file);

		    // if(strpos($data, $q )){
		    	array_push($urls, $file);

		    // }
		    // else{
		    // 	$urls = ['not in'];

		    // }
		    
		}
	}


	else{
		$urls = ['nix'];
	}

      $data['urls'] = $urls;
   
	  $this->load->view('suchen',$data);
	}

	
}

?>
