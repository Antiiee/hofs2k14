<?php
class event_model extends CI_Model {

	var $eid   = '';
    var $time = '';
    var $title  = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_event($id = FALSE)
	{
		$query = $this->db->get_where('event', array('eid' => $id));
		return $query->result();
	}

	public function set_event()
	{
		$data = array(
			'time' => $this->input->post('thetime'),
			'title' => $this->input->post('mytitle')
		);

		return $this->db->insert('event', $data);
	}
}