<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Photo');
		$this->load->helper('form');
	}

	public function index()
	{

		$photos = $this->Photo->show_all_photos();
		$this->load->view('welcome', array('photos'=>$photos));
	}

	public function create()
	{
		//create an array to send in the post data
		$photo_values = array(
			'caption'=>$this->session->flashdata('caption'),
			'path'=>$this->session->flashdata('path'),
			'user_id'=>$this->session->userdata('id')
			);

		//save the rating to a variable before losing the flashdata
		$rating = array(
			'rating'=>$this->session->flashdata('rating')
			);

		$this->Photo->add_photo($photo_values);


		//save the path to a new variable to get the id of the photo
		$path = $photo_values['path'];
	

		$photo_id = $this->Photo->get_most_recent($path);
		
		

		//put the photo id and rating into a new variable to send to the create comment method
		$rating = array(
			'rating' => $rating['rating'],
			'photo_id' => $photo_id['id'],
			'user_id'=>$this->session->userdata('id')
			);
		
		
		$this->create_comment($rating);
	}

	public function create_comment($rating)
	{
		$this->Photo->create_comment($rating);
		redirect('/photos');
	}

	public function show($photo_id)
	{
		$photo_details = $this->Photo->show_photo($photo_id);

		$comments = $this->Photo->show_comments($photo_id);

		$this->load->view('photo',array('photo_details'=>$photo_details, 'comments'=>$comments));

	}

	public function add_comment()
	{
		//create an array with the post data to send to the model
		$comments = array(
			'comment'=>$this->input->post('comment'),
			'grade'=>$this->input->post('grade'),
			'photo_id'=>$this->input->post('id'),
			'user_id'=>$this->session->userdata('id')
			);
		$this->Photo->add_comment($comments);
		$photo_id = $comments['photo_id'];

		redirect('/photos/show/' . $photo_id);
	}

	public function delete_comment()
	{
		$photo_id = $this->input->post('photo_id');
		$id = $this->input->post('id');
		$this->Photo->delete_comment($id);
		redirect('/photos/show/' . $photo_id);
	}

	public function delete_all_comments()
	{
		$id = $this->input->post('id');
		$this->Photo->delete_all_comments($id);
		$this->delete_photo($id);
	}

	public function delete_photo($id)
	{
		if($this->input->post())
		{
			$id = $this->input->post('id');	
		}

		$this->Photo->delete_photo($id);

		redirect('/photos');
	}




	
		

	

}