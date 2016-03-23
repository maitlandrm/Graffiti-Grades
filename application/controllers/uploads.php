<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Photo');
	}
	// public function index()
	// {
	// 	$this->load->view('welcome', array('error' => ' ' ));
		
	// }

	public function do_upload()
	{
		$config = array(
			'upload_path'=>".images/",
			'allowed_types'=>"gif|jpg|png|jpeg",
			'max_size'=>"2048000",
			'max_height'=>"768",
			'max_width'=>"1024"
			);
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$data = array('upload_data'=>$this->upload->data());
			var_dump($data);

		}
		else
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('welcome', $error);
		}
	}

	

}