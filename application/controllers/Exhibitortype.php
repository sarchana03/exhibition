
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Exhibitortype extends CI_Controller {

    function __construct() {
        parent::__construct();
        		$this->load->database();
        		$this->load->library('session');
               $this->load->model('advertisment_model');

    }

        function exhibitortype ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->exhibitortype_model->insertexhibitortypeFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'exhibitortype/exhibitortype', 'refresh');
        }
        if($param1 == 'update'){
            $this->exhibitortype_model->updateexhibitortypeFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'exhibitortype/exhibitortype', 'refresh');
        }
        if($param1 == 'delete'){
            $this->exhibitortype_model->deleteexhibitortypeFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'exhibitortype/exhibitortype', 'refresh');
            }
        $page_data['page_name']     = 'exhibitortype';
        $page_data['page_title']    = get_phrase('Manage exhibitortype');
        $page_data['select_exhibitortype']  = $this->db->get('exhibitortype')->result_array();
        $this->load->view('backend/index', $page_data);
        }


        function delete_designation($exhibitortype_id = ''){
            $this->db->where('exhibitortype_id', $exhibitortype_id);
            $this->db->delete('designation');
            echo 'success';
        }


}