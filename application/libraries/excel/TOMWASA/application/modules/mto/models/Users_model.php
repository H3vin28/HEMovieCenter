<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model {

    function getAllDO(){
        $this->db->from('designation_office');
        $this->db->where('status',1);
        return $this->db->get()->result();
    }

    function checkUsername($username){
        $this->db->from('accounts a');
        $this->db->join('emp_information ei','a.id = ei.account_id');
        $this->db->where('a.username',$username);
        return $this->db->get()->result();
    }

    function insertData($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

}
