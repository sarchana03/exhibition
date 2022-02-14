<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Exhibitor_calendar_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();

    }

    function get_list()

    {
        $exhibitor_id = $this->session->userdata('exhibitor_id');


       $sql = "calendar WHERE `exhibitor_id`= '$exhibitor_id' ";


        return $this->db->get($sql)->result();
    }

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

    function updatee($table, $set, $where)
    {
        $this->db->where($where);
        $this->db->updatee($table, $set);
        return $this->db->affected_rows();
    }

 function delete($table, $where)
    {
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }

}