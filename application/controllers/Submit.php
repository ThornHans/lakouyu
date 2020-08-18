<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Submit extends CI_Controller {

 public function __construct() {
       parent::__construct();
       $this->load->database();
        $this->load->helper('url');
        $this->load->library('email');
     }

     
 

 public function email()
       {

        

         
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
   
      
      $tz_object = new DateTimeZone('Asia/Hong_Kong');
     

    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $dt = $datetime->format('Y\-m\-d\ G:i:s');
  


	       $email = $this->input->post('email');

         $config['mailtype'] = 'html';
         $config['charset'] = 'utf-8';
         $this->email->initialize($config);
         $this->email->from('lonekode@icloud.com', 'Hansen');
         $this->email->to($email);
         # $this->email->cc('another@another-example.com');
         # $this->email->bcc('them@their-example.com');
        
         $this->email->subject('欢迎接收高登&天使国际新闻');
         $this->email->message('尊敬的用户您好！<br/>我们将定期向您的邮箱发送高登&天使国际英语的重要新闻。<br/>谢谢！');

         $this->email->send();

	       $email = $this->db->escape($email);


         $data = array('email'=>$email,
                       'dt'=>$dt,
                       'usr' => $ip
         );
        
         $this->db->insert('email',$data);


         
	   
		
        
           # $data['email'] = $email;
          
           
        $this->load->view('msg',$data);
      
        
		
      }
       

  public function likes()

	{
          $this->load->database();

          $this->load->helper('url');

          $this->load->library('session');
	   

   if ($_POST['v']!='')
	 {


            $v = $_POST['v'];
            

            $data['likes'] = $v;
	          $data['dbt'] ='likes';

	          
	   }
     
     else{

               $data['likes'] = 'empty';

     }
          $this->load->view('u_info',$data);
	}

  public function signup(){

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
      $tz_object = new DateTimeZone('Asia/Hong_Kong');
      $datetime = new DateTime();
      $datetime->setTimezone($tz_object);
      $dt = $datetime->format('Y\-m\-d\ G:i:s');
      $username = $this->input->post('username');
      $qq = $this->input->post('qq');
      $password = $this->input->post('pwd');
      $level = $this->input->post('level');
      $email = $qq.'@qq.com';
      $token = openssl_random_pseudo_bytes(16);
       
      //Convert the binary data into hexadecimal representation.
      $token = bin2hex($token);
      $token .= $username;

      $link = "https://englocal.com/submit/verify/".$username."/".$token;
      if (!empty($email)) {
         $config['mailtype'] = 'html';
         $config['charset'] = 'utf-8';
         $this->email->initialize($config);
         $this->email->from('lonekode@icloud.com', 'Hansen');
         $this->email->to($email);
         # $this->email->cc('another@another-example.com');
         # $this->email->bcc('them@their-example.com');
        
         $this->email->subject('请验证您的电子邮件');
         $this->email->message('请点击该链接'.$link.' 验证您的邮箱地址。<br/>谢谢！');

         $this->email->send();

       }
         $email = $this->db->escape($email);
          $username = $this->db->escape($username);
           $level = $this->db->escape($level);
            $password = $this->db->escape($password);
             $qq = $this->db->escape($qq);
         $data = array('email'=>$email,
                       'dt'=>$dt,
                       'usr' => $username,
                       'pwd' => $password,
                       'qq' => $qq,
                       'level' => $level,
                       'ip' => $ip,
                       'token' => $token

         );
        
         $this->db->insert('signup',$data);

           
        // $this->load->view('msg',$data);
      
  }

  public function verify(){
    $username = $this->uri->segment(3);
    $token = $this->uri->segment(4);
    $username = $this->db->escape($username);

    $this->db->select('token');
    
    $this->db->from('signup');   
    $this->db->where('usr', $username);
    // $t = $this->db->get()->result();
    $toks = $this->db->get()->result();
    

    foreach ($toks as $tok) {

      $t= $tok->token;
    }

    if($token == $t ){
      $data['username'] = trim($username,"'");
      $this->load->view('verified', $data);
    }
    else{
      $data['username'] = $t;
      $this->load->view('verified',$data);
    }

}
  public function verify_name(){

    $usr = $_POST['usr'];
    $usr = $this->db->escape($usr);
    
    if(!empty($usr)){
    $this->db->select('usr');
    $this->db->from('signup');
    $this->db->where('usr',$usr);
   
    $usrs = $this->db->get()->result();



    // foreach ($usrs as $u) {

    //   $user= $u->usr;
    // }

  }

    if (sizeof($usrs) != 0) {

      $msg = "na";
      
    }
    
  

    
      $array = array('msg'=>$msg);

     
  echo json_encode($array);

      
}

  public function verify_qq(){

    $qq = $_POST['qq'];
    $qq = $this->db->escape($qq);
    
    if(!empty($qq)){
    $this->db->select('qq');
    $this->db->from('signup');
    $this->db->where('qq',$qq);
   
    $qqs = $this->db->get()->result();

  }

    if (sizeof($qqs) != 0) {

      $msg = "na";
      
    }
    $array = array('msg'=>$msg);

     
    echo json_encode($array);

      
}


}
?>
