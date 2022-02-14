<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class exhibitor_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }


/**************************** The function below insert into bank and exhibitor tables   **************************** */
    function insetexhibitorFunction (){

        $bank_data['account_holder_name'] = $this->input->post('account_holder_name');
        $bank_data['account_number'] = $this->input->post('account_number');
        $bank_data['bank_name'] = $this->input->post('bank_name');
        $bank_data['branch'] = $this->input->post('branch');

        $this->db->insert('bank', $bank_data);
        $bank_id = $this->db->insert_id();


        $exhibitor_array = array(
            'exhibition_id'             => $this->session->userdata('exhibition_id'),
            'name'                  => $this->input->post('name'),
            // 'role'                  => $this->input->post('role'),
			'exhibitor_number'        => $this->input->post('exhibitor_number'),
			'birthday'              => $this->input->post('birthday'),
        	'sex'                   => $this->input->post('sex'),
            'religion'              => $this->input->post('religion'),
            'blood_group'           => $this->input->post('blood_group'),
            'address'               => $this->input->post('address'),
			'phone'                 => $this->input->post('phone'),
			'facebook'              => $this->input->post('facebook'),
        	'twitter'               => $this->input->post('twitter'),
            'googleplus'            => $this->input->post('googleplus'),
            'linkedin'              => $this->input->post('linkedin'),
            'qualification'         => $this->input->post('qualification'),
			'marital_status'        => $this->input->post('marital_status'),
			'password'              => sha1($this->input->post('password')),
        	'exhibitortype_id'         => $this->input->post('exhibitortype_id'),
            // 'designation_id'        => $this->input->post('designation_id'),
            'date_of_joining'       => $this->input->post('date_of_joining'),
            'joining_salary'        => $this->input->post('joining_salary'),
			'status'                => $this->input->post('status'),
			'date_of_leaving'       => $this->input->post('date_of_leaving'),
			// 'unique_id'       => $this->input->post('unique_id'),
            'unique_id'          => uniqid('t-',true)


            );

            $exhibitor_array['file_name'] = $_FILES["file_name"]["name"];
            $exhibitor_array['email'] = $this->input->post('email');
            $exhibitor_array['bank_id'] = $bank_id;
            $check_email = $this->db->get_where('exhibitor', array('email' => $exhibitor_array['email']))->row()->email;	// checking if email exists in database
            if($check_email != null)
            {
            $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
            redirect(base_url() . 'admin/exhibitor/', 'refresh');
            }
            else
            {
            $this->db->insert('exhibitor', $exhibitor_array);
            $exhibitor_id = $this->db->insert_id();

                move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/exhibitor_image/" . $_FILES["file_name"]["name"]);	// upload files
                move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/exhibitor_image/' . $exhibitor_id . '.jpg');			// image with user ID
            }

    }


    function updateexhibitorFunction($param2){

        $exhibitor_data = array(
            'name'                  => $this->input->post('name'),
            'role'                  => $this->input->post('role'),
			'birthday'              => $this->input->post('birthday'),
        	'sex'                   => $this->input->post('sex'),
            'religion'              => $this->input->post('religion'),
            'blood_group'           => $this->input->post('blood_group'),
            'address'               => $this->input->post('address'),
            'phone'                 => $this->input->post('phone'),
            'email'                 => $this->input->post('email'),
			'facebook'              => $this->input->post('facebook'),
        	'twitter'               => $this->input->post('twitter'),
            'googleplus'            => $this->input->post('googleplus'),
            'linkedin'              => $this->input->post('linkedin'),
            'qualification'         => $this->input->post('qualification'),
			'marital_status'        => $this->input->post('marital_status')
            );

            $this->db->where('exhibitor_id', $param2);
            $this->db->update('exhibitor', $exhibitor_data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/exhibitor_image/' . $param2 . '.jpg'); 			// image with user ID
    }


    function deleteexhibitorFunction($param2){

        $this->db->where('exhibitor_id', $param2);
        $this->db->delete('exhibitor');
    }





}
