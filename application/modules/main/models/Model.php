<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Model extends CI_Model {

    function getAllData($table,$where){
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->get()->result();
    }

    function getAllMovies($table,$where,$like = null,$order_by = null){
        $this->db->from($table);
        $this->db->where($where);
        if($order_by != null){
            $key = array_key_first($order_by);
          $this->db->order_by($key,$order_by[$key]);  
        }
        if($like != null){
          $this->db->like($like);  
        }
        
        return $this->db->get()->result();
    }

    function get_suggestions($term){
        $this->db->select('title, id');
        $this->db->from('movies');
        $this->db->like('title',$term);
        return $this->db->get()->result();
    }

    function getRow($table,$where){
        $this->db->from($table);
        $this->db->where($where);
        return $this->db->get()->row();
    }

    function getSimilarMovies($like){
        $this->db->from("movies");
        foreach ($like as $value) {
            $this->db->or_like('genre',$value);
        }
        return $this->db->get()->result();
    }

    function getAllMovieYears(){
        $this->db->distinct();
        $this->db->select('year_released');
        $this->db->from('movies');
        $this->db->order_by('year_released', 'DESC');
        return $this->db->get()->result();
    }

    function checkCredential($table,$email_username,$password){
        $this->db->from($table);
        $this->db->group_start()
            ->where('email', $email_username)
            ->or_where('username', $email_username)
        ->group_end();
        $this->db->where('password',$password);
        return $this->db->get()->row();
    }

    function insertData($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }


}
