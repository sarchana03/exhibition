<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Exhibitor_advertisment_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }


    function createNewAdvertismentFunction(){
        $page_data = array(
        'file_name'                       => $this->input->post('file_name'),
        'advertisement_content'           => $this->input->post('advertisement_content'),
    );


        $page_data['file_name'] = $_FILES["file_name"]["name"];
        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/exhibitor_advertisement_image/" . $_FILES["file_name"]["name"]);	// upload files
        // $this->db->insert('clinic_advertisment', $page_data);
        // $clinic_advertisment_id = $this->db->insert_id();
        // move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/advertisment_image/' . $clinic_advertisment_id . '.jpg');			// image with user ID
        $this->db->insert('exhibitor_advertisement', $page_data);
        // $admin_id = $this->db->insert_id();
        // move_uploaded_file($_FILES['admin_image']['tmp_name'], 'uploads/admin_image/' . $admin_id . '.jpg');
        // $page_data2['admin_id'] =  $admin_id;
        // $this->db->insert('admin_role', $page_data2);
    }

    // function deleteAdministrator($param2){
    //     $this->db->where('admin_id', $param2);
    //     $this->db->delete('admin');
    // }
    // function select_all_the_administrator_from_admin_table(){
    //     $all_selected_administrator = $this->db->get('admin');
    //     return $all_selected_administrator->result_array();
    // }

    // function updateAllDetailsForAdminRole($param2){
    //     $page_data['dashboard']         = html_escape($this->input->post('dashboard'));
    //     $page_data['manage_academics']  = html_escape($this->input->post('manage_academics'));
    //     $page_data['manage_employee']   = html_escape($this->input->post('manage_employee'));
    //     $page_data['manage_patient']    = html_escape($this->input->post('manage_patient'));
    //     $page_data['manage_student']    = html_escape($this->input->post('manage_student'));
    //     $page_data['manage_attendance'] = html_escape($this->input->post('manage_attendance'));
    //     $page_data['download_page']     = html_escape($this->input->post('download_page'));
    //     $page_data['manage_parent']     = html_escape($this->input->post('manage_parent'));
    //     $page_data['manage_alumni']     = html_escape($this->input->post('manage_alumni'));
    //     $this->db->where('admin_id', $param2);
    //     $this->db->update('admin_role', $page_data);
    // }

    function selectAdvertismentExhibitorInsert(){
        $user_id= $this->session->userdata('user_id');
        $staff = $this->session->userdata('user_id');
        $sql = "select * from exhibitor_advertisement where user_id='".$staff."' order by exhibitor_advertisement_id asc";
        return $this->db->query($sql)->result_array();
    }

    function selectAllImageFromFolder(){
        $file_name = $this->session->userdata('file_name');
        // $receivetopatient = $this->db->get_where('chat', array('patient_id' => $patient_id))->row()->patient_id;
        $sendbydoctor = $this->db->get_where('clinic_advertisment', array('file_name' =>  $file_name))->row()->file_name;
        $sql = "select * from clinic_advertisment where clinic_advertisment_id ='".$sendbydoctor."' order by clinic_advertisment_id asc";
        return $this->db->query($sql)->result_array();
    }

    function toSelectFromAdvertisementWithId($exhibitor_advertisement_id){
        $sql = "select * from exhibitor_advertisement where exhibitor_advertisement_id ='".$exhibitor_advertisement_id."'";
        return $this->db->query($sql)->result_array();
    }


    function updateNewAdvertismentFunction($param2){
        $page_data = array(
            'file_name'                       => $this->input->post('file_name'),
            'advertisement_content'           => $this->input->post('advertisement_content'),
        );
            $page_data['file_name'] = $_FILES["file_name"]["name"];
            move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/exhibitor_advertisement_image/" . $_FILES["file_name"]["name"]);	// upload files
            $this->db->where('exhibitor_advertisement_id', $param2);
            $this->db->update('exhibitor_advertisement', $page_data);
    }

    function deleteAdvertismentClassFunction($param2){
        $this->db->where('exhibitor_advertisement_id', $param2);
        $this->db->delete('exhibitor_advertisement');
    }
}