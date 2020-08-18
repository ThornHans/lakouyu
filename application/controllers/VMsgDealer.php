<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class VMsgDealer extends CI_Controller {
public function __construct() {
       parent::__construct();
       $this->load->database();
       # $this->load->helper('anti_xss_helper');
    }	
	public function getMsg()


{
    $tz_object = new DateTimeZone('Asia/Hong_Kong');
    //date_default_timezone_set('');

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $dt = $datetime->format('Y\-m\-d\ G:i:s');

  
    $name = $this->db->escape($this->input->post('name'));
    $qq = $this->db->escape($this->input->post('qq'));
    $msg = $this->db->escape($this->input->post('msg'));
    # $name = anti_xss($name);
    # $qq = anti_xss($qq);
    # $msg = anti_xss($msg);


    if (!empty($name) and !empty($qq) and !empty($msg)) {

      $data = array(
        'name' => $name,
        'qq' => $qq,
        'msg' => $msg,
        'time' => $dt
      );
    }

    $this->db->insert('visitor_msg',$data);
    $this->load->view('/vmRep');
	}

  public function sendEmail(){

    if($this->input->post('send_email') == 'send_email'){
    $this->load->library('email');
             
              $config['upload_path'] = './uploads/';
              $config['allowed_types'] = 'gif|jpg|png';
              $config['max_size'] = '100000';
              $config['max_width']  = '1024';
              $config['max_height']  = '768';

             $this->load->library('upload', $config);
             $this->upload->do_upload('attachment');
             $upload_data = $this->upload->data();
             
             $this->email->attach($upload_data['full_path']);
             $this->email->set_newline("\r\n");
             $this->email->set_crlf("\r\n");
             $this->email->from('only4ututorials@gmail.com'); // change it to yours
             $this->email->to($this->input->post('email_id')); // change it to yours
             $this->email->subject($this->input->post('subject'));
             $this->email->message($this->input->post('body'));
             if ($this->email->send()) {
                 echo "Mail Send";
                 return true;
             } else {
                 show_error($this->email->print_debugger());
             }
    }else{
      $this->load->view('email_view');
    }

  }
}
