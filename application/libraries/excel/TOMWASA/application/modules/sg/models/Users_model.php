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

    function getAddress($table,$condition,$where,$ob_name){
        $this->db->from($table);
        if($condition != 'region1'){
            $this->db->where($where);
        }
        $this->db->order_by($ob_name.' ASC');
        return $this->db->get()->result();
    }

    function insertData($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    function CheckAccount($username,$password){
        $this->db->from('accounts');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        return $this->db->get()->result();
    }

    function getInformation($table,$account_id){
        $this->db->select('i.*,r.regDesc region_name,p.provDesc province_name,m.citymunDesc muni_name,b.brgyDesc barangay_name');
        $this->db->from($table.' i');
        $this->db->join('refregion r','r.regCode = i.region');
        $this->db->join('refprovince p','p.provCode = i.province');
        $this->db->join('refcitymun m','m.citymunCode = i.municipal_city');
        $this->db->join('refbrgy b','b.brgyCode = i.barangay');
        $this->db->where('account_id',$account_id);
        return $this->db->get()->row();
    }

    function saveVisit($table,$data){
        return $this->db->insert($table,$data);
    }

    function updateVisit($table,$data,$id){
        $this->db->where('id',$id);
        return $this->db->update($table,$data);
    }

    function checkVE($table,$account_id,$date_visited,$office_id){
        $this->db->from($table);
        $this->db->where('account_id',$account_id);
        $this->db->where('date_visited',$date_visited);
        $this->db->where('designation_office_id',$office_id);
        return $this->db->get()->row();
    }

}
