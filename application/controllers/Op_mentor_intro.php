<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Op_mentor_intro extends CI_Controller {


 

	
	public function daria()


	{
	    $this->load->database();


		$this->load->helper('url');
        $this->load->view('top_header');
		$this->load->view('header2');
		$this->load->view('daria_intro');
		$this->load->view('footer');
	}
}
