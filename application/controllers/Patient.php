<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Patient extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->table        = 'calendar';

        		$this->load->database();                                //Load Databse Class

                $this->load->library('session');					    //Load library for session
                $this->load->model('live_class_model');
                $this->load->model('doctor_calendar_model');
                $this->load->model('patient_calendar_model');
                $this->load->model('appointment_list_model');
                $this->load->model('chat_model');
                $this->load->model('crud_model');
               $this->load->model('advertisment_model');




                $this->load->model('schedule_list_model');

    }

     /*patient dashboard code to redirect to patient page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('patient_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('patient Dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / patient dashboard code to redirect to patient page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('patient_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {


            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');

            $this->db->where('patient_id', $this->session->userdata('patient_id'));
            $this->db->update('patient', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/patient_image/' . $this->session->userdata('patient_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'patient/manage_profile', 'refresh');

        }

        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));

            if ($data['new_password'] == $data['confirm_new_password']) {

               $this->db->where('patient_id', $this->session->userdata('patient_id'));
               $this->db->update('patient', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }

            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'patient/manage_profile', 'refresh');
        }

            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('patient', array('patient_id' => $this->session->userdata('patient_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        function subject (){

            $patient_profile = $this->db->get_where('patient', array('patient_id' => $this->session->userdata('patient_id')))->row();
            $select_patient_class_id = $patient_profile->class_id;

            $page_data['page_name']     = 'subject';
            $page_data['page_title']    = get_phrase('Class Subjects');
            $page_data['select_subject']  = $this->db->get_where('subject', array('class_id' => $select_patient_class_id))->result_array();
            $this->load->view('backend/index', $page_data);
        }

        // function teacher (){


        //     $patient_profile = $this->db->get_where('patient', array('patient_id' => $this->session->userdata('patient_id')))->row();
        //     $select_patient_class_id = $patient_profile->class_id;

        //     $return_teacher_id = $this->db->get_where('subject', array('class_id' => $select_patient_class_id))->row()->teacher_id;


        //     $page_data['page_name']     = 'teacher';
        //     $page_data['page_title']    = get_phrase('Class Teachers');
        //     $page_data['select_teacher']  = $this->db->get_where('teacher', array('teacher_id' => $return_teacher_id))->result_array();
        //     $this->load->view('backend/index', $page_data);
        // }

        function class_mate (){

            $patient_profile = $this->db->get_where('patient', array('patient_id' => $this->session->userdata('patient_id')))->row();
            $page_data['select_patient_class_id']  = $patient_profile->class_id;
            $page_data['page_name']     = 'class_mate';
            $page_data['page_title']    = get_phrase('Class Mate');
            $this->load->view('backend/index', $page_data);
        }

        function class_routine(){

            $patient_profile = $this->db->get_where('patient', array('patient_id' => $this->session->userdata('patient_id')))->row();
            $page_data['class_id']  = $patient_profile->class_id;

            $page_data['page_name']     = 'class_routine';
            $page_data['page_title']    = get_phrase('Class Timetable');
            $this->load->view('backend/index', $page_data);


        }

        function invoice($param1 = null, $param2 = null, $param3 = null){

            if($param1 == 'make_payment'){

                $invoice_id = $this->input->post('invoice_id');
                $payment_email = $this->db->get_where('settings', array('type' => 'paypal_email'))->row();
                $select_invoice = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->row();

                // SENDING USER TO PAYPAL TERMINAL.
                $this->paypal->add_field('rm', 2);
                $this->paypal->add_field('no_note', 0);
                $this->paypal->add_field('item_name', $select_invoice->title);
                $this->paypal->add_field('amount', $select_invoice->due);
                $this->paypal->add_field('custom', $select_invoice->invoice_id);
                $this->paypal->add_field('business', $payment_email->description);
                $this->paypal->add_field('notify_url', base_url('invoice/paypal_ipn'));
                $this->paypal->add_field('cancel_return', base_url('invoice/paypal_cancel'));
                $this->paypal->add_field('return', site_url('invoice/paypal_success'));

                $this->paypal->submit_paypal_post();
                //submitting info to the paypal teminal
            }


            if($param1 == 'paypal_ipn'){
                if($this->paypal->validate_ipn() == true){
                        $ipn_response = '';
                        foreach ($_POST as $key => $value){
                            $value = urlencode(stripslashes($value));
                            $ipn_response .= "\n$key=$value";
                        }

                    $page_data['payment_details']   = $ipn_response;
                    $page_data['payment_timestamp'] = strtotime(date("m/d/Y"));
                    $page_data['payment_method']    = '1';
                    $page_data['status']            = 'paid';
                    $invoice_id                = $_POST['custom'];
                    $this->db->where('invoice_id', $invoice_id);
                    $this->db->update('invoice', $page_data);

                    $data2['method']       =   '1';
                    $data2['invoice_id']   =   $_POST['custom'];
                    $data2['timestamp']    =   strtotime(date("m/d/Y"));
                    $data2['payment_type'] =   'income';
                    $data2['title']        =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->title;
                    $data2['description']  =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->description;
                    $data2['patient_id']   =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->patient_id;
                    $data2['amount']       =   $this->db->get_where('invoice' , array('invoice_id' => $data2['invoice_id']))->row()->amount;
                    $this->db->insert('payment' , $data2);

                }
            }

            if($param1 == 'paypal_cancel'){
                $this->session->set_flashdata('error_message', get_phrase('Payment Cancelled'));
                redirect(base_url() . 'patient/invoice', 'refresh');
                }

            if($param1 == 'paypal_success'){
                $this->session->set_flashdata('flash_message', get_phrase('Payment Successful'));
                redirect(base_url() . 'patient/invoice', 'refresh');
            }


            $patient_profile = $this->db->get_where('patient', array('patient_id' => $this->session->userdata('patient_id')))->row();
            $patient_profile = $patient_profile->patient_id;

            $page_data['invoices']     = $this->db->get_where('invoice', array('patient_id' => $patient_profile))->result_array();
            $page_data['page_name']     = 'invoice';
            $page_data['page_title']    = get_phrase('All Invoices');
            $this->load->view('backend/index', $page_data);
        }

        function payment_history(){

            $patient_profile = $this->db->get_where('patient', array('patient_id' => $this->session->userdata('patient_id')))->row();
            $patient_profile = $patient_profile->patient_id;

            $page_data['invoices']     = $this->db->get_where('invoice', array('patient_id' => $patient_profile))->result_array();
            $page_data['page_name']     = 'payment_history';
            $page_data['page_title']    = get_phrase('patient History');
            $this->load->view('backend/index', $page_data);


        }

        function jitsi($param1 = null, $param2 = null, $param3 = null){

			$page_data['page_name'] = 'jitsi';
			$page_data['page_title'] = get_phrase('online_consultancy');
			$this->load->view('backend/index', $page_data);

        }

        function stream_jitsi($jitsi_id){

            $page_data['jitsi_id'] = $jitsi_id;
            $this->load->view('backend/host/jitsi', $page_data);

        }


        // function doctoravailability() {
        //     $page_data['page_name'] = 'doctoravailability';
        //     $page_data['page_title'] = get_phrase('doctor_availability');
        // $clinic_id = $this->session->userdata('clinic_id');

        //     $this->load->view('backend/index', $page_data);
        // }


        function appointment($param1 = null,$param2 = null){


            if($param1 == 'edit'){
                $this->appointment_model->editcalendar_listFunction($param2);

                $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                redirect(base_url(). 'doctor/my_calendar', 'refresh');
            }

            $page_data['page_name']     = 'appointment';
            $page_data['page_title']    = get_phrase('manage_doctor_details');
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
        redirect(base_url(). 'patient/appointment', 'refresh');
    }

    if($param1 == 'update'){
        $this->appointment_list_model->updateappointmentFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'patient/appointment', 'refresh');
    }


    if($param1 == 'delete'){
        $this->appointment_list_model->deleteappointmentFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'patient/appointment', 'refresh');
    }
            $page_data['page_name']     = 'appointment_form';
            $page_data['page_title']    = get_phrase('manage_appointment_form');
            $this->load->view('backend/index', $page_data);

}
function my_calendar($param1 = null, $param2 = null, $param3 = null){

 $data_calendar = $this->patient_calendar_model->get_list($this->table);
        $calendar = array();
        foreach ($data_calendar as $key => $val)
        {
            $calendar[] = array(
                            'id'    => intval($val->id),
                            'title' => $val->title,

                            'doctor_name' => $val->doctor_name,

                             'description' => trim($val->description),
                            'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i"),
                          'end'   => date_format( date_create($val->end_date) ,"Y-m-d H:i"),
                        //   'end_time'   => date_format( date_create($val->end_time) ,"Y-m-d H:i"),
                        //   'start_time'   => date_format( date_create($val->start_time) ,"Y-m-d H:i"),


                            'color' => $val->color,
                            );
        }

// if($param1 == 'insert'){
//     $this->appointment_model->insertappointment_listFunction();
//     $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
//     redirect(base_url(). 'patient/my_calendar', 'refresh');
// }

// if($param1 == 'edit'){
//     $this->appointment_model->editcalendar_listFunction($param2);
//     $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
//     redirect(base_url(). 'patient/my_calendar', 'refresh');
// }

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
        $patient_id = $this->input->post('patient_id');
        $doctor_id = $this->input->post('doctor_id');
        $doctor_name = $this->input->post('doctor_name');
        $status = $this->input->post('status');
        $patient_name = $this->input->post('patient_name');


        $param = array(
            'title' => $title,
            'description' => $description,
            'start_date' => $start_date.' '.$start_time,
            'end_date' => $start_date.' '.$end_time,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'color' => $color,
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'doctor_name' => $doctor_name,
            'status' => $status,
            'patient_name' => $patient_name,

        );
                $insert = $this->patient_calendar_model->insert($this->table, $param);

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
                $update = $this->patient_calendar_model->update($this->table, $param, $where);

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
            $delete = $this->patient_calendar_model->delete($this->table, $where);

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
            redirect(base_url(). 'patient/my_chat', 'refresh');
        }

        if($param1 == 'update'){
            $this->my_chat_model->updateApplicantFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'patient/my_chat', 'refresh');
        }


        if($param1 == 'delete'){
            $this->my_chat_model->deleteApplicantFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'patient/my_chat', 'refresh');

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
            redirect(base_url(). 'patient/chat_request', 'refresh');

            }

            if($param1 == 'update'){
                $this->chat_model->updateChatRequest($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'doctor/my_contacts', 'refresh');
            }

            $page_data['page_name'] = 'my_contacts';
            $page_data['page_title'] = get_phrase('chat_request');
            $this->load->view('backend/index', $page_data);
        }

    function chat_Rsend($doctor_id){
        $page_data['doctor_id'] = $doctor_id;
        $page_data['page_name'] = 'requestchat';
        $page_data['page_title'] = get_phrase('chat request');
        $this->load->view('backend/index', $page_data);
    }

    function chat_acceptance(){
        $page_data['page_name'] = 'chat_accept';
        $page_data['page_title'] = get_phrase('chat');
        $this->load->view('backend/index', $page_data);
    }



function chat($doctor_id){

        $page_data['doctor_id']      = $doctor_id;
        $page_data['page_name']     = 'chat';
        $page_data['page_title']    = get_phrase('chat with doctor');
        $this->load->view('backend/index', $page_data);
    }





    function create()
    {
        // session_start();
        $message = $this->input->post('message');
        $patient_id = $this->input->post('patient_id');
        $doctor_id = $this->input->post('doctor_id');
        // $doctor_name = $this->input->post('name');
        $patient_name = $this->input->post('name');
        $message_sent_by  = $this->session->userdata('login_type');
    // $clinic_id = $this->session->userdata('clinic_id');
    // $clinic_id = $this->db->get_where('school', array('clinic_id' => $this->session->userdata('clinic_id')))->row();


        $data = array(

            'message'  => $message,
            'patient_id' => $patient_id,
            'doctor_id'   => $doctor_id,
            // 'doctor_name'   => $doctor_name,
            'patient_name'   => $patient_name,
            'message_sent_by' => $message_sent_by,
            // 'clinic_id'  => $clinic_id,
        );
        $this->load->model('chat_model');
        $insert = $this->chat_model->createData($data);
        echo json_encode($insert);
    }


    function list_all_chat_and_order_with_chatid(){
        $patient_id = $this->session->userdata('patient_id');
        $doctor_id = $this->session->userdata('doctor_id');
        $clinic_id = $this->session->userdata('clinic_id');



            // $sql = "SELECT * FROM `chat` WHERE `sender_message_id` = '' AND `receiver_message_id` = '57' OR `sender_message_id` = '57' AND `receiver_message_id` = '8' ";
            // $sql = "SELECT * FROM `chat` WHERE `doctor_id` = '.$doctor_id.';
            // $sql =  "select * from chat where doctor_id = $doctor_id order by chat_id desc ";

            // $receivedoctor = $this->db->get_where('chat', array('doctor_id' => $this->session->userdata('doctor_id')))->row()->doctor_id;
            $receivedoctor = $this->db->get_where('chat', array('doctor_id' =>  $this->session->userdata('doctor_id')))->row()->doctor_id;
            $sendpatient = $this->db->get_where('chat', array('patient_id' =>  $this->session->userdata('patient_id')))->row()->patient_id;
            // $sendpatient =  "select * from chat where patient_id = $patient_id order by chat_id desc ";
            // $receivedoctor =  "select * from chat where doctor_id = $doctor_id order by chat_id desc ";


            $sql = "select * from chat where doctor_id ='".$receivedoctor."' and patient_id='".$sendpatient."' order by chat_id asc";
            // $sql = "select * from chat where patient_id='".$sendpatient."' order by chat_id asc";
            // $sql = "select * from chat where doctor_id ='".$receivedoctor."' order by chat_id asc";
            return $this->db->query($sql)->result_array();



            // $all_chat_selected = $this->db->query($sql)->result_array();

            // foreach($all_chat_selected as $key => $selected_chats_from_chat_table){
            //     $chat_id = $selected_chats_from_chat_table['chat_id'];
            //     $face_file = 'uploads/chat_image/'. $chat_id . '.jpg';
            //     if(!file_exists($face_file)){
            //         $face_file = 'uploads/chat_image/default_image.jpg/';
            //     }

            //     $selected_chats_from_chat_table['face_file'] = base_url() . $face_file;
            //     array_push($data, $selected_chats_from_chat_table);
            // }

            // return $data;


        }









    function load_chat_data()
    {
        if($this->input->post('doctor_id'))
        {
            $doctor_id = $this->input->post('doctor_id');
            $patient_id = $this->input->post('patient_id');
            // if($this->input->post('updata_data')=='yes')
            // {
            //     $this->chat_model->update_chat_message_status($sender_message_id);
            // }

            $chat_data = $this->chat_model->fetch_chat_data($patient_id,$doctor_id);
            if($chat_data->num_rows()> 0)
            {
                foreach($chat_data->result() as $row)
                {
                    // $message_direction = '';
                    // if($row->sender_message_id == $sender_message_id)
                    // {
                    //     $message_direction = 'right';

                    // }
                    // else
                    // {
                    //     $message_direction = 'left';


                    // }
                    // $date = date('D M Y H:i', strtotime($row->time));
                    $output[] = array(
                        'message' => $row->message,
                        'time' => $row->time,
                        // 'message_direction' => $row->message_direction,
                    );
                }
            }
            echo json_encode($output);
        }
    }
}