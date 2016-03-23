<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$this->load->view('home');
	}

	public function create()
	{
		
		//create an array to send in the post data
		$users = array(
			'first_name'=>$this->input->post('first_name'),
			'last_name'=>$this->input->post('last_name'),
			'email'=>$this->input->post('email'),
			'password'=>password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			'alias'=>$this->input->post('alias')
			);
		//load the model
		$this->load->model("User");
		//check user input
		$this->load->library('form_validation');

		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
		$this->form_validation->set_rules('alias', 'Alias', 'required');
		if($this->form_validation==TRUE)
		{
			//send the post data to the model for query
			$this->User->create($users);




			///BEGIN AUTOMATIC LOGIN
			//load the model
			$this->load->model("User");

			//load the function with the post data
			$user = $this->User->get_user_by_email($this->input->post('email'));

			if($user && password_verify($this->input->post('password'), $user['password']))
			{
				$user_info = array(
					'id'=>$user['id'],
					'first_name'=>$user['first_name'],
					'last_name' =>$user['last_name'],
					'email'=>$user['email'],
					'password'=>$user['password'],
					'alias'=>$user['alias'],
					'is_logged_in'=>TRUE
					);
				$this->session->set_userdata($user_info);
				redirect('/photos');					
			}
			
		}


		////END AUTOMATIC LOGIN
		else
		{
			$this->session->set_flashdata("errors",validation_errors());
		//go back to login/registration view
		redirect('/');
		}

	}




}
