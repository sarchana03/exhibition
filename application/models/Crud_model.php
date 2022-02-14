<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Crud_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
        $this->table        = 'chat';
        $this->load->database();                                //Load Databse Class
        $this->load->library('session');

    }

	 function get_type_name_by_id($type, $type_id = '', $field = 'name') {
        $this->db->where($type . '_id', $type_id);
        $query = $this->db->get($type);
        $result = $query->result_array();
        foreach ($result as $row)
        return $row[$field];
    }
    function get_general_messages(){
        $query = $this->db->query("SELECT * FROM general_message ORDER BY general_message_id asc");
        return $query->result_array();
    }




     function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;

    }

    function get_subject_name_by_id ($subject_id){
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();
            return $query->name;
    }

    function get_class_name ($class_id){
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $result = $query->result_array();
        foreach ($result as $key => $row)
                return $row['name'];

    }




    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }
    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_doctors() {
        $query = $this->db->get('doctor');
        return $query->result_array();
    }
    function get_doctor_name($doctor_id) {
        $query = $this->db->get_where('doctor', array('doctor_id' => $doctor_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    // function get_chat_messages_receiver($doctor_id) {
    //     $query = $this->db->get_where('chat', array('doctor_id' => $doctor_id));
    //     $res = $query->result_array();
    //     foreach($res as $row)
    //     return $row['message'];
    // }

    function get_chat_messages(){
        $query = $this->db->query("SELECT * FROM chat ORDER BY chat_id asc");
        return $query->result_array();
    }









    function get_admin_name($admin_id) {
        $query = $this->db->get_where('admin', array('admin_id' => $admin_id));
        $resi = $query->result_array();
        foreach ($resi as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

    function get_chat_info($chat_id){
        $query = $this->db->get_where('chat',array('chat_id' => $chat_id));
        return $query->result_array();
    }


    function get_invoice_info() {
        $query = $this->db->get('invoice');
        return $query->result_array();
    }

    /***********  Subjects  *******************/
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }


    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_patients() {
        $query = $this->db->get('patient');
        return $query->result_array();
    }
    function get_visitors() {
        $query = $this->db->get('visitor');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    /***********  Exams  *******************/
    function get_exams() {
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    /***********  Grades  *******************/
    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_students($class_id){
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }

    function list_all_student_and_order_with_student_id(){

        $data = array();
        $sql = "select * from student order by student_id desc limit 0, 5";
        $all_student_selected = $this->db->query($sql)->result_array();

        foreach($all_student_selected as $key => $selected_students_from_student_table){
            $student_id = $selected_students_from_student_table['student_id'];
            $face_file = 'uploads/student_image/'. $student_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/student_image/default_image.jpg/';
            }

            $selected_students_from_student_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_students_from_student_table);
        }

        return $data;
    }

    function list_all_teacher_and_order_with_teacher_id(){

        $data = array();
        $sql = "select * from teacher order by teacher_id desc limit 0, 5";
        $all_teacher_selected = $this->db->query($sql)->result_array();

        foreach($all_teacher_selected as $key => $selected_teachers_from_teacher_table){
            $teacher_id = $selected_teachers_from_teacher_table['teacher_id'];
            $face_file = 'uploads/teacher_image/'. $teacher_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/teacher_image/default_image.jpg/';
            }

            $selected_teachers_from_teacher_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_teachers_from_teacher_table);
        }

        return $data;
    }



    function list_all_exhibitor_and_order_with_exhibitor_id(){

        $data = array();
        $sql = "select * from exhibitor order by exhibitor_id asc limit 0, 20";
        $all_exhibitor_selected = $this->db->query($sql)->result_array();

        foreach($all_exhibitor_selected as $key => $selected_exhibitors_from_exhibitor_table){
            $exhibitor_id = $selected_exhibitors_from_exhibitor_table['exhibitor_id'];
            $face_file = 'uploads/exhibitor_image/'. $exhibitor_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/exhibitor_image/default_image.jpg/';
            }

            $selected_exhibitors_from_exhibitor_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_exhibitors_from_exhibitor_table);
        }

        return $data;
    }

    function list_all_exhibitor_and_order_with_chat_id(){

        $data = array();




        // $sql = "select * from chat group by chat_id desc having count(*)>0";
        $sql = "select * from exhibitor order by exhibitor_id desc limit 0, 10";
        // $sql = "select * from chat order by chat_id desc limit 0, 20" GROUP BY chatId HAVING COUNT(*) = 2;
        // $sql = "select * from chat where chat_id in ( select chat_id from chat group by exhibitor_id having count(*) > 1 )";

        $all_exhibitor_selected = $this->db->query($sql)->result_array();

        foreach($all_exhibitor_selected as $key => $selected_exhibitors_from_exhibitor_table){
            $exhibitor_id = $selected_exhibitors_from_exhibitor_table['exhibitor_id'];
            $face_file = 'uploads/exhibitor_image/'. $exhibitor_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/exhibitor_image/default_image.jpg/';
            }

            $selected_exhibitors_from_exhibitor_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_exhibitors_from_exhibitor_table);
        }

        return $data;
    }



    function list_all_visitor_and_order_with_visitor_id(){

        $data = array();
        $sql = "select  * from visitor order by visitor_id asc limit 0,20";
        $all_visitor_selected = $this->db->query($sql)->result_array();
        foreach($all_visitor_selected as $key => $selected_visitors_from_visitor_table){
            $visitor_id = $selected_visitors_from_visitor_table['visitor_id'];
            $face_file = 'uploads/visitor_image/'. $visitor_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/visitor_image/default_image.jpg/';
            }

            $selected_visitors_from_visitor_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_visitors_from_visitor_table);
        }

        return $data;
    }


    // function list_all_images_from_folder(){

    //     $data = array();
    //     $sql = "select  * from clinic_advertisment order by clinic_advertisment_id asc limit 0,3";
    //     $all_patient_selected = $this->db->query($sql)->result_array();
    //     foreach($all_patient_selected as $key => $selected_patients_from_patient_table){
    //         $clinic_advertisment_id = $selected_patients_from_patient_table['clinic_advertisment_id'];
    //         $face_file = 'uploads/patient_image/'. $clinic_advertisment_id . '.jpg';
    //         if(!file_exists($face_file)){
    //             $face_file = 'uploads/patient_image/default_image.jpg/';
    //         }

    //         $selected_patients_from_patient_table['face_file'] = base_url() . $face_file;
    //         array_push($data, $selected_patients_from_patient_table);
    //     }

    //     return $data;
    // }

    function list_all_newuser_and_order_with_newuser_id(){

        $data = array();
        // $sql = "select * from newuser order by user_id desc limit 0, 5";
        $sql = "select * from newuser order by user_id desc limit 2, 1";
        $all_newuser_selected = $this->db->query($sql)->result_array();

        foreach($all_newuser_selected as $key => $selected_newusers_from_newuser_table){
            $user_id = $selected_newusers_from_newuser_table['newuser_id'];
            $face_file = 'uploads/newuser_image/'. $user_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/newuser_image/default_image.jpg/';
            }

            $selected_newusers_from_newuser_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_newusers_from_newuser_table);
        }

        return $data;
    }

    function list_all_newuser_and_order_with_newuser_idd(){

        $data = array();
        // $sql = "select * from newuser order by user_id desc limit 0, 5";
        $sql = "select * from newuser order by user_id desc limit 1, 1";
        $all_newuser_selected = $this->db->query($sql)->result_array();

        foreach($all_newuser_selected as $key => $selected_newusers_from_newuser_table){
            $user_id = $selected_newusers_from_newuser_table['newuser_id'];
            $face_file = 'uploads/newuser_image/'. $user_id . '.jpg';
            if(!file_exists($face_file)){
                $face_file = 'uploads/newuser_image/default_image.jpg/';
            }

            $selected_newusers_from_newuser_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_newusers_from_newuser_table);
        }

        return $data;
    }

    function list_all_calendar_and_order_with__id(){
        $visitor_id = $this->session->userdata('visitor_id');

            $data = array();


            $sql = "select * from calendar where visitor_id = $visitor_id order by id desc";
            $all_calendar_selected = $this->db->query($sql)->result_array();

            foreach($all_calendar_selected as $key => $selected_calendar_from_calendar_table){
                $id = $selected_calendar_from_calendar_table['exhibitor_id'];
                $face_file = 'uploads/exhibitor_image/'. $id . '.jpg';
                if(!file_exists($face_file)){
                    $face_file = 'uploads/exhibitor_image/default_image.jpg/';
                }

                $selected_calendar_from_calendar_table['face_file'] = base_url() . $face_file;
                array_push($data, $selected_calendar_from_calendar_table);
            }

            return $data;
        }

    function list_all_calendar_and_order1_with__id(){
        $exhibitor_id = $this->session->userdata('exhibitor_id');

            $data = array();


            $sql = "select * from calendar where exhibitor_id = $exhibitor_id order by id desc ";
            $all_calendar_selected = $this->db->query($sql)->result_array();

            foreach($all_calendar_selected as $key => $selected_calendar_from_calendar_table){
                $id = $selected_calendar_from_calendar_table['exhibitor_id'];
                $face_file = 'uploads/exhibitor_image/'. $id . '.jpg';
                if(!file_exists($face_file)){
                    $face_file = 'uploads/exhibitor_image/default_image.jpg/';
                }

                $selected_calendar_from_calendar_table['face_file'] = base_url() . $face_file;
                array_push($data, $selected_calendar_from_calendar_table);
            }

            return $data;
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


            function list_all_chat_and_order_with_chatid1(){
                $patient_id = $this->session->userdata('patient_id');
                $doctor_id = $this->session->userdata('doctor_id');
                    $data = array();
                    $sql = "SELECT * FROM `chat` WHERE `patient_id` = '.$patient_id.' OR `patient_id` ='.$doctor_id.' AND `doctor_id` = '.$doctor_id.' OR `doctor_id` = '.$patient_id.' ";

                    $receivedoctor = $this->db->get_where('chat', array('doctor_id' => $this->session->userdata('doctor_id')))->row()->doctor_id;
                    $sendpatient = $this->db->get_where('chat', array('patient_id' => $this->session->userdata('patient_id')))->row()->patient_id;

                    return $this->db->query($sql)->result_array();

                }

    function enquiry_category(){

        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');
        $this->db->insert('enquiry_category', $page_data);
    }

    function update_category($param2){
        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');
        $this->db->where('enquiry_category_id', $param2);
        $this->db->update('enquiry_category', $page_data);

    }

    function delete_category($param2){
        $this->db->where('enquiry_category_id', $param2);
        $this->db->delete('enquiry_category');

    }

    function delete_enquiry($param2){
        $this->db->where('enquiry_id', $param2);
        $this->db->delete('enquiry');
    }

    function insert_club(){

        $page_data['club_name']     =   $this->input->post('club_name');
        $page_data['desc']          =   $this->input->post('desc');
        $page_data['date']          =   $this->input->post('date');

        $this->db->insert('club', $page_data);
    }

    function update_club($param2){

        $page_data['club_name']     =   $this->input->post('club_name');
        $page_data['desc']          =   $this->input->post('desc');
        $page_data['date']          =   $this->input->post('date');

        $this->db->where('club_id', $param2);
        $this->db->update('club', $page_data);
    }


    function delete_club($param2){
        $this->db->where('club_id', $param2);
        $this->db->delete('club');
    }


    function insert_circular(){

        $page_data['title']         =   $this->input->post('title');
        $page_data['reference']     =   $this->input->post('reference');
        $page_data['content']       =   $this->input->post('content');
        $page_data['date']          =   $this->input->post('date');

        $this->db->insert('circular', $page_data);

    }

    function update_circular($param2){
        $page_data['title']         =   $this->input->post('title');
        $page_data['reference']     =   $this->input->post('reference');
        $page_data['content']       =   $this->input->post('content');
        $page_data['date']          =   $this->input->post('date');

        $this->db->where('circular_id', $param2);
        $this->db->update('circular', $page_data);
    }


    function delete_circular($param2){
        $this->db->where('circular_id', $param2);
        $this->db->delete('circular');
    }


    function insert_parent(){

        $page_data = array(
            'school_id' => $this->session->userdata('school_id'),
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
			'password' => sha1($this->input->post('password')),
			'phone' => $this->input->post('phone'),
        	'address' => $this->input->post('address'),
        	'profession' => $this->input->post('profession')
			);
        $this->db->insert('parent', $page_data);
    }


    function update_parent($param2){
        $page_data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
        	'address' => $this->input->post('address'),
        	'profession' => $this->input->post('profession')
			);

        $this->db->where('parent_id', $param2);
        $this->db->update('parent', $page_data);
    }

    function delete_parent($param2){
        $this->db->where('parent_id', $param2);
        $this->db->delete('parent');
    }

    function insert_librarian(){
        $page_data = array(		// array data that postulate the input fileds
            'school_id'         => $this->session->userdata('school_id'),
            'name' 				=> $this->input->post('name'),
            'librarian_number' 	=> $this->input->post('librarian_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password'))
            );

        $page_data['file_name'] = $_FILES["file_name"]["name"];
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('librarian', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null)
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/librarian/', 'refresh');
		}
		else
		{
        $this->db->insert('librarian', $page_data);
        $librarian_id = $this->db->insert_id();


            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/librarian_image/" . $_FILES["file_name"]["name"]);	// upload files
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $librarian_id . '.jpg');			// image with user ID
		    //$this->email_model->account_opening_email('librarian', $data['email']); //Send email to receipient email adddrress upon account opening
            }
    }

    function update_librarian($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status')
            );

                $this->db->where('librarian_id', $param2);
                $this->db->update('librarian', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $param2 . '.jpg');
    }

    function delete_librarian($param2){
        $this->db->where('librarian_id', $param2);
        $this->db->delete('librarian');
    }



    function insert_accountant(){
        $page_data = array(		// array data that postulate the input fileds
            'school_id'             => $this->session->userdata('school_id'),
            'name' 				=> $this->input->post('name'),
            'accountant_number' 	=> $this->input->post('accountant_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),

            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password'))
            );

        $page_data['file_name'] = $_FILES["file_name"]["name"];
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('accountant', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null)
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/accountant/', 'refresh');
		}
		else
		{
        $this->db->insert('accountant', $page_data);
        $accountant_id = $this->db->insert_id();

            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/accountant_image/" . $_FILES["file_name"]["name"]);	// upload files
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $accountant_id . '.jpg');			// image with user ID
		    //$this->email_model->account_opening_email('accountant', $data['email']); //Send email to receipient email adddrress upon account opening
            }
    }




    function update_accountant($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),
            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status')
            );

                $this->db->where('accountant_id', $param2);
                $this->db->update('accountant', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $param2 . '.jpg');
    }

    function delete_accountant($param2){
        $this->db->where('accountant_id', $param2);
        $this->db->delete('accountant');
    }




    function insert_hostel(){
        $page_data = array(		// array data that postulate the input fileds
            'school_id'             => $this->session->userdata('school_id'),
            'name' 				=> $this->input->post('name'),
            'hostel_number' 	=> $this->input->post('hostel_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),

            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password'))
            );

        $page_data['file_name'] = $_FILES["file_name"]["name"];
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('hostel', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null)
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/hostel/', 'refresh');
		}
		else
		{
        $this->db->insert('hostel', $page_data);
        $hostel_id = $this->db->insert_id();

            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/hostel_image/" . $_FILES["file_name"]["name"]);	// upload files
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $hostel_id . '.jpg');			// image with user ID
		    //$this->email_model->account_opening_email('hostel', $data['email']); //Send email to receipient email adddrress upon account opening
            }
    }


    function update_hostel($param2){
        $page_data = array(			// array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),

            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status')
            );

                $this->db->where('hostel_id', $param2);
                $this->db->update('hostel', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $param2 . '.jpg');
    }

    function delete_hostel($param2){
        $this->db->where('hostel_id', $param2);
        $this->db->delete('hostel');
    }



    function insert_hrm(){
        $page_data = array(		// array data that postulate the input fileds
            'school_id'             => $this->session->userdata('school_id'),
            'name' 				=> $this->input->post('name'),
            'hrm_number' 	    => $this->input->post('hrm_number'),
            'birthday' 			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),

            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status'	=> $this->input->post('marital_status'),
            'password' 			=> sha1($this->input->post('password'))
            );

        $page_data['file_name'] = $_FILES["file_name"]["name"];
		$page_data['email'] = $this->input->post('email');
		$check_email = $this->db->get_where('hrm', array('email' => $page_data['email']))->row()->email;	// checking if email exists in database
		if($check_email != null)
		{
		$this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/hrm/', 'refresh');
		}
		else
		{
        $this->db->insert('hrm', $page_data);
        $hrm_id = $this->db->insert_id();

            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/hrm_image/" . $_FILES["file_name"]["name"]);	// upload files
        	move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $hrm_id . '.jpg');			// image with user ID
		    //$this->email_model->account_opening_email('hrm', $data['email']); //Send email to receipient email adddrress upon account opening
            }
    }


    function update_hrm($param2){
        $page_data = array(
            // array starts from here
            'name'				=> $this->input->post('name'),
            'birthday'			=> $this->input->post('birthday'),
            'sex' 				=> $this->input->post('sex'),
            'religion' 			=> $this->input->post('religion'),
            'blood_group' 		=> $this->input->post('blood_group'),
            'address' 			=> $this->input->post('address'),
            'phone' 			=> $this->input->post('phone'),

            'email' 			=> $this->input->post('email'),
            'facebook' 			=> $this->input->post('facebook'),
            'twitter' 			=> $this->input->post('twitter'),
            'googleplus' 		=> $this->input->post('googleplus'),
            'linkedin' 			=> $this->input->post('linkedin'),
            'qualification' 	=> $this->input->post('qualification'),
            'marital_status' 	=> $this->input->post('marital_status')
            );

                $this->db->where('hrm_id', $param2);
                $this->db->update('hrm', $page_data);
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $param2 . '.jpg');
    }

    function delete_hrm($param2){
        $this->db->where('hrm_id', $param2);
        $this->db->delete('hrm');
    }


    function system_logo(){

        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
    }


    function update_settings(){

        //  $data['description'] =  $this->input->post('system_name');
        //  $this->db->where('type', 'system_name');
        //  $this->db->update('settings', $data);

        //  $data['description'] = $this->input->post('system_title');
        //  $this->db->where('type', 'system_title');
        //  $this->db->update('settings', $data);

        $data['description'] = $this->input->get('clinic_id');
        $this->db->where('type', 'clinic_id');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('clinic_name');
        $this->db->where('type', 'clinic_name');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('clinic_admin_email');
        $this->db->where('type', 'clinic_admin_email');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('password');
        $this->db->where('type', 'password');
        $this->db->update('clinic', $data);


        $data['description']    =   $this->input->post('location');
        $this->db->where('type', 'location');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('currency');
        $this->db->where('type', 'currency');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('system_email');
        $this->db->where('type', 'system_email');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('language');
        $this->db->where('type', 'language');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('text_align');
        $this->db->where('type', 'text_align');
        $this->db->update('clinic', $data);


        $data['description']    =   $this->input->post('running_session');
        $this->db->where('type', 'session');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('footer');
        $this->db->where('type', 'footer');
        $this->db->update('clinic', $data);

        $data['description']    =   $this->input->post('paypal_email');
        $this->db->where('type', 'paypal_email');
        $this->db->update('clinic', $data);



        $settiings_array = array(
            'clinic_id'  => $this->session->userdata('clinic_id'),
        );
        $this->db->update('clinic', $settiings_array);

    }


    function update_theme(){

        $data['description']    =   $this->input->post('skin_colour');
        $this->db->where('type', 'skin_colour');
        $this->db->update('clinic', $data);
    }

    function get_settings($type){
        $get_settings = $this->db->get_where('clinic', array('type' => $type))->row()->description;
        return $get_settings;
    }


    function stripe_settings (){
        $stripe_info = array();

        $stripe['stripe_active']    = html_escape($this->input->post('stripe_active'));
        $stripe['testmode']         = html_escape($this->input->post('testmode'));
        $stripe['secret_key']       = html_escape($this->input->post('secret_key'));
        $stripe['public_key']       = html_escape($this->input->post('public_key'));
        $stripe['secret_live_key']  = html_escape($this->input->post('secret_live_key'));
        $stripe['public_live_key']  = html_escape($this->input->post('public_live_key'));

        array_push($stripe_info, $stripe);

        $data['description'] = json_encode($stripe_info);
        $this->db->where('type', 'stripe_setting');
        $this->db->update('clinic', $data);

    }

    function paypal_settings(){
        $paypal_info = array();

        $stripe['paypal_active']          = html_escape($this->input->post('paypal_active'));
        $stripe['paypal_mode']            = html_escape($this->input->post('paypal_mode'));
        $stripe['sandbox_client_id']      = html_escape($this->input->post('sandbox_client_id'));
        $stripe['production_client_id']   = html_escape($this->input->post('production_client_id'));

        array_push($paypal_info, $stripe);

        $data['description'] = json_encode($paypal_info);
        $this->db->where('type', 'paypal_setting');
        $this->db->update('clinic', $data);


    }


   function send_student_score_model(){

        $exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');
        $receiver = $this->input->post('receiver');

        $select_all_student_from_student_table = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
        foreach ($select_all_student_from_student_table as $key => $all_selected_student_from_student_table){

            if($receiver == 'student')
                $recieverPhoneNumber = $all_selected_student_from_student_table['phone'];
            if($receiver == 'parent' && $all_selected_student_from_student_table['parent_id'] != NULL)
            $select_from_parent_table = $this->db->get_where('parent', array('parent_id' => $all_selected_student_from_student_table['parent_id']))->row()->phone;

            $this->db->where('exam_id', $exam_id);
            $this->db->where('student_id', $all_selected_student_from_student_table['student_id']);
            $select_student_score_from_mark_table = $this->db->get('mark')->result_array();

            foreach($select_student_score_from_mark_table as $key => $all_selected_student_scores_from_mark_table){
                $message = '';

                $selelect_all_subject_from_subject_table = $this->db->get_where('subject', array('subject_id' => $all_selected_student_scores_from_mark_table['subject_id']))->row()->name;
                $student_mark_obtained_in_class_score_and_exam = $all_selected_student_scores_from_mark_table['class_score1'] + $all_selected_student_scores_from_mark_table['class_score2'] + $all_selected_student_scores_from_mark_table['class_score3'] + $all_selected_student_scores_from_mark_table['exam_score'];
                $message .= $all_selected_student_scores_from_mark_table['student_id'] . ' ' . $selelect_all_subject_from_subject_table . ':' . $student_mark_obtained_in_class_score_and_exam . 'Over 100';

                // Sending sms
                $this->sms_model->send_sms($message, $recieverPhoneNumber);
            }


        }

    }

/* School Crud Model */

    function insert_school(){
        $page_data = array(		// array data that postulate the input fileds
            'school_id'             => $this->input->post('school_id'),
            'school_name'           => $this->input->post('school_name'),
            'school_admin_email'    => $this->input->post('school_admin_email'),
			'password'              => sha1($this->input->post('password')),
			'location'              => $this->input->post('location'),
        	'phone'                 => $this->input->post('phone'),
        	'school_email'          => $this->input->post('school_email'),
            'language'              => $this->input->post('language'),
            'text_align'            => $this->input->post('text_align'),
            'session'               => $this->input->post('session'),

            );

        $this->db->insert('school', $page_data);
        $school_id = $this->db->insert_id();

    }

    function update_school($param2){
        $page_data = array(			// array starts from here
            'school_name'           => $this->input->post('school_name'),
            'school_admin_email'    => $this->input->post('school_admin_email'),
			'password'              => sha1($this->input->post('password')),
			'location'              => $this->input->post('location'),
        	'phone'                 => $this->input->post('phone'),
        	'school_email'          => $this->input->post('school_email'),
            'language'              => $this->input->post('language'),
            'text_align'            => $this->input->post('text_align'),
            'session'               => $this->input->post('session'),

            );

                $this->db->where('school_id', $param2);
                $this->db->update('school', $page_data);

    }

    function delete_school($param2){
        $this->db->where('school_id', $param2);
        $this->db->delete('school');
    }


    function list_all_appointment_list_model_and_order_with_id(){

        $data = array();
        $sql = "select * from calendar order by id desc  ";


        $all_appointment_list_selected = $this->db->query($sql)->result_array();

        foreach($all_appointment_list_selected as $key => $selected_appointment_list_from_group_table){
            $id = $selected_appointment_list_from_group_table['id'];
           // $face_file = 'uploads/teacher_image/'. $teacher_id . '.jpg';
            //if(!file_exists($face_file)){
               // $face_file = 'uploads/teacher_image/default_image.jpg/';
           //}

            //$selected_teachers_from_teacher_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_appointment_list_from_group_table);
        }

        return $data;
    }

    function list_all_user_list_model_and_order_with_user_id(){

        $data = array();
        $sql = "select * from user_list ";


        $all_user_list_selected = $this->db->query($sql)->result_array();

        foreach($all_user_list_selected as $key => $selected_user_from_user_table){
            $user_id = $selected_user_from_user_table['user_id'];
           $face_file = 'uploads/user_image/'. $user_id . '.jpg';
            if(!file_exists($face_file)){
               $face_file = 'uploads/user_image/default_image.jpg/';
           }

            $selected_user_from_user_table['face_file'] = base_url() . $face_file;
            array_push($data, $selected_user_from_user_table);
        }

        return $data;
    }
    function list_all_schedule_view_model_and_order_with_schedule_id(){

        $data = array();
        $sql = "select * from appointment_list ";


        $all_schedule_selected = $this->db->query($sql)->result_array();

        foreach($all_schedule_selected as $key => $selected_schedule_from_schedule_table){
            $schedule_id = $selected_schedule_from_schedule_table['schedule_id'];
           /*$face_file = 'uploads/user_image/'. $user_id . '.jpg';
            if(!file_exists($face_file)){
               $face_file = 'uploads/user_image/default_image.jpg/';
           }

            $selected_user_from_user_table['face_file'] = base_url() . $face_file;*/
            array_push($data, $selected_schedule_from_schedule_table);
        }

        return $data;
    }




}

