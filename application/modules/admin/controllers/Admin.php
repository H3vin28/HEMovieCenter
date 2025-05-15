<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model(array('model'));
		$this->load->library('upload');
    } 
    
	public function index()
	{	
		$row = $this->checkAccountNotNull();
		$this->heading($row);
		$this->load->view('content');
		$this->load->view('footer');
	}
    
	public function users()
	{	
		$row = $this->checkAccountNotNull();
		$this->heading($row);
		$where = [];
		$data['users'] = $this->model->getAllMovies('accounts',$where);
		$this->load->view('users',$data);
		$this->load->view('footer');
	}
    
	public function movies()
	{	
		$row = $this->checkAccountNotNull();
		$where = [];
		$like = [];
		$order_by = ['date_created'=>'DESC'];
		

		$per_page = $this->input->get('per_page') == null ? 10 : $this->input->get('per_page');
		$this->pagination_config('movies',$where,$like,$order_by,$per_page);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        // $data['users'] = $this->model->get_users_paginated($per_page, $page);
        $data['movies'] = $this->model->getAllMovies('movies',$where,$like,$order_by,$per_page, $page);
        $data['pagination_links'] = $this->pagination->create_links();

		$data['genres'] = $this->model->getAllData('genres',$where);
		$this->heading($row);
		$this->load->view('movies',$data);
		$this->load->view('footer');
	}

	public function add_movie(){
		$row = $this->checkAccountNotNull();

		$data = $this->input->post();

        $config['upload_path'] = "./assets/movies_image";
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $this->upload->initialize($config);
        // var_dump($data);exit;
        if ($this->upload->do_upload('file_name')) {
        	$data['file_name'] = $this->upload->data()['file_name'];
        	unset($data['genre']);
        	$data['genre'] = implode(", ",$this->input->post('genre'));

        	if($this->model->insertData('movies',$data)){
        		$this->session->set_flashdata('message',"New movie successfully added!");
				$this->session->set_flashdata('icon',"success");
        	} else {
        		$this->session->set_flashdata('message',"There's an error in saving the data. Data not saved!");
				$this->session->set_flashdata('icon',"error");
        	}
		} else {
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('message',$error.". Data not saved!");
			$this->session->set_flashdata('icon',"error");
		}
		redirect(base_url('admin/movies/'));
	}

	public function update_movie(){
		$row = $this->checkAccountNotNull();
        $config['upload_path'] = "./assets/movies_image";
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $this->upload->initialize($config);
        // var_dump($data);exit;
        if (!empty($_FILES['up_file_name']['name'])) {
		    if ($this->upload->do_upload('up_file_name')) {
	        	$data['file_name'] = $this->upload->data()['file_name'];
			} else {
				$error = $this->upload->display_errors();
				$this->session->set_flashdata('message',$error.". Data not saved!");
				$this->session->set_flashdata('icon',"error");
				redirect(base_url('admin/movies/'));
			}
		}

		$data['genre'] = implode(", ",$this->input->post('up_genre'));
    	$data['title'] = $this->input->post('up_title');
    	$data['description'] = $this->input->post('up_description');
    	$data['year_released'] = $this->input->post('up_year_released');

		$where = ['id'=>$this->input->post('movie_id')];
    	if($this->model->updateData('movies',$data,$where)){
    		$this->session->set_flashdata('message',"Movie successfully updated!");
			$this->session->set_flashdata('icon',"success");
    	} else {
    		$this->session->set_flashdata('message',"There's an error in updating the data. Data not saved!");
			$this->session->set_flashdata('icon',"error");
    	}
        
		redirect(base_url('admin/movies/'));
	}

	public function delete_movie(){
		$row = $this->checkAccountNotNull();
		$id = $this->input->post('movie_id');
		$where = ['id'=>$id];
		if($this->model->deleteData('movies',$where)){
    		$this->session->set_flashdata('message',"Movie successfully deleted!");
			$this->session->set_flashdata('icon',"success");
    	} else {
    		$this->session->set_flashdata('message',"There's an error in deleting the movie!");
			$this->session->set_flashdata('icon',"error");
    	}
    	redirect(base_url('admin/movies/'));
	}

	public function delete_account(){
		$row = $this->checkAccountNotNull();
		$id = $this->input->post('account_id');
		$where = ['id'=>$id];
		if($this->model->deleteData('accounts',$where)){
    		$this->session->set_flashdata('message',"Account successfully removed!");
			$this->session->set_flashdata('icon',"success");
    	} else {
    		$this->session->set_flashdata('message',"There's an error in removing an account!");
			$this->session->set_flashdata('icon',"error");
    	}
    	redirect(base_url('admin/users/'));
	}

	public function reset_account(){
		$row = $this->checkAccountNotNull();
		$id = $this->input->post('reset_account_id');
		$where = ['id'=>$id];
		$data = ['password'=>base64_encode(md5('Ch@ngeMe'))];
		if($this->model->updateData('accounts',$data,$where)){
    		$this->session->set_flashdata('message',"Account reset successfully!");
			$this->session->set_flashdata('icon',"success");
    	} else {
    		$this->session->set_flashdata('message',"There's an error in resetting an account!");
			$this->session->set_flashdata('icon',"error");
    	}
    	redirect(base_url('admin/users/'));
	}

	function heading($row=null){
		$data['row'] = $row;
		$this->load->view('head');
		$this->load->view('navbar',$data);
		$this->load->view('sidebar',$data);
	}

	function checkAccountNotNull(){
		$id = $this->session->userdata('id');
		$where = ['id'=>$id];
		$row = $this->model->getRow('accounts',$where);
		if(@$row->usertype != "admin"){
			$this->session->set_flashdata('message',"You can't access this page because your account is NOT an ADMIN Account!");
			$this->session->set_flashdata('icon',"error");
			redirect(base_url());
		} else {
			return $row;		
		}
	}

	function pagination_config($table,$where,$like,$order_by,$per_page){
		$config['base_url'] = base_url('admin/movies/');
		$config['total_rows'] = count($this->model->getAllMovies($table,$where,$like,$order_by));
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;

		// Bootstrap 4 / AdminLTE 3 compatible styles
		$config['full_tag_open'] = '<ul class="pagination pagination-sm m-0 float-right">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = ['class' => 'page-link']; // Add class to all pagination links

		$this->pagination->initialize($config);
	}
}
