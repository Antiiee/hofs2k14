<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * I love you Danel Rönnqvist,
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();

		$this->load->model('user_model');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('camera');
		$this->load->view('spotify');
		$this->load->view('text');		
		$this->load->view('templates/footer');
	}

	public function spotify()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/footer');
	}

	public function feed()
	{
		$data['event'] = $this->user_model->get_content('1');

		$this->load->view('templates/header');
		$this->load->view('feed', $data);
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */