<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model {

	public function create($users)
	{

		//define query
		$query = "INSERT INTO users(first_name, last_name, email, password, alias, created_at, updated_at) VALUES (?,?,?,?,?,NOW(),NOW())";

		//send the query with variables and return to controller
		return $this->db->query($query,$users);


	}

	public function get_user_by_email($email)
	{
		//create an array to send in the post data(because it's not safe to just send it as post, says Martin)
		$value = array($email);
		//verify if the user is who they say they are
		//define query
		$query = "SELECT id, first_name, last_name, email, password, alias FROM users WHERE email = ?";
		//send the info into the db
		return $this->db->query($query,$value)->row_array();
	

	}


}