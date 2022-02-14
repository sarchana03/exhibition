<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Live_class_model extends CI_Model {

	function __construct(){
        parent::__construct();
    }

    /*>>>>>>>>> Function to save Jitsi to Table >>>>>>>>> */
    function createNewJitsiClassFunction(){

        $arrayLive = array(
            'exhibition_id' => $this->session->userdata('exhibition_id'),
            'title'             => html_escape($this->input->post('title')),
            'visitor_id'        => html_escape($this->input->post('visitor_id')),
            'meeting_date'      => strtotime($this->input->post('meeting_date')),
            'description'       => html_escape($this->input->post('description')),
            'start_time'        => html_escape($this->input->post('start_time')),
            'end_time'          => html_escape($this->input->post('end_time')),
            'status'            => html_escape($this->input->post('status')),
            'room'              => md5(date('d-m-Y H:i:s')).substr(md5(rand(1000000, 2000000)), 0, 10),
            'publish_date'      => strtotime(date('Y-m-d')),
            'user_id'           => $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id')

        );

        $arrayLiveToCalendar = array(
            // 'exhibition_id' => $this->session->userdata('exhibition_id'),
            'title'             => html_escape($this->input->post('title')),
            // 'class_id'          => html_escape($this->input->post('class_id')),
            // 'section_id'        => html_escape($this->input->post('section_id')),
            'visitor_id'        => html_escape($this->input->post('visitor_id')),
            'color'        => html_escape($this->input->post('color')),
            'start_date'        => html_escape($this->input->post('start_date')),
            'end_date'        => html_escape($this->input->post('end_date')),
            // 'meeting_date'      => strtotime($this->input->post('meeting_date')),
            'description'       => html_escape($this->input->post('description')),
            'start_time'        => html_escape($this->input->post('start_time')),
            'end_time'          => html_escape($this->input->post('end_time')),
            'status'            => html_escape($this->input->post('status')),
            // 'room'              => md5(date('d-m-Y H:i:s')).substr(md5(rand(1000000, 2000000)), 0, 10),
            // 'publish_date'      => strtotime(date('Y-m-d')),
            // 'user_id'           => $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id')

        );

		$sql = "select * from jitsi order by jitsi_id desc limit 1";
		$return_query = $this->db->query($sql)->row()->jitsi_id + 1;
		$arrayLive['jitsi_id'] = $return_query;
        $this->db->insert('jitsi', $arrayLive);


        $sql = "select * from calendar order by id desc limit 1";
		$return_query = $this->db->query($sql)->row()->id + 1;
		$arrayLiveToCalendar['id'] = $return_query;
        $this->db->insert('calendar', $arrayLiveToCalendar);

        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('meeting_date');

        if($sendPhone == '1'){

            $visitors = $this->db->get_where('visitor', array('group_id' => $this->input->post('group_id')))->row();
            $visitor_parent_id = $visitors->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $visitor_parent_id))->result_array();
            $visitor_array = $this->db->get_where('visitor', array('group_id' => $visitors->group_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($visitor_array as $key => $visitor){
                $recieverPhoneNumber = $visitor['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }




    /*>>>>>>>>> Function to upadte Jitsi to Table >>>>>>>>> */
    function updateJitsiClassFunction($param2){

        $arrayLive = array(

            'title'             => html_escape($this->input->post('title')),
            // 'class_id'          => html_escape($this->input->post('class_id')),
            // 'section_id'        => html_escape($this->input->post('section_id')),
            'visitor_id'        => html_escape($this->input->post('visitor_id')),
            'meeting_date'      => strtotime($this->input->post('meeting_date')),
            'description'       => html_escape($this->input->post('description')),
            'start_time'        => html_escape($this->input->post('start_time')),
            'end_time'          => html_escape($this->input->post('end_time')),
            'status'            => html_escape($this->input->post('status')),

        );


        $this->db->where('jitsi_id', $param2);
        $this->db->update('jitsi', $arrayLive);

        $sendPhone = $this->input->post('send_notification_sms');
        $senddate  = $this->input->post('meeting_date');

        if($sendPhone == '1'){

            $visitors = $this->db->get_where('visitor', array('group_id' => $this->input->post('group_id')))->row();
            $visitor_parent_id = $visitors->parent_id;
            $parents = $this->db->get_where('parent', array('parent_id' => $visitor_parent_id))->result_array();
            $visitor_array = $this->db->get_where('visitor', array('group_id' => $visitors->group_id))->result_array();

            $message = $this->input->post('title').' ';
            $message .= get_phrase('on').' '. $senddate;

            foreach ($parents as $key => $parent){
                $recieverPhoneNumber = $parent['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }

            foreach ($visitor_array as $key => $visitor){
                $recieverPhoneNumber = $visitor['phone'];
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }

    /*>>>>>>>>> Function to delete Jitsi from Table >>>>>>>>> */
    function deleteJitsiClassFunction($param2){
        $this->db->where('jitsi_id', $param2);
        $this->db->delete('jitsi');
    }


    /*>>>>>>>>> Function to select from Jitsi Table >>>>>>>>> */

    function selectJitsiStaffInsert(){

        $staff = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $sql = "select * from jitsi where user_id='".$staff."' order by jitsi_id asc";
        return $this->db->query($sql)->result_array();
    }

    function selectChatStaffInsert(){
        $staff = $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id');
        $sql = "select * from chat where user_id='".$staff."' order by chat_id asc";
        return $this->db->query($sql)->result_array();
    }

    function selectJitsivisitorbyvisitorId(){
        $studentClassvisitor = $this->db->get_where('visitor', array('visitor_id' => $this->session->userdata('visitor_id')))->row()->visitor_id;
        // $visitorsubgroup = $this->db->get_where('visitor', array('visitor_id' => $this->session->userdata('visitor_id')))->row()->subgroup_id;

        $sql = "select * from jitsi where visitor_id='".$studentClassvisitor."' order by jitsi_id asc";
        return $this->db->query($sql)->result_array();
    }



    // function selectJitsiStudentByClassSection(){
    //     $studentClass = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->class_id;
    //     $studentSection = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')))->row()->section_id;

    //     $sql = "select * from jitsi where class_id='".$studentClass."' and section_id='".$studentSection."' order by jitsi_id asc";
    //     return $this->db->query($sql)->result_array();
    // }

    function toSelectFromJitsiWithId($jitsi_id){

        $sql = "select * from jitsi where jitsi_id ='".$jitsi_id."'";
        return $this->db->query($sql)->result_array();

    }

    function datetime(){

        $date = date('h:i', time());
        $sql = "select * from jitsi where start_time='".$date."' order by jitsi_id asc";
        return $this->db->query($sql)->result_array();

    }





}