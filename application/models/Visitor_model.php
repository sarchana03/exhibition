<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Visitor_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
        $this->load->model('advertisment_model');

    }



    // The function below insert into visitor house //
    function createvisitorHouse(){

        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            'description'      => html_escape($this->input->post('description')),

	    );

        $this->db->insert('house', $page_data);
    }

// The function below update visitor house //
    function updatevisitorHouse($param2){
        $page_data = array(
            'name'         => html_escape($this->input->post('name')),
            'description'  => html_escape($this->input->post('description'))
	    );

        $this->db->where('house_id', $param2);
        $this->db->update('house', $page_data);
    }

    // The function below delete from visitor house table //
    function deletevisitorHouse($param2){
        $this->db->where('house_id', $param2);
        $this->db->delete('house');
    }



    // The function below insert into visitor category //
    function createvisitorCategory(){

        $page_data = array(
            'name'        => html_escape($this->input->post('name')),
            'description' => html_escape($this->input->post('description'))
	    );
        $this->db->insert('visitor_category', $page_data);
    }

// The function below update visitor category //
    function updatevisitorCategory($param2){
        $page_data = array(
            'name'        => html_escape($this->input->post('name')),
            'description' => html_escape($this->input->post('description'))
	    );

        $this->db->where('visitor_category_id', $param2);
        $this->db->update('visitor_category', $page_data);
    }

    // The function below delete from visitor category table //
    function deletevisitorCategory($param2){
        $this->db->where('visitor_category_id', $param2);
        $this->db->delete('visitor_category');
    }




    //  the function below insert into visitor table
    function createNewvisitor(){

        $page_data = array(
            'exhibition_id'     => $this->session->userdata('exhibition_id'),
            'name'          => html_escape($this->input->post('name')),
            // 'group_id'          => html_escape($this->input->post('group_id')),
            // 'sub_group_id'          => html_escape($this->input->post('sub_group_id')),
            'birthday'      => html_escape($this->input->post('birthday')),
            'age'           => html_escape($this->input->post('age')),
            'place_birth'   => html_escape($this->input->post('place_birth')),
            'sex'           => html_escape($this->input->post('sex')),
            'm_tongue'      => html_escape($this->input->post('m_tongue')),
            'religion'      => html_escape($this->input->post('religion')),
            'blood_group'   => html_escape($this->input->post('blood_group')),
            'address'       => html_escape($this->input->post('address')),
            'city'          => html_escape($this->input->post('city')),
            'state'         => html_escape($this->input->post('state')),
            'nationality'   => html_escape($this->input->post('nationality')),
            'phone'         => html_escape($this->input->post('phone')),
            'email'         => html_escape($this->input->post('email')),
            // 'ps_attended'   => html_escape($this->input->post('ps_attended')),
            // 'ps_address'    => html_escape($this->input->post('ps_address')),
            // 'ps_purpose'    => html_escape($this->input->post('ps_purpose')),
            // 'class_study'   => html_escape($this->input->post('class_study')),
            // 'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
            // 'am_date'         => html_escape($this->input->post('am_date')),
            // 'tran_cert'       => html_escape($this->input->post('tran_cert')),
            // 'dob_cert'        => html_escape($this->input->post('dob_cert')),
            // 'mark_join'        => html_escape($this->input->post('mark_join')),
            // 'physical_h'      => html_escape($this->input->post('physical_h')),
            'password'        => sha1($this->input->post('password')),
            // 'class_id'        => html_escape($this->input->post('class_id')),
            // 'section_id'      => html_escape($this->input->post('section_id')),
            // 'parent_id'       => html_escape($this->input->post('parent_id')),
            'roll'            => html_escape($this->input->post('roll')),
            // 'transport_id'    => html_escape($this->input->post('transport_id')),
            // 'dormitory_id'    => html_escape($this->input->post('dormitory_id')),
            // 'house_id'        => html_escape($this->input->post('house_id')),
            // 'visitor_category_id' => html_escape($this->input->post('visitor_category_id')),
            // 'club_id'             => html_escape($this->input->post('club_id')),
            // 'session'             => html_escape($this->input->post('session')),
            'unique_id'          => uniqid('t-',true)

        );


    $this->db->insert('visitor', $page_data);
    $visitor_id = $this->db->insert_id();
    move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/visitor_image/' . $visitor_id . '.jpg');			// image with user ID

    }


    //the function below update visitor
    function updateNewvisitor($param2){
        $page_data = array(
            'name'          => html_escape($this->input->post('name')),
            // 'group_id'      => html_escape($this->input->post('group_id')),
            // 'sub_group_id'  => html_escape($this->input->post('sub_group_id')),
            'birthday'      => html_escape($this->input->post('birthday')),
            'age'           => html_escape($this->input->post('age')),
            'place_birth'   => html_escape($this->input->post('place_birth')),
            'sex'           => html_escape($this->input->post('sex')),
            'm_tongue'      => html_escape($this->input->post('m_tongue')),
            'religion'      => html_escape($this->input->post('religion')),
            'blood_group'   => html_escape($this->input->post('blood_group')),
            'address'       => html_escape($this->input->post('address')),
            'city'          => html_escape($this->input->post('city')),
            'state'         => html_escape($this->input->post('state')),
            'nationality'   => html_escape($this->input->post('nationality')),
            'phone'         => html_escape($this->input->post('phone')),
            'email'         => html_escape($this->input->post('email')),
            // 'ps_attended'   => html_escape($this->input->post('ps_attended')),
            // 'ps_address'    => html_escape($this->input->post('ps_address')),
            // 'ps_purpose'    => html_escape($this->input->post('ps_purpose')),
            'class_study'   => html_escape($this->input->post('class_study')),
            'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
            'am_date'         => html_escape($this->input->post('am_date')),
            'tran_cert'       => html_escape($this->input->post('tran_cert')),
            'dob_cert'        => html_escape($this->input->post('dob_cert')),
            'mark_join'        => html_escape($this->input->post('mark_join')),
            'physical_h'      => html_escape($this->input->post('physical_h')),
            'class_id'        => html_escape($this->input->post('class_id')),
            'section_id'      => html_escape($this->input->post('section_id')),
            'parent_id'       => html_escape($this->input->post('parent_id')),
            'transport_id'    => html_escape($this->input->post('transport_id')),
            'dormitory_id'    => html_escape($this->input->post('dormitory_id')),
            'house_id'        => html_escape($this->input->post('house_id')),
            'visitor_category_id' => html_escape($this->input->post('visitor_category_id')),
            'club_id'             => html_escape($this->input->post('club_id'))
	    );
        $this->db->where('visitor_id', $param2);
        $this->db->update('visitor', $page_data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/visitor_image/' . $param2 . '.jpg');

    }

    // the function below deletes from visitor table
    function deleteNewvisitor($param2){
        $this->db->where('visitor_id', $param2);
        $this->db->delete('visitor');
    }








}

