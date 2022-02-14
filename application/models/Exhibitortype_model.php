<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Exhibitortype_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }


    function insertexhibitortypeFunction(){

        $exhibitortype_code            = substr(md5(rand(100000000, 20000000000)), 0, 15);
        $data['exhibitortype_code']    = $exhibitortype_code;
        $data['name']               = $this->input->post('name');
        $this->db->insert('exhibitortype',$data);
        $exhibitortype_id              = $this->db->insert_id();
        $designation                = $this->input->post('designation');
        $school_id = $this->session->userdata('school_id');

        foreach ($designation as $designation):
            if($designation != ""):
            $data2['exhibitortype_id'] = $exhibitortype_id;
            $data2['name']          = $designation;
            $this->db->insert('designation',$data2);
        endif;
        endforeach;
    }

// The function below upate update exhibitortype and designation function //
    function updateexhibitortypeFunction($exhibitortype_code = ''){
        $exhibitortype_id  = $this->db->get_where('exhibitortype', array('exhibitortype_code' => $exhibitortype_code))->row()->exhibitortype_id;

        $data['name']   = $this->input->post('name');

        $this->db->where('exhibitortype_id', $exhibitortype_id);
        $this->db->update('exhibitortype', $data);

        // UPDATE EXISTING DESIGNATIONS
        $designations = $this->db->get_where('designation', array('exhibitortype_id' => $exhibitortype_id))->result_array();
        foreach ($designations as $row):
           $data2['name'] = $this->input->post('designation_' . $row['designation_id']);
           $this->db->where('designation_id',  $row['designation_id']);
           $this->db->update('designation', $data2);
        endforeach;

        // CREATE NEW DESIGNATIONS
        $designations = $this->input->post('designation');

        foreach($designations as $designation)
            if($designation != ""):
                $data3['exhibitortype_id'] = $exhibitortype_id;
                $data3['name']          = $designation;
                $this->db->insert('designation', $data3);
        endif;

    }

     //DELETE exhibitortype
    function deleteexhibitortypeFunction($exhibitortype_code = ''){

        $exhibitortype_id = $this->db->get_where('exhibitortype',array('exhibitortype_code'=>$exhibitortype_code))->row()->exhibitortype_id;
        $this->db->where('exhibitortype_id',$exhibitortype_id);
        $this->db->delete('designation');

        $this->db->where('exhibitortype_id',$exhibitortype_id);
        $this->db->delete('exhibitortype');
    }






}
