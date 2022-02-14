<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Visitor extends CI_Controller {

    function __construct() {
        parent::__construct();
                $this->table        = 'calendar';
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('live_class_model');
                $this->load->model('exhibitor_calendar_model');
                $this->load->model('visitor_calendar_model');
                $this->load->model('appointment_list_model');
                $this->load->model('chat_model');
                $this->load->model('crud_model');
                $this->load->model('advertisment_model');
                $this->load->model('schedule_list_model');
                $this->load->model('exhibitor_advertisment_model');
    }

     /*visitor dashboard code to redirect to visitor page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('visitor_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('visitor Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / visitor dashboard code to redirect to visitor page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('visitor_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
            $this->db->where('visitor_id', $this->session->userdata('visitor_id'));
            $this->db->update('visitor', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/visitor_image/' . $this->session->userdata('visitor_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'visitor/manage_profile', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
            if ($data['new_password'] == $data['confirm_new_password']) {
               $this->db->where('visitor_id', $this->session->userdata('visitor_id'));
               $this->db->update('visitor', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'visitor/manage_profile', 'refresh');
        }
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('visitor', array('visitor_id' => $this->session->userdata('visitor_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        // function subject (){

        //     $visitor_profile = $this->db->get_where('visitor', array('visitor_id' => $this->session->userdata('visitor_id')))->row();
        //     $select_visitor_class_id = $visitor_profile->class_id;

        //     $page_data['page_name']     = 'subject';
        //     $page_data['page_title']    = get_phrase('Class Subjects');
        //     $page_data['select_subject']  = $this->db->get_where('subject', array('class_id' => $select_visitor_class_id))->result_array();
        //     $this->load->view('backend/index', $page_data);
        // }

        function jitsi($param1 = null, $param2 = null, $param3 = null){
			$page_data['page_name'] = 'jitsi';
			$page_data['page_title'] = get_phrase('online_consultancy');
			$this->load->view('backend/index', $page_data);
        }

        function stream_jitsi($jitsi_id){
            $page_data['jitsi_id'] = $jitsi_id;
            $this->load->view('backend/host/jitsi', $page_data);
        }
        function appointment($param1 = null,$param2 = null){
            if($param1 == 'edit'){
                $this->appointment_model->editcalendar_listFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                redirect(base_url(). 'exhibitor/my_calendar', 'refresh');
            }
            $page_data['page_name']     = 'appointment';
            $page_data['page_title']    = get_phrase('manage_exhibitor_details');
            $this->load->view('backend/index', $page_data);
}

function edit_calendar(){
    $page_data['page_name'] = 'edit_calendar';
    $page_data['page_title'] = get_phrase('edit_calendar');
    // $page_data['toSelectFromCalendarWithId'] = $this->appointment_model->toSelectFromCalendarWithId($id);
    $this->load->view('backend/index',$page_data);
}

function appointment_form($param1 = null, $param2 = null, $param3 = null){
    if($param1 == 'insert'){
        $this->appointment_list_model->insertappointment_listFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'visitor/appointment', 'refresh');
    }
    if($param1 == 'update'){
        $this->appointment_list_model->updateappointmentFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'visitor/appointment', 'refresh');
    }
    if($param1 == 'delete'){
        $this->appointment_list_model->deleteappointmentFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'visitor/appointment', 'refresh');
    }
            $page_data['page_name']     = 'appointment_form';
            $page_data['page_title']    = get_phrase('manage_appointment_form');
            $this->load->view('backend/index', $page_data);

}
function my_calendar($param1 = null, $param2 = null, $param3 = null){

 $data_calendar = $this->visitor_calendar_model->get_list($this->table);
        $calendar = array();
        foreach ($data_calendar as $key => $val)
        {
            $calendar[] = array(
                            'id'    => intval($val->id),
                            'title' => $val->title,
                            'exhibitor_name' => $val->exhibitor_name,
                            'description' => trim($val->description),
                            'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i"),
                            'end'   => date_format( date_create($val->end_date) ,"Y-m-d H:i"),
                        //   'end_time'   => date_format( date_create($val->end_time) ,"Y-m-d H:i"),
                        //   'start_time'   => date_format( date_create($val->start_time) ,"Y-m-d H:i"),
                            'color' => $val->color,
                            );
        }
    $page_data = array();
    $page_data['page_name']     = 'my_calendar';
    $page_data['page_title']    = get_phrase('manage_my_calendar');
    $page_data['get_data']           = json_encode($calendar);
    $this->load->view('backend/index', $page_data);
}

    function save()
    {
        $response = array();
        $this->form_validation->set_rules('title', 'Title cant be empty ', 'required');
        if ($this->form_validation->run() == TRUE)
        {
            $param = $this->input->post();

            $calendar_id = $param['calendar_id'];
            unset($param['calendar_id']);

            if($calendar_id == 0)
            {
                $param['create_at']     = date('d-m-Y H:i');
                $title = $this->input->post('title');
                $description = $this->input->post('description');
                $start_date = $this->input->post('start_date');
                $end_date = $this->input->post('end_date');
                $start_time = $this->input->post('start_time');
                $end_time = $this->input->post('end_time');
                $color = $this->input->post('color');
                $visitor_id = $this->input->post('visitor_id');
                $exhibitor_id = $this->input->post('exhibitor_id');
                $exhibitor_name = $this->input->post('exhibitor_name');
                $status = $this->input->post('status');
                $visitor_name = $this->input->post('visitor_name');
                $param = array(
                    'title' => $title,
                    'description' => $description,
                    'start_date' => $start_date.' '.$start_time,
                    'end_date' => $start_date.' '.$end_time,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'color' => $color,
                    'visitor_id' => $visitor_id,
                    'exhibitor_id' => $exhibitor_id,
                    'exhibitor_name' => $exhibitor_name,
                    'status' => $status,
                    'visitor_name' => $visitor_name,

        );
                $insert = $this->visitor_calendar_model->insert($this->table, $param);
                if ($insert > 0)
                {
                    $response['status'] = TRUE;
                    $response['notif']  = 'Success add calendar';
                    $response['id']     = $insert;
                }
                else
                {
                    $response['status'] = FALSE;
                    $response['notif']  = 'Server wrong, please save again';
                }
            }
            else
            {
                $param['create_at']     = date('d-m-Y H:i');
                $title = $this->input->post('title');
                $description = $this->input->post('description');
                $start_date = $this->input->post('start_date');
                $end_date = $this->input->post('end_date');
                $start_time = $this->input->post('start_time');
                $end_time = $this->input->post('end_time');
                $param = array(
                    'title' => $title,
                    'description' => $description,
                    'start_date' => $start_date.' '.$start_time,
                    'end_date' => $start_date.' '.$end_time,
                    'start_time' => $start_time,
                    'end_time' => $end_time,

        );
                $where      = [ 'id'  => $calendar_id];
                $param['modified_at']       = date('d-m-Y H:i');
                $update = $this->visitor_calendar_model->update($this->table, $param, $where);
                if ($update > 0)
                {
                    $response['status'] = TRUE;
                    $response['notif']  = 'Success add calendar';
                    $response['id']     = $calendar_id;
                }
                else
                {
                    $response['status'] = FALSE;
                    $response['notif']  = 'Server wrong, please save again';
                }

            }
        }
        else
        {
            $response['status'] = FALSE;
            $response['notif']  = validation_errors();
        }
        echo json_encode($response);
    }

 function delete()
    {
        $response       = array();
        $calendar_id    = $this->input->post('id');
        if(!empty($calendar_id))
        {
            $where = ['id' => $calendar_id];
            $delete = $this->visitor_calendar_model->delete($this->table, $where);
            if ($delete > 0)
            {
                $response['status'] = TRUE;
                $response['notif']  = 'Success delete calendar';
            }
            else
            {
                 $response['status'] = FALSE;
                $response['notif']  = 'Server wrong, please save again';
            }
        }
        else
        {
            $response['status'] = FALSE;
            $response['notif']  = 'Data not found';
        }
        echo json_encode($response);
    }



    function my_chat($param1 = null, $param2 = null, $param3 = null){
        if($param1 == 'insert'){
            $this->chat_model->insertApplicantFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'visitor/my_chat', 'refresh');
        }
        if($param1 == 'update'){
            $this->my_chat_model->updateApplicantFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'visitor/my_chat', 'refresh');
        }
        if($param1 == 'delete'){
            $this->my_chat_model->deleteApplicantFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'visitor/my_chat', 'refresh');
        }
        $page_data['page_name']     = 'my_contacts';
        $page_data['page_title']    = get_phrase('manage_my_chat');
        // $page_data['select_my_chat']  = $this->db->get_where('chat',array('chat_id'=>$chat_id))->result_array();
        $this->load->view('backend/index', $page_data);
        }

        function chat_request($param1 = null, $param2 = null, $param3 = null){
            if($param1 == 'create'){
            $this->chat_model->insertChatRequest();
            $this->session->set_flashdata('flash_message', get_phrase('Sent Request successfully'));
            redirect(base_url(). 'visitor/chat_request', 'refresh');
            }
            if($param1 == 'update'){
                $this->chat_model->updateChatRequest($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'exhibitor/my_contacts', 'refresh');
            }
            $page_data['page_name'] = 'my_contacts';
            $page_data['page_title'] = get_phrase('chat_request');
            $this->load->view('backend/index', $page_data);
        }

        function chat_Rsend($exhibitor_id){
            $page_data['exhibitor_id'] = $exhibitor_id;
            $page_data['page_name'] = 'requestchat';
            $page_data['page_title'] = get_phrase('chat request');
            $this->load->view('backend/index', $page_data);
        }

        function chat_acceptance(){
            $page_data['page_name'] = 'chat_accept';
            $page_data['page_title'] = get_phrase('chat');
            $this->load->view('backend/index', $page_data);
        }

        function chat($exhibitor_id){
            $page_data['exhibitor_id']      = $exhibitor_id;
            $page_data['page_name']     = 'chat';
            $page_data['page_title']    = get_phrase('chat with exhibitor');
            $this->load->view('backend/index', $page_data);
        }

    function create()
    {
        // session_start();
        $message = $this->input->post('message');
        $visitor_id = $this->input->post('visitor_id');
        $exhibitor_id = $this->input->post('exhibitor_id');
        $visitor_name = $this->input->post('name');
        $message_sent_by  = $this->session->userdata('login_type');
        $data = array(
            'message'  => $message,
            'visitor_id' => $visitor_id,
            'exhibitor_id'   => $exhibitor_id,
            'visitor_name'   => $visitor_name,
            'message_sent_by' => $message_sent_by,
        );
        $this->load->model('chat_model');
        $insert = $this->chat_model->createData($data);
        echo json_encode($insert);
    }


        function list_all_chat_and_order_with_chatid(){
            $visitor_id = $this->session->userdata('visitor_id');
            $exhibitor_id = $this->session->userdata('exhibitor_id');
            $clinic_id = $this->session->userdata('clinic_id');
            $receiveexhibitor = $this->db->get_where('chat', array('exhibitor_id' =>  $this->session->userdata('exhibitor_id')))->row()->exhibitor_id;
            $sendvisitor = $this->db->get_where('chat', array('visitor_id' =>  $this->session->userdata('visitor_id')))->row()->visitor_id;
            $sql = "select * from chat where exhibitor_id ='".$receiveexhibitor."' and visitor_id='".$sendvisitor."' order by chat_id asc";
            return $this->db->query($sql)->result_array();
        }

}