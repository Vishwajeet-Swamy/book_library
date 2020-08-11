<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class testunit extends CI_Controller {

	public function __construct() {
		
		parent::__construct();
        $this->load->model('book_details_model');
        $this->load->library("unit_test");
		
	}

	public function save_book_details(){
		$book_details = array(
			'title'=>'My Book',
			'author'=>'Sam',
			'category'=>'Fiction',
			'image_url'=>'https://cdn.cp.adobe.io/content/2/rendition/2fbc681c-bb10-4ddd-9d27-ae0764a88610/artwork/a2588530-9502-40b5-9303-3661b6621d7c/version/0/format/jpg/dimension/width/size/300',
			'count'=>'100',
			'price'=>'500',
			'description'=>'Descrpition about the book'
		);
		$result = $this->book_details_model->saverecords($book_details);
		echo json_encode($result);
	}
}
