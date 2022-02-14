<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Visitor_calendar_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
        $this->table        = 'calendar';

    }


    function get_list()

    {
        $visitor_id = $this->session->userdata('visitor_id');


       $sql = "calendar WHERE `visitor_id`= '$visitor_id' ";


        return $this->db->get($sql)->result();
    }

    // function insert($calendar, $param)
    // {
    //     $this->db->insert($calendar, $param);

    //     return $this->db->id();
    // }
    function insert($table, $param)
    {
        $this->db->insert($table, $param);

        return $this->db->insert_id();
    }


    function update($table, $set, $where)
    {
        $this->db->where($where);
        $this->db->update($table, $set);
        return $this->db->affected_rows();
    }

 function delete($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }


}