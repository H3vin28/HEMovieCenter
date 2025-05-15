<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Emp_model extends CI_Model {

    function getAllDO(){
        $this->db->from('designation_office');
        $this->db->where('status',1);
        return $this->db->get()->result();
    }

    function getClassroomByOffice($office_id){
        $this->db->from('classroom');
        $status = array($office_id,'0');
        $this->db->or_where_in('designated_office_id',$status);
        return $this->db->get()->result();
    }

    function checkUsername($username){
        $this->db->from('accounts a');
        $this->db->join('emp_information ei','a.id = ei.account_id');
        $this->db->where('a.username',$username);
        return $this->db->get()->result();
    }

    function insert_classroom($data){
        return $this->db->insert_batch('classroom',$data);
    }

    function insertData($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    function getDepartment($id){
        $this->db->from('designation_office');
        $this->db->where('id',$id);
        return $this->db->get()->row();
    }

    function getAllEmployeesByOffice($id){
        $this->db->select('e.*,a.*,d.*,a.status acc_status,d.id office_id');
        $this->db->from('emp_information e');
        $this->db->join('accounts a','a.id = e.account_id');
        $this->db->join('designation_office d','d.id = e.office_designation');
        $this->db->where('d.id',$id);
        $this->db->where('a.status !=',3);
        $this->db->order_by('e.lastname','ASC');
        return $this->db->get()->result();
    }

    function getInformation($account_id){
        $this->db->from('emp_information e');
        $this->db->join('accounts a','a.id = e.account_id');
        $this->db->join('designation_office o','o.id = e.office_designation');
        $this->db->where('e.account_id',$account_id);
        return $this->db->get()->row();
    }

    function checkTimeIn($date,$account_id){
        // $this->db->from('emp_time_in_out');
        $this->db->from('emp_time_in_out1');
        $this->db->where('date_time_in',$date);
        $this->db->where('account_id',$account_id);
        return $this->db->get()->row();
    }

    function UpdateTimeIn($data,$date,$account_id){
        $this->db->where('date_time_in',$date);
        $this->db->where('account_id',$account_id);
        // return $this->db->update('emp_time_in_out',$data);
        return $this->db->update('emp_time_in_out1',$data);
    }

    function InsertTimeIn($data){
        // return $this->db->insert('emp_time_in_out',$data);
        return $this->db->insert('emp_time_in_out1',$data);
    }

    function getTimeInOutPerEmp($month,$Year,$account_id){
        // $this->db->from('emp_time_in_out');
        $this->db->from('emp_time_in_out1');
        $this->db->where('month',$month);
        $this->db->where('year',$Year);
        $this->db->where('account_id',$account_id);
        return $this->db->get()->result();
    }

    function checkID($id){
        $this->db->from('accounts');
        $this->db->where('id',$id);
        return $this->db->get()->row();
    }

    function update($table,$data,$where){
        $this->db->where($where);
        $this->db->update('accounts',$data);
    }

}
