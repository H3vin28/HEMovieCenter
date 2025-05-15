<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model extends CI_Model {
    function getRow($table,$where){
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->get()->row();
    }

    function getAllData($table,$where){
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->get()->result();
    }

    function getAllMovies($table,$where,$like = null,$order_by = null,$limit=null,$offset=null){
        $this->db->from($table);
        $this->db->where($where);
        if($order_by != null){
            $key = array_key_first($order_by);
          $this->db->order_by($key,$order_by[$key]);  
        }
        if($like != null){
          $this->db->like($like);  
        }
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    function insertData($table,$data){
        return $this->db->insert($table,$data);
    }

    function deleteData($table,$where){
        return $this->db->delete($table,$where);
    }

    function updateData($table,$data,$where){
        $this->db->where($where);
        return $this->db->update($table,$data);
    }
}
