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
		$query = $this->db->get_where('user', array('fbid' => $id));
		return $query->result();
	}


	public function get_content($id = FALSE)
	{
		if($id != FALSE) {
			$this->db->select('comment, pic, music, time, title');
			$this->db->from('content');
			$this->db->join('event', 'content.eid = event.eid');
			$this->db->where('uid', $id);
			$this->db->where('hidden', 0);

			$query = $this->db->get();
			if($query)
			{
				return $query->result_array();
			}
		return $query->result();
				  }
		  else {
		    return FALSE;
		  }
	}

	public function set_user()
	{
		echo "console.log('hel' + $this->input->post('faceid'))";
		$data = array(
			'fbid' => $this->input->post('faceid'),
			'name' => $this->input->post('username')
		);

		return $this->db->insert('user', $data);
	}
}