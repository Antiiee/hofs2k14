<?php
class user_model extends CI_Model {

	var $uid   = '';
    var $fbid = '';
    var $joindate  = '';
    var $name = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_user($id = FALSE)
	{
		$query = $this->db->get_where('user', array('uid' => $id));
		return $query->result();
	}

	public function set_user()
	{
		$data = array(
			'uid' => $this->input->post('userid'),
			'fbid' => $this->input->post('faceid'),
			'name' => $this->input->post('username')
		);

		return $this->db->insert('user', $data);
	}
}