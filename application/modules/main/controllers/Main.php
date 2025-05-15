<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model(array('model'));
        
        // var_dump(base64_encode(md5('Sample@123')));exit;
    } 
    
	public function index()
	{	
		$row = $this->checkAccountNotNull();
		if($row == null){
			$genre = []; 
		} else {
			$genre = explode(', ',$row->genre);
		}

		$movies = $this->model->getSimilarMovies($genre);
		shuffle($movies);

		$data['movies'] = $movies;
		$this->heading($row);
		$this->load->view('content',$data);
		$this->load->view('footer');
	}
    
	public function movies()
	{	
		$row = $this->checkAccountNotNull();
		// var_dump($row);exit;
		$genre = @$this->input->get('genre');
		$year = @$this->input->get('year');
		$rating = @$this->input->get('rating');
		$order_by_data = @$this->input->get('order_by');

		if($order_by_data == 'Latest'){
			$order_by = ['year_released'=>'DESC'];
		} else if($order_by_data == 'Oldest'){
			$order_by = ['year_released'=>'ASC'];
		} else if($order_by_data == 'Rating') {
			$order_by = ['year_released'=>'rating'];
		} else {
			$order_by = null;
		}
		
		$like = null;
		$where = ['status'=>1];
		if($genre != null){
			$like['genre'] = $genre;
		}
		if($year != null){
			$where['year_released'] = $year;
		}
		// var_dump($where);exit;
		$where1 = [];
		$data['movies'] = $this->model->getAllMovies('movies',$where,$like,$order_by);
		$data['genres'] = $this->model->getAllData('genres',$where1);
		$data['years'] = $this->model->getAllMovieYears('genres',$where1);
		// var_dump($data['years']);exit;
		$this->heading($row);
		$this->load->view('movies', $data);
		$this->load->view('footer');
	}
    
	public function signup()
	{	
		$where=[];
		$data['genres'] = $this->model->getAllData('genres',$where);
		$this->heading();
		$this->load->view('signup',$data);
		$this->load->view('footer');
	}
    
	public function selected_movie($id)
	{	
		$row = $this->checkAccountNotNull();
		$where=['id'=>$id];
		$data['movie'] = $this->model->getRow('movies',$where);

		$genre = explode(', ',$data['movie']->genre);

		$movies = $this->model->getSimilarMovies($genre);

		foreach ($movies as $key => $movie) {
		    if ($movie->id == $data['movie']->id) {
		        unset($movies[$key]);
		        break;
		    }
		}
		shuffle($movies);

		$data['similar_movie'] = $movies;
		$this->heading($row);
		$this->load->view('selected_movie',$data);
		$this->load->view('footer');
	}

	public function search_title(){
		$title = $this->input->post('search_movie');
		$where=['title'=>$title];
		$row = $this->model->getRow('movies',$where);
		redirect(base_url('main/selected_movie/'.$row->id));
	}
    
	public function login_process(){	
		$email_add = $this->input->post('email');
		$password = base64_encode(md5($this->input->post('password')));
		$row = $this->model->checkCredential('accounts',$email_add,$password);
		// var_dump($row);exit;
		if($row != null){
			$this->session->set_flashdata('message',"Welcome ".$row->fullname."!");
			$this->session->set_flashdata('icon',"success");
			$this->session->set_userdata('id',$row->id);
			if($row->usertype == "admin"){
				redirect(base_url('admin/'));	
			} else {
				redirect(base_url());
			}
		} else {
			$this->session->set_flashdata('message',"Credentials are incorrect!");
			$this->session->set_flashdata('icon',"error");
			redirect(base_url());
		}
	}
    
	public function signup_process()
	{	
		$data = $this->input->post();
		$password = base64_encode(md5($this->input->post('password_signup')));
		$genre = implode(", ",$this->input->post('genre'));
		unset($data['confirm_password']);
		unset($data['password_signup']);
		unset($data['genre']);
		$data['password'] = $password;
		$data['genre'] = $genre;
		$id = $this->model->insertData('accounts',$data);
		if($id != null){
			$this->session->set_flashdata('message',"You have successfully registered! Enjoy watching.");
			$this->session->set_flashdata('icon',"success");
			$this->session->set_userdata('id',$id);
		} else {
			$this->session->set_flashdata('message',"There's an error in saving your registration.");
			$this->session->set_flashdata('icon',"error");
		}
		redirect(base_url());
	}

	public function getAllTitle(){
		$term = $this->input->get('term');
	    $results = $this->model->get_suggestions($term);
	    $data = array();
	    foreach ($results as $value) {
	    	$data[]=$value->title;
	    }
	    echo json_encode($data);
	}

	function heading($row=null){
		$data['row'] = $row;
		$this->load->view('header',$data);
		$this->load->view('sidebar',$data);
	}

	public function logout()
	{	
		$this->session->unset_userdata('id');
		redirect(base_url());
	}

	function checkAccountNotNull(){
		$id = $this->session->userdata('id');
		$where = ['id'=>$id];
		$row = $this->model->getRow('accounts',$where);
		// var_dump($id);exit;
		if(@$row->usertype == "admin"){
			$this->session->set_flashdata('message',"You can't access this page because your account is an ADMIN Account!");
			$this->session->set_flashdata('icon',"error");
			redirect(base_url('admin/'));
		} else {
			return $row;		
		}
	}
}
