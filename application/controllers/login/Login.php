<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('login/M_login');
	}

    public function index(){
        $data['content'] = 'login/login';
        $this->load->view('login/index', $data);
    }

    public function log_in() {
        
        $pros = $this->M_login->login();
    }
    
    public function logout(){
        
        echo $this->M_login->log_out();
    }
}