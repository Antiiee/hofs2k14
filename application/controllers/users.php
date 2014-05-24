<?php
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}


	public function create($id)
	{
		echo "console.log($id);";
		$result = $this->user_model->get_user($id);
		if(!$result)
		{
		$result = $this->user_model->set_user();

		if($result === FALSE)
        {
            $this->response(array('status' => 'failed'));
        }
         
        else
        {
            $this->response(array('status' => 'success'));
        }
    	}
	}
}