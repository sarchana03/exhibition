<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->table        = 'calendar';
        		$this->load->database();                                //Load Databse Class
                $this->load->library('session');					    //Load library for session
                $this->load->model('application_model');                // Load Apllication Model Here
                $this->load->model('academic_model');                   // Load Apllication Model Here
                $this->load->model('event_model');                      // Load Apllication Model Here
                $this->load->model('language_model');                      // Load Apllication Model Here
                $this->load->model('admin_model');                      // Load Apllication Model Here
                $this->load->model('live_class_model');
                $this->load->model('doctor_model');
                $this->load->model('exhibitor_model');
                $this->load->model('visitor_model');
                $this->load->model('patient_model');
                $this->load->model('group_model');
                $this->load->model('sub_group_model');
                $this->load->model('newuser_model');
                $this->load->model('appointment_list_model');
                $this->load->model('chat_model');
                $this->load->model('crud_model');
                $this->load->model('advertisment_model');
                $this->load->model('schedule_list_model');
                $this->load->model('superadmin_model');
                $this->load->model('doctor_calendar_model');
                $this->load->model('patient_calendar_model');
                $this->load->model('exhibitor_calendar_model');
                $this->load->model('visitor_calendar_model');
               $this->load->model('exhibitor_advertisment_model');

    }

    /**default functin, redirects to login page if no admin logged in yet***/
    public function index()
	{
    if ($this->session->userdata('admin_login',) != 1) redirect(base_url() . 'login', 'refresh');
    if ($this->session->userdata('admin_login',) == 1) redirect(base_url() . 'admin/dashboard', 'refresh');
    }
	  /************* / default functin, redirects to login page if no admin logged in yet***/

    /*Admin dashboard code to redirect to admin page if successfull login** */
    function dashboard() {
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('backend/index', $page_data);
    }
	/******************* / Admin dashboard code to redirect to admin page if successfull login** */

    function manage_profile($param1 = null, $param2 = null, $param3 = null){
    if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
    if ($param1 == 'update') {
        $data['name']   =   $this->input->post('name');
        $data['email']  =   $this->input->post('email');
        $data['clinic_id'] = $this->session->user_data('clinic_id');
        $this->db->where('clinic_id', $this->session->userdata('clinic_id'));
        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
        redirect(base_url() . 'admin/manage_profile', 'refresh');
    }

    if ($param1 == 'change_password') {
        $data['new_password']           =   sha1($this->input->post('new_password'));
        $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));

        if ($data['new_password'] == $data['confirm_new_password']) {
           $this->db->where('admin_id', $this->session->userdata('admin_id'));
           $this->db->update('admin', array('password' => $data['new_password']));
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }

        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url() . 'admin/manage_profile', 'refresh');
    }

        $page_data['page_name']     = 'manage_profile';
        $page_data['page_title']    = get_phrase('Manage Profile');
        $page_data['edit_profile']  = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('backend/index', $page_data);
    }

    function enquiry_category($param1 = null, $param2 = null, $param3 = null){
    if($param1 == 'insert'){
        $this->crud_model->enquiry_category();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');
    }
    if($param1 == 'update'){
        $this->crud_model->update_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');
        }
    if($param1 == 'delete'){
        $this->crud_model->delete_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');
        }
        $page_data['page_name']     = 'enquiry_category';
        $page_data['page_title']    = get_phrase('Manage Category');
        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['enquiry_category']   = $this->db->get_where('enquiry_category', array('clinic_id'=>$clinic_id))->result_array();
        //$page_data['enquiry_category']  = $this->db->get('enquiry_category')->result_array();
        $this->load->view('backend/index', $page_data);
    }

    // function list_enquiry ($param1 = null, $param2 = null, $param3 = null){
    //     if($param1 == 'delete')
    //     {
    //         $this->crud_model->delete_enquiry($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
    //         redirect(base_url(). 'admin/list_enquiry', 'refresh');
    //     }
    //     $page_data['page_name']     = 'list_enquiry';
    //     $page_data['page_title']    = get_phrase('All Enquiries');
    //     $clinic_id = $this->session->userdata('clinic_id');
    //     $page_data['select_enquiry']   = $this->db->get_where('enquiry', array('clinic_id'=>$clinic_id))->result_array();
    //     $this->load->view('backend/index', $page_data);
    // }

    // function parent($param1 = null, $param2 = null, $param3 = null){
    //     if ($param1 == 'insert'){
    //         $this->crud_model->insert_parent();
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
    //         redirect(base_url(). 'admin/parent', 'refresh');
    //     }
    //     if($param1 == 'update'){
    //         $this->crud_model->update_parent($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
    //         redirect(base_url(). 'admin/parent', 'refresh');
    //     }
    //     if($param1 == 'delete'){
    //         $this->crud_model->delete_parent($param2);
    //         $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
    //         redirect(base_url(). 'admin/parent', 'refresh');
    //     }
    //     $page_data['page_name']         = 'parent';
    //     $page_data['page_title']        = get_phrase('Manage Parent');
    //     $clinic_id = $this->session->userdata('clinic_id');
    //     $page_data['select_parent']   = $this->db->get_where('parent', array('clinic_id'=>$clinic_id))->result_array();
    //    // $page_data['select_parent']   = $this->db->get_where('parent')->result_array();
    //     $this->load->view('backend/index', $page_data);
    // }





    /**   admin to exhibitor funtion ***/
   function exhibitor ($param1 = null, $param2 = null, $param3 = null){
    if($param1 == 'insert'){
        $this->exhibitor_model->insetexhibitorFunction();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/exhibitor', 'refresh');
    }
    if($param1 == 'update'){
        $this->exhibitor_model->updateexhibitorFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/exhibitor', 'refresh');
    }
    if($param1 == 'delete'){
        $this->exhibitor_model->deleteexhibitorFunction($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/exhibitor', 'refresh');
    }
    $page_data['page_name']     = 'exhibitor';
    $page_data['page_title']    = get_phrase('Manage exhibitor');
    $exhibition_id = $this->session->userdata('exhibition_id');
    $page_data['select_exhibitor']  = $this->db->get_where('exhibitor',array('exhibition_id'=>$exhibition_id))->result_array();
    $this->load->view('backend/index', $page_data);
}
/**  ends admin to exhibitor funtion ***/

    function get_designation($department_id = null){
        $designation = $this->db->get_where('designation', array('department_id' => $department_id))->result_array();
        foreach($designation as $key => $row)
        echo '<option value="'.$row['designation_id'].'">' . $row['name'] . '</option>';
    }

    function get_employees($department_id = null)
    {
        $employees = $this->db->get_where('teacher', array('department_id' => $department_id))->result_array();
        foreach($employees as $key => $employees)
            echo '<option value="' . $employees['teacher_id'] . '">' . $employees['name'] . '</option>';
    }

    function newusers() {
        $page_data['page_name'] = 'newusers';
        $page_data['page_title'] = get_phrase('newusers');
        $clinic_id = $this->session->userdata('clinic_id');
        $this->load->view('backend/index', $page_data);
    }


/***********  The function manages Class Information  ***********************/
// function groups ($param1 = null, $param2 = null, $param3 = null){
//     if($param1 == 'create'){
//         $this->group_model->createGroupFunction();
//         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
//         redirect(base_url(). 'admin/groups', 'refresh');
//     }
//     if($param1 == 'update'){
//         $this->group_model->updateGroupFunction($param2);
//         $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
//         redirect(base_url(). 'admin/groups', 'refresh');
//     }
//     if($param1 == 'delete'){
//         $this->group_model->deleteGroupFunction($param2);
//         $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
//         redirect(base_url(). 'admin/groups', 'refresh');
//     }
//     $page_data['page_name']     = 'group';
//     $page_data['page_title']    = get_phrase('Manage group');
//     $clinic_id = $this->session->userdata('clinic_id');
//     $this->load->view('backend/index', $page_data);
// }

// /***********  The function manages Section  ***********************/
// function sub_group ($param1 = null, $param2 = null, $param3 = null){
//     if($param1 == 'create'){
//     $this->sub_group_model->createSub_groupFunction();
//     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
//     redirect(base_url(). 'admin/sub_group', 'refresh');
//     }
//     if($param1 == 'update'){
//     $this->sub_group_model->updateSub_groupFunction($param2);
//     $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
//     redirect(base_url(). 'admin/sub_group', 'refresh');
//     }
//     if($param1 == 'delete'){
//     $this->sub_group_model->deleteSub_groupFunction($param2);
//     $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
//     redirect(base_url(). 'admin/sub_group', 'refresh');
//     }
//     $page_data['page_name']     = 'sub_group';
//     $page_data['page_title']    = get_phrase('Manage sub_group');
//     $clinic_id = $this->session->userdata('clinic_id');
//     $this->load->view('backend/index', $page_data);
// }

//     function sub_groups ($group_id = null){
//         if($group_id == '')
//         $group_id = $this->db->get('group')->first_row()->group_id;
//         $page_data['page_name']     = 'sub_group';
//         $page_data['group_id']      = $group_id;
//         $page_data['page_title']    = get_phrase('Manage sub_group');
//         $this->load->view('backend/index', $page_data);
//     }

//     function get_group_sub_group($group_id){
//         $sub_groups = $this->db->get_where('sub_group', array('group_id' => $group_id))->result_array();
//             foreach($sub_groups as $key => $sub_group)
//             {
//                 echo '<option value="'.$sub_group['sub_group_id'].'">'.$sub_group['name'].'</option>';
//             }
//     }


    function new_visitor ($param1 = null, $param2 = null, $param3 = null){
        if($param1 == 'create'){
            $this->visitor_model->createNewvisitor();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/new_visitor', 'refresh');
        }
        if($param1 == 'update'){
            $this->visitor_model->updateNewvisitor($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/visitor_information', 'refresh');
        }
        if($param1 == 'delete'){
            $this->visitor_model->deleteNewvisitor($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/visitor_information', 'refresh');
        }
        $page_data['page_name']     = 'new_visitor';
        // $exhibition_id = $this->session->userdata('exhibition_id');
        $page_data['page_title']    = get_phrase('Manage visitor');
        $this->load->view('backend/index', $page_data);
    }

    function newuser ($param1 = null, $param2 = null, $param3 = null){
        if($param1 == 'create'){
            $this->newuser_model->createNewuser();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'login', 'refresh');
        }
        if($param1 == 'update'){
            $this->newuser_model->updateNewuser($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'login', 'refresh');
        }
        if($param1 == 'delete'){
            $this->newuser_model->deleteNewuser($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'login', 'refresh');
        }
        $page_data['page_name']     = 'newuser';
        $clinic_id = $this->session->userdata('clinic_id');
        // $page_data['page_title']    = get_phrase('Manage user');
        $this->load->view('backend/login');

    }

    // function patient_information(){
    //     $page_data['page_name']     = 'patient_information';
    //     $clinic_id = $this->session->userdata('clinic_id');
    //     $page_data['page_title']    = get_phrase('List patient');
    //     $this->load->view('backend/index', $page_data);
    // }

    /**************************  search student function with ajax ends here   ***********************************/
    // function edit_student($student_id){

    //     $page_data['student_id']      = $student_id;
    //     $page_data['page_name']     = 'edit_student';
    //     $page_data['page_title']    = get_phrase('Edit Student');
    //     $this->load->view('backend/index', $page_data);
    // }



    function get_class_student($class_id){
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach($students as $key => $student)
            {
                echo '<option value="'.$student['student_id'].'">'.$student['name'].'</option>';
            }
    }

    function get_class_mass_student($class_id){
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach($students as $key => $student)
        {
            echo '<div class="">
            <label><input type="checkbox" class="check" name="student_id[]" value="' . $student['student_id'] . '">' . '&nbsp;'. $student['name'] .'</label></div>';
        }
        echo '<br><button type ="button" class="btn btn-success btn-sm btn-rounded" onClick="select()">'.get_phrase('Select All').'</button>';
        echo '<button type ="button" class="btn btn-primary btn-sm btn-rounded" onClick="unselect()">'.get_phrase('Unselect All').'</button>';
    }

    function student_invoice(){
        $page_data['page_name']     = 'student_invoice';
        $page_data['page_title']    = get_phrase('Manage Invoice');
        $this->load->view('backend/index', $page_data);
    }


     /***********  The function below manages school language ***********************/
     function manage_language ($param1 = null, $param2 = null, $param3 = null){
        if($param1 == 'edit_phrase'){
            $page_data['edit_profile']  =   $param2;
        }
        if($param1 == 'add_language'){
            $this->language_model->createNewLanguage();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }
        if($param1 == 'add_phrase'){
            $this->language_model->createNewLanguagePhrase();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }
        if($param1 == 'delete_language'){
            $this->language_model->deleteLanguage($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }
        $page_data['page_name']     = 'manage_language';
        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['page_title']    = get_phrase('Manage Language');
        $this->load->view('backend/index', $page_data);
    }
    /***********  The function that manages school language ends here ***********************/

    function updatePhraseWithAjax(){
        $checker['phrase_id']   =   $this->input->post('phraseId');
        $updater[$this->input->post('currentEditingLanguage')]  =   $this->input->post('updatedValue');
        $this->db->where('phrase_id', $checker['phrase_id'] );
        $this->db->update('language', $updater);
        echo $checker['phrase_id']. ' '. $this->input->post('currentEditingLanguage'). ' '. $this->input->post('updatedValue');
    }

    /***********  The function below manages new admin ***********************/
    function newAdministrator ($param1 = null, $param2 = null, $param3 = null){
        if($param1 == 'create'){
            $this->admin_model->createNewAdministrator();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }
        if($param1 == 'update'){
            $this->admin_model->updateAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }
        if($param1 == 'delete'){
            $this->admin_model->deleteAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/newAdministrator', 'refresh');
        }
        $page_data['page_name']     = 'newAdministrator';
         $clinic_id = $this->session->userdata('clinic_id');
        $page_data['page_title']    = get_phrase('New Administrator');
        $this->load->view('backend/index', $page_data);
    }



    /***********  The function that manages administrator ends here ***********************/

    function updateAdminRole($param2){
        $this->admin_model->updateAllDetailsForAdminRole($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/newAdministrator', 'refresh');
    }
    function set_language($lang){
        $this->session->set_userdata('language', $lang);
        redirect(base_url(). 'admin', 'refresh');
        recache();
    }
 /* Jitsi */

    function jitsi($param1 = null, $param2 = null, $param3 = null){
        if($param1 == 'add'){
            $this->live_class_model->createNewJitsiClassFunction();
            $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_created'));
            redirect(base_url() . 'admin/jitsi/', 'refresh');
        }
        if($param1 == 'edit'){
            $this->live_class_model->updateJitsiClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_updated'));
            redirect(base_url() . 'admin/jitsi/', 'refresh');
        }
        if($param1 == 'delete'){
            $this->live_class_model->deleteJitsiClassFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('live_class_successfuly_deleted'));
            redirect(base_url() . 'admin/jitsi/', 'refresh');
        }
        $page_data['page_name'] = 'jitsi';
        $clinic_id = $this->session->userdata('clinic_id');
        // $page_data['page_title'] = get_phrase('Online_Consultancy');
        $page_data['page_title'] = get_phrase('jitsi_live_class');
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
        $this->load->view('backend/host/jitsi', $page_data);
    }

    function appointment_list($param1 = null, $param2 = null, $param3 = null){
        if($param1 == 'insert'){
            $this->appointment_list_model->insertappointment_listFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/appointment_list', 'refresh');
        }
        if($param1 == 'update'){
            $this->appointment_list_model->updateappointmentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/appointment_list', 'refresh');
        }
        if($param1 == 'delete'){
            $this->appointment_list_model->deleteappointmentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/appointment_list', 'refresh');
        }
        $page_data['page_name']     = 'appointment_list';
        $page_data['page_title']    = get_phrase('manage_appointment_list');
        $clinic_id = $this->session->userdata('clinic_id');
        $page_data['select_appointment_list']  = $this->db->get_where('calendar',array(''))->result_array();
        $this->load->view('backend/index', $page_data);
    }


function schedule_list(){
    $data_calendar = $this->schedule_list_model->get_list($this->table);
            $calendar = array();
            foreach ($data_calendar as $key => $val)
            {
                $calendar[] = array(
                    'id'    => intval($val->id),
                    'title' => $val->title,
                    'description' => trim($val->description),
                    'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i"),
                    'end'   => date_format( date_create($val->end_date) ,"Y-m-d H:i"),
                    //   'start_time'   => date_format( date_create($val->start_time) ,"Y-m-d H:i"),
                    //   'end_time'   => date_format( date_create($val->end_time) ,"Y-m-d H:i"),
                    'color' => $val->color,
                    );
            }
        $page_data = array();
        $page_data['page_name']     = 'schedule_list';
        $page_data['page_title']    = get_phrase('manage_schedule_list');
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
                $status = $this->input->post('status');
                $visitor_id = $this->input->post('visitor_id');
                $visitor_name = $this->input->post('visitor_name');
                $exhibitor_id = $this->input->post('exhibitor_id');
                $exhibitor_name = $this->input->post('exhibitor_name');
                $param = array(
                    'title' => $title,
                    'description' => $description,
                    'start_date' => $start_date.' '.$start_time,
                    'end_date' => $start_date.' '.$end_time,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'color' => $color,
                    'status' => $status,
                    'visitor_id' => $visitor_id,
                    'visitor_name' => $visitor_name,
                    'exhibitor_id' => $exhibitor_id,
                    'exhibitor_name' => $exhibitor_name,
                );
                    $param['create_at']     = date('Y-m-d H:i:s');
                    $insert = $this->schedule_list_model->insert($this->table, $param);
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
                    $param['modified_at']       = date('Y-m-d H:i:s');
                    $update = $this->schedule_list_model->update($this->table, $param, $where);
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
                $delete = $this->schedule_list_model->delete($this->table, $where);
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

        function get_exhibitor_section1($exhibitor_id){
            $exhibitor = $this->db->get_where('exhibitor', array('exhibitor_id' => $exhibitor_id))->result_array();
                foreach($exhibitor as $key => $exhibitor)
                {
                    echo '<option value="'.$exhibitor['name'].'">'.$exhibitor['name'].'</option>';
                }
        }
        function get_patient_section2($patient_id){
            $patient = $this->db->get_where('patient', array('patient_id' => $patient_id))->result_array();
                foreach($patient as $key => $patient)
                {
                    echo '<option value="'.$patient['name'].'">'.$patient['name'].'</option>';
                }
        }

        function add_advertisment($param1 = null,$param2 = null,$param3 = null){
            if($param1 == 'add'){
                $this->advertisment_model->createNewAdvertismentFunction();
                $this->session->set_flashdata('flash_message', get_phrase('added_successfuly'));
                redirect(base_url() . 'admin/add_advertisment', 'refresh');
            }
            if($param1 == 'edit'){
                $this->advertisment_model->updateNewAdvertismentFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('successfuly_updated'));
                redirect(base_url() . 'admin/add_advertisment/', 'refresh');
            }
            if($param1 == 'delete'){
                $this->advertisment_model->deleteAdvertismentClassFunction($param2);
                $this->session->set_flashdata('flash_message', get_phrase('advertisment_successfuly_deleted'));
                redirect(base_url() . 'admin/add_advertisment/', 'refresh');
                }
                $page_data['page_name'] = 'add_advertisment';
                $page_data['page_title'] = get_phrase('add_advertisment');
                $this->load->view('backend/index',$page_data);
            }

            function edit_advertisment($clinic_advertisment_id){
            $page_data['page_name'] = 'edit_advertisment';
            $page_data['page_title'] = get_phrase('replace_advertisement');
            $page_data['toSelectFromAdvertismentWithId'] = $this->advertisment_model->toSelectFromAdvertismentWithId($clinic_advertisment_id);
            $this->load->view('backend/index',$page_data);
        }
}

