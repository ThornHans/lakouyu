<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    
    class Spy extends CI_Controller {
        
        
        
        
        
        public function index()
        
        
        {
            
            $file = $_POST['file'];
           
          
     
            
            $this->load->helper('url');
            
            $data['file'] = $file;
            $this->load->view('spy',$data);
          
            
        }
    }

