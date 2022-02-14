<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Exhibitor extends CI_Controller {

    function __construct() {
        parent::__construct();
        		$this->load->database();                              //Load Databse Class
                $this->table        = 'calendar';                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
               $this->load->model('live_class_model');
               $this->load->model('exhibitor_calendar_model');
               $this->load->model('visitor_calendar_model');
               $this->load->model('appointment_list_model');
               $this->load->model('schedule_list_model');
               $this->load->model('chat_model');
               $this->load->model('crud_model');
               $this->load->model('advertisment_model');
               $this->load->model('exhibitor_advertisment_model');


    }

     /*exhibitor dashboard code to redirect to exhibitor page if successfull login** */
     function dashboard() {
        if ($this->session->userdata('exhibitor_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('exhibitor Dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function exhibitor_advertisment($param1 = null,$param2 = null,$param3 = null){

        if($param1 == 'add'){
            $this->exhibitor_advertisment_model->createNewAdvertismentFunction();
            $this->session->set_flashdata('flash_message', get_phrase('added_successfuly'));
            redirect(base_url() . 'exhibitor/exhibitor_advertisment/', 'refresh');
        }

        if($param1 == 'edit'){
            $this->exhibitor_advertisment_model->updateNewAdvertismentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('successfuly_updated'));
            redirect(base_url() . 'exhibitor/exhibitor_advertisment/', 'refresh');
        }

        if($param1 == 'delete'){
            $this->exhibitor_advertisment_model->deleteAdvertismentClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('advertisment_successfuly_deleted'));
            redirect(base_url() . 'exhibitor/exhibitor_advertisment/', 'refresh');
        }


        $page_data['page_name'] = 'exhibitor_advertisement';
        $page_data['page_title'] = get_phrase('add_advertisment');
        $this->load->view('backend/index',$page_data);
    }


    function edit_advertisement($exhibitor_advertisement_id){

        $page_data['page_name'] = 'exhibitor_edit_advertisement';
    $page_data['page_title'] = get_phrase('replace_advertisement');
    $page_data['toSelectFromAdvertisementWithId'] = $this->exhibitor_advertisment_model->toSelectFromAdvertisementWithId($exhibitor_advertisement_id);
    $this->load->view('backend/index',$page_data);

    }


	/******************* / exhibitor dashboard code to redirect to exhibitor page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
        if ($this->session->userdata('exhibitor_login') != 1) redirect(base_url(), 'refresh');
        if ($param1 == 'update') {
            $data['name']   =   $this->input->post('name');
            $data['email']  =   $this->input->post('email');
            $this->db->where('exhibitor_id', $this->session->userdata('exhibitor_id'));
            $this->db->update('exhibitor', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/exhibitor_image/' . $this->session->userdata('exhibitor_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
            redirect(base_url() . 'exhibitor/manage_profile', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['new_password']           =   sha1($this->input->post('new_password'));
            $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));
            if ($data['new_password'] == $data['confirm_new_password']) {
               $this->db->where('exhibitor_id', $this->session->userdata('exhibitor_id'));
               $this->db->update('exhibitor', array('password' => $data['new_password']));
               $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
            }
            else{
                $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
            }
            redirect(base_url() . 'exhibitor/manage_profile', 'refresh');
        }
            $page_data['page_name']     = 'manage_profile';
            $page_data['page_title']    = get_phrase('Manage Profile');
            $page_data['edit_profile']  = $this->db->get_where('exhibitor', array('exhibitor_id' => $this->session->userdata('exhibitor_id')))->result_array();
            $this->load->view('backend/index', $page_data);
        }

    function jitsi($param1 = null, $param2 = null, $param3 = null){
            if($param1 == 'add'){
                $this->live_class_model->createNewJitsiClassFunction();
                $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_created'));
                redirect(base_url() . 'exhibitor/jitsi/', 'refresh');
            }

            if($param1 == 'edit'){
                $this->live_class_model->updateJitsiClassFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_updated'));
                redirect(base_url() . 'exhibitor/jitsi/', 'refresh');
            }

            if($param1 == 'delete'){
                $this->live_class_model->deleteJitsiClassFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_deleted'));
                redirect(base_url() . 'exhibitor/jitsi/', 'refresh');
            }

            $page_data['page_name'] = 'jitsi';
            $page_data['page_title'] = get_phrase('Online Consultancy');
            $this->load->view('backend/index',$page_data);
        }

        function edit_jitsi($jitsi_id){
            $page_data['page_name'] = 'edit_jitsi';
            $page_data['page_title'] = get_phrase('edit_jitsi');
            $page_data['toSelectFromJitsiWithId'] = $this->live_class_model->toSelectFromJitsiWithId($jitsi_id);
            $this->load->view('backend/index',$page_data);
        }

        function stream_jitsi($jitsi_id){
            $page_data['jitsi_id'] = $jitsi_id;
            $this->load->view('backend/host/jitsi-exhibitor', $page_data);
        }

        function my_chat($param1 = null, $param2 = null, $param3 = null){

            if($param1 == 'insert'){
                $this->chat_model->insertApplicantFunction();
                $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                redirect(base_url(). 'exhibitor/my_chat', 'refresh');
            }

            if($param1 == 'update'){
                $this->chat_model->updateApplicantFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'exhibitor/my_chat', 'refresh');
            }

            if($param1 == 'delete'){
                $this->chat_model->deleteApplicantFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                redirect(base_url(). 'exhibitor/my_chat', 'refresh');
            }
            $page_data['page_name']     = 'my_chat';
                $page_data['page_title']    = get_phrase('manage_my_chat');
                //$page_data['select_my_chat']  = $this->db->get_where('calendar',array('id'=>$id))->result_array();
                $this->load->view('backend/index', $page_data);
        }

        // function edit_chat_request($visitor_id){
        //     $page_data['page_name'] = 'chat_request';
        //     $page_data['page_title'] = get_phrase('chat_request');
        //     // $page_data['toSelectFromchatRequestWithId'] = $this->chat_model->toSelectFromchatRequestWithId($visitor_id);
        //     $this->load->view('backend/index',$page_data);
        // }


        function edit_chat_request($chat_request_id){
            $page_data['page_name'] = 'chat_request';
            $page_data['page_title'] = get_phrase('chat_request');
            $page_data['toSelectFromchatRequestWithId'] = $this->chat_model->toSelectFromchatRequestWithId($chat_request_id);
            $this->load->view('backend/index',$page_data);
        }

        function my_chat_request($param1 = null, $param2 = null, $param3 = null){
            $page_data['page_name']     = 'my_chat_request';
            $page_data['page_title']    = get_phrase('manage_my_chat_request');
            $this->load->view('backend/index', $page_data);
        }

        function chat_request($param1 = null, $param2 = null, $param3 = null){
            if($param1 == 'insert'){
                $this->chat_model->insertChatRequest();
                $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                redirect(base_url(). 'exhibitor/my_chat', 'refresh');
            }

            if($param1 == 'update'){
                $this->chat_model->updateChatRequest($param2);
                $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                redirect(base_url(). 'exhibitor/my_chat_request', 'refresh');
            }

            $page_data['page_name']     = 'chat_request';
            $page_data['page_title']    = get_phrase('manage_my_chat_request');
            $this->load->view('backend/index', $page_data);
        }

        function my_calendar($param1 = null, $param2 = null, $param3 = null){
            $data_calendar = $this->exhibitor_calendar_model->get_list($this->table);
            $calendar = array();
            foreach ($data_calendar as $key => $val)
               {
                       $calendar[] = array(
                            'id'    => intval($val->id),
                            'title' => $val->title,
                            'description' => trim($val->description),
                            'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i"),
                            'end'   => date_format( date_create($val->end_date) ,"Y-m-d H:i"),
                                //    'end_time'   => date_format( date_create($val->end_time) ,"Y-m-d H:i:s"),
                                //    'start_time'   => date_format( date_create($val->start_time) ,"Y-m-d H:i:s"),
                            'color' => $val->color,
                            );
                   }
               $page_data = array();
               $page_data['page_name']     = 'my_calendar';
               $page_data['page_title']    = get_phrase('manage_my_calendar');
               $page_data['get_data']      = json_encode($calendar);
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
                        $param = array(
                       'title' => $title,
                       'description' => $description,
                       'start_date' => $start_date.' '.$start_time,
                       'end_date' => $start_date.' '.$end_time,
                       'start_time' => $start_time,
                       'end_time' => $end_time,
                        );
                        $param['create_at']     = date('Y-m-d H:i:s');
                        $insert = $this->exhibitor_calendar_model->insert($this->table, $param);
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
                        $color = $this->input->post('color');
                        $status = $this->input->post('status');
                        $param = array(
                       'title' => $title,
                       'description' => $description,
                       'start_date' => $start_date.' '.$start_time,
                       'end_date' => $start_date.' '.$end_time,
                       'start_time' => $start_time,
                       'end_time' => $end_time,
                       'color' => $color,
                       'status' => $status,
                        );
                           $where      = [ 'id'  => $calendar_id];
                           $param['modified_at']       = date('Y-m-d H:i:s');
                           $update = $this->exhibitor_calendar_model->update($this->table, $param, $where);

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

               function update()
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
                            $param = array(
                                'title' => $title,
                                'description' => $description,
                                'start_date' => $start_date.' '.$start_time,
                                'end_date' => $start_date.' '.$end_time,
                                'start_time' => $start_time,
                                'end_time' => $end_time,
                   );
                           $param['create_at']     = date('Y-m-d H:i:s');
                           $insert = $this->exhibitor_calendar_model->insert($this->table, $param);

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
                            $color = $this->input->post('color');
                            $status = $this->input->post('status');
                            $param = array(
                                'title' => $title,
                                'description' => $description,
                                'start_date' => $start_date.' '.$start_time,
                                'end_date' => $start_date.' '.$end_time,
                                'start_time' => $start_time,
                                'end_time' => $end_time,
                                'color' => $color,
                                'status' => $status,
                            );
                           $where      = [ 'id'  => $calendar_id];
                           $param['modified_at']       = date('Y-m-d H:i:s');
                           $update = $this->exhibitor_calendar_model->updatee($this->table, $param, $where);

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
                //    if(!empty($calendar_id))
                //    {
                //        $where = ['id' => $calendar_id];
                //        $delete = $this->exhibitor_calendar_model->delete($this->table, $where);

                //        if ($delete > 0)
                //        {
                //            $response['status'] = TRUE;
                //            $response['notif']  = 'Success delete calendar';
                //        }
                //        else
                //        {
                //            $response['status'] = FALSE;
                //            $response['notif']  = 'Server wrong, please save again';
                //        }
                //    }
                //    else
                //    {
                //        $response['status'] = FALSE;
                //        $response['notif']  = 'Data not found';
                //    }

                   echo json_encode($response);
               }
                    function appointment($param1 = null,$param2 = null){
                       $page_data['page_name']     = 'appointment';
                       $page_data['page_title']    = get_phrase('manage_visitor_details');
                       $this->load->view('backend/index', $page_data);
                       }
                    function appointment_form($param1 = null, $param2 = null, $param3 = null){
                        if($param1 == 'insert'){
                            $this->appointment_list_model->insertappointment_listFunction();
                            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
                            redirect(base_url(). 'exhibitor/appointment', 'refresh');
                        }
                        if($param1 == 'update'){
                            $this->appointment_list_model->updateappointmentFunction($param2);
                            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
                            redirect(base_url(). 'exhibitor/appointment', 'refresh');
                        }
                        if($param1 == 'delete'){
                            $this->appointment_list_model->deleteappointmentFunction($param2);
                            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
                            redirect(base_url(). 'exhibitor/appointment', 'refresh');
                        }
                                $page_data['page_name']     = 'appointment_form';
                                $page_data['page_title']    = get_phrase('manage_appointment_form');
                                $page_data['select_appointment_form']  = $this->db->get_where('calendar',array('id'=>$id))->result_array();
                                $this->load->view('backend/index', $page_data);
                    }

                    function chat($visitor_id){

                        $page_data['visitor_id']      = $visitor_id;
                        $page_data['page_name']     = 'chat';
                        $page_data['page_title']    = get_phrase('chat with visitor');
                        $this->load->view('backend/index', $page_data);
                    }

                    function create()
                    {
                        $message = $this->input->post('message');
                        $visitor_id = $this->input->post('visitor_id');
                        $exhibitor_id = $this->input->post('exhibitor_id');
                        $message_sent_by = $this->session->userdata('login_type');
                        $data = array(
                            'message'  => $message,
                            'visitor_id' => $visitor_id,
                            'exhibitor_id' => $exhibitor_id,
                            'message_sent_by'   => $message_sent_by,
                        );
                        $this->load->model('chat_model');
                        $insert = $this->chat_model->createData($data);
                        echo json_encode($insert);
                    }

}