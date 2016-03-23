<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Controller {

	public function create()
	{


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
		else
		{
			$this->session->set_flashdata('login_errors', "Incorrect username or password!");
			redirect('/users');
		}
	
	}

	
	

	// public function welcome()
	// {
		
	// 	$this->load->view("welcome");
	// }
	public function destroy()
	{
		$this->session->sess_destroy();
		redirect('/users');
	}

}