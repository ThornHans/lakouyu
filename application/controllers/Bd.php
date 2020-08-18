<?php
defined('BASEPATH') OR exit('No direct script access allowed');
   
class Bd extends CI_Controller {
   
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->database();
    }
    
    /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function sv()
    {
        $data['result'] = $this->db->get("events")->result();
   
        foreach ($data['result'] as $key => $value) {
            $t = $value->title;
            $l = $value->lecturer;
            $cn = $value->course;
            $ta = $value->TA;
            $ca = $value->campus;
            $cl = $value->classroom;
            $data['data'][$key]['backgroundColor'] = "#00a65a";
            $data['data'][$key]['title'] = "<".$cn."> <".$t."> <".$l."> <".$ta."> <".$ca."> <".$cl.">";
            $data['data'][$key]['start'] = $value->start_date;
            $data['data'][$key]['end'] = $value->end_date;
        }
        $this->load->view('sv', $data);
    }

    public function insert()
    {
        $title = $this->input->post("t");
        $lecturer = $this->input->post("l");
        $TA = $this->input->post("ta");
        $campus = $this->input->post("ca");
        $classroom = $this->input->post("cl");
        $course = $this->input->post("cn");
        $start = $this->input->post("start");
        $end = $this->input->post("end");
        $type = $this->input->post("ty");

        $data = array(
        'title' => $title,
        'lecturer' => $lecturer,
        'TA' => $TA,
        'campus' => $campus,
        'classroom' => $classroom,
        'course' => $course,
        'start_date' => $start,
        'end_date' => $end,
        'type'   => $type
        );

        $this->db->insert('events', $data);
           
        
    }


}
