<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Tutors extends CI_Controller {


 

	
	public function index()


	{
	    $this->load->database();
		
		$this->load->helper('url','blocks_helper');
		$this->load->view('tutors');
	}
}
