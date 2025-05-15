<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Eo_model extends CI_Model {

    function CheckAccount($table,$where){
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->get()->row();
    }

    function getAllConsumers($where){
        $this->db->select('ci.*, b.barangay_name');
        $this->db->from('consumers_info ci');
        $this->db->join('barangays b','ci.barangay_id = b.id');
        $this->db->where($where);
        return $this->db->get()->result();
    }

    function getAllBarangays(){
        $this->db->from('barangays');
        return $this->db->get()->result();
    }

    function getMaxMonthPerYear(){
        $this->db->select('MAX()');
        $this->db->from('meter_reading');
        return $this->db->get()->result();
    }

    function getSelectedBarangay($id){
        $this->db->from('barangays');
        $this->db->where('id',$id);
        return $this->db->get()->row();
    }

    function getMeterReadingPerMonth($id,$month){
        $this->db->from('meter_reading mr');
        $this->db->join('consumers_info ci','ci.id = mr.consumers_id');
        $this->db->join('barangays b','b.id = ci.barangay_id');
        $this->db->where('consumers_id',$id);
        $this->db->where('reading_month',$month);
        return $this->db->get()->row();
    }

    function getLastMeterReading($cons_id){
        $this->db->from('meter_reading');
        $this->db->where('consumers_id',$cons_id);
        $this->db->order_by('id','DESC');
        return $this->db->get()->row();
    }

    function insert($data,$table){
        return $this->db->insert($table,$data);
    }

}
