<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
	//call CodeIgniter's default Constructor
	parent::__construct();
	
	//load Model
	$this->load->model('book_details_model');
	}

	//Default show the dashboard
	public function index()
	{	
		$data = $this->book_details_model->getcords();
		$this->load->view('dashboard_view',$data);	
	}

	//To add new book call this view
	public function add_book(){
		$this->load->view('add_book_view');
	}

	//To add book details to DB
	public function save_book_details(){
		$book_details = $_REQUEST;
		$result = $this->book_details_model->saverecords($book_details);
		echo json_encode($result);
	}

	//Edit or remove book
	public function update_delete($update_delete=""){
		if($update_delete!=""){
			$update_delete = explode('-',$update_delete);
		}else{
			$update_delete = explode('-',$_REQUEST['update_delete']);
		}
		
		$id = $update_delete[0];
		$action = $update_delete[1];
		if($action == 'remove'){
			$result = $this->book_details_model->deleterecords($id);
			echo json_encode($result);
		}else if($action == 'edit'){
			$data = $this->book_details_model->getcords($id);
			$this->load->view('edit_book_view',$data);
		}
	}

	//Save the edited book details
	public function update_book_details(){
		$update_data = $_REQUEST;
		$id = $update_data['id'];
		array_shift($update_data);
		
		$result = $this->book_details_model->update_book_details($id,$update_data);
		echo json_encode($result);
	}

	//Get all the books to list
	public function book_list($page=""){
		// echo"Search term is".$serach_term = $this->input->post('serach_term');die;
		// echo $serach_term;die;
		$this->load->library('pagination');
		$per_page = 3;
		$current_page = 0;
		
		if(isset($page) && trim($page)!=""){
			$current_page = $page;
		}
		$serach_term = $this->input->post('serach_term');
		if(isset($serach_term) && trim($serach_term)!=""){
			$search_book = $serach_term;
			$data = $this->book_details_model->listrecords($per_page,$current_page,$search_book);
			$total_row_count = $this->book_details_model->count($search_book);
		}else{
			$data = $this->book_details_model->listrecords($per_page,$current_page);
			$total_row_count = $this->book_details_model->count();
		}
		
		

		$config['base_url'] = site_url('dashboard/book_list');
		$config['total_rows'] = $total_row_count;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;

		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = "</ul>";
		
		$config['num_tag_open'] = "<li class='page-item'>";
		$config['num_tag_close'] = "</li>";

		$config['cur_tag_open'] = "<li class='page-item' disabled><a class='page-link' href='javascript:void(0)' tabindex='-1'>";
		$config['cur_tag_close'] = "</a></li>";

		$config['next_tag_open'] = "<li class='page-item'>";
		$config['next_tag_close'] = "</li>";

		$config['prev_tag_open'] = "<li class='page-item'>";
		$config['prev_tag_close'] = "</li>";

		$config['first_tag_open'] = "<li class='page-item'>";
		$config['first_tag_close'] = "</li>";

		$config['last_tag_open'] = "<li class='page-item'>";
		$config['last_tag_close'] = "</li>";

		$config['next_link'] = "Next";
		$config['prev_link'] = "Previous";

		$config['attributes'] = array("class"=>"page-link");

		$this->pagination->initialize($config);
		
		$pagination = $this->pagination->create_links();	
		$data['pagination']=$pagination;
		// echo"<pre>";print_r($data);die;
		$this->load->view('book_list_view',$data);
	}

}
