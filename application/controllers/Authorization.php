<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorization extends CI_Controller {
	 public function __construct() 
    {
        parent::__construct();
        $this->load->Library('session');
    }

    public function authenticateToken(){
    	//Authenticate the token first.
		$token = isset($_SESSION['token']) ? $_SESSION['token'] : NULL;
		if(!$this->auth_model->authenticate($token)) {
			$this->session->set_flashdata("message","You are not logged in");
			redirect();
		}
    }

	public function verifyPasswordReset(){
		$get = $this->input->get();
		$data['temp'] = (isset($get['token']) ? $get['token'] :"" );

		$this->load->model("login_model");
		if($this->login_model->changePassword()){
			$data['temp'] = "whoa it worked";
		}
		else{
			$data['temp'] = "nope didn't work";
		}

		$this->load->template("test_view",$data);
	}
}
?>