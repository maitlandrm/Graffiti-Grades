<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Photo');
	}
	public function index()
	{
		$this->load->view('welcome', array('error'=>''));
	}
	

	public function do_upload()
	{
		
		//VERIFY POST DATA
		$this->load->library('form_validation');

		$this->form_validation->set_rules('caption', 'Caption', 'required');
		$this->form_validation->set_rules('grade', 'Grade', 'required');
		$this->form_validation->set_rules('userfile', 'Photo', 'required|is_unique[photos.path]');

		if($this->form_validation==TRUE)
		{
			$config = array(
			'upload_path'=>"./images/",
			'allowed_types'=>"gif|jpg|png|jpeg",
			'max_size'=>"5048000",
			'max_height'=>"2000",
			'max_width'=>"2000",
			'encrypt_name'=>TRUE
			);
			$this->load->library('upload', $config);

			if(!$this->upload->do_upload())
			{

		
				$this->session->set_flashdata('error', $this->upload->display_errors());
				$this->load->view('welcome');
			}
			else
			{
				
				//SET POST DATA TO AN ARRAY
				$data = $this->upload->data();

				$data = array(
					'caption'=>$this->input->post('caption'),
					'path'=>$data['file_name'],
					'rating'=>$this->input->post('grade')
					);
				$this->session->set_flashdata($data);
				redirect('/photos/create');
				// $this->resize($data);
			}
		}
		
		else
		{
			$this->session->set_flashdata("error",validation_errors());
			$this->load->view('welcome');
		}

	}

	// public function resize($data)
	// {
	// 	$config['image_library'] = 'gd2';
	// 	$config['source_image']	= './images/' . $data['path'];
	// 	$config['maintain_ratio'] = TRUE;
	// 	$config['width']	= 1200;
	// 	$config['height']	= 1000;

	// 	$this->load->library('image_lib', $config); 

	// 	$this->image_lib->resize();
		
	// 	if ( ! $this->image_lib->resize())
	// 	{
	// 	    echo $this->image_lib->display_errors();
	// 	}

	// 	//set the flashdata
	// 	$this->session->set_flashdata($data);
	// 	redirect('/photos/create');
	// }

	

}