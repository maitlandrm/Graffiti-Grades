<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo extends CI_Model {

	public function add_photo($photo_values)
	{

	
		$query = "INSERT INTO photos(caption, full_path, created_at, updated_at, user_id)VALUES(?,?,NOW(),NOW(),?);";
		$this->db->query($query, $photo_values);

	}

	public function get_most_recent($path)
	{

		$query = "SELECT photos.id FROM photos WHERE full_path = ?;";
		return $this->db->query($query, $path)->row_array();
	}

	public function create_comment($rating)
	{
		$query = "INSERT INTO comments(rating, created_at, updated_at, photo_id, user_id) VALUES(?,NOW(),NOW(),?,?);";
		$this->db->query($query, $rating);
	}

	public function show_all_photos()
	{
		$query = "SELECT photos.id as photo_id, caption, full_path, alias FROM photos JOIN users ON users.id = photos.user_id ORDER BY photos.created_at DESC;";
		return $this->db->query($query)->result_array();
	}

	public function show_photo($photo_id)
	{
		$query = "SELECT photos.id AS photo_id, caption, full_path, alias, photos.user_id AS user_id, AVG(rating) AS grade FROM photos LEFT JOIN comments ON photos.id = comments.photo_id LEFT JOIN users ON users.id = photos.user_id WHERE photos.id = ?;";
		return $this->db->query($query, $photo_id)->row_array();

	}

	public function add_comment($comments)
	{
		$query = "INSERT INTO comments(comments, rating, created_at, updated_at, photo_id, user_id) VALUES(?,?,NOW(),NOW(),?,?);";
		$this->db->query($query, $comments);
	}

	public function show_comments($photo_id)
	{

		$query = "SELECT comments.id, rating, alias, user_id, comments FROM comments JOIN users ON users.id = comments.user_id WHERE photo_id = ?;";
		return $this->db->query($query, $photo_id)->result_array();
	}

	public function delete_comment($id)
	{

		$query = "DELETE FROM comments WHERE id = ?;";
		$this->db->query($query, $id);
	}

	public function delete_all_comments($id)
	{
		$query = "DELETE FROM comments WHERE photo_id = ?;";
		$this->db->query($query, $id);
	}
	public function delete_photo($id)
	{
		$query = "DELETE FROM photos WHERE photos.id = ?;";
		$this->db->query($query, $id);
	}


}