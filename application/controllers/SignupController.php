<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SignupController extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('M_signup/M_signup');
	}

     public function index(){
        
        $data['employe'] = $this->M_signup->get_employe();
        // print_r($data['employe']); exit();
        $data['active'] = $this->M_signup->get_active();
        $data['level'] = $this->M_signup->get_level();
        // $data['content'] = 'login/signup';
        $this->load->view('login/signup', $data);
    }

    public function get_employe(){

        $nip = $this->input->post('nip');

        echo $this->M_signup->get_employee($nip);
    }

    public function add_data(){

        $nip = $this->input->post('nip');
        $name = $this->input->post('name');
        $username = $this->input->post('username');
        $pass = $this->input->post('pass');
        $status = $this->input->post('status');
        $level = $this->input->post('level');

        $edit_pass = password_hash($pass, PASSWORD_BCRYPT);

        if($nip == '0'){
            echo "ni";
        }else{
            $data = array(
                        'nip' => $nip,
                        'n_name' => $name,
                        'username' => $username,
                        'pass' => $edit_pass,
                        'status' => $status,
                        'level' => $level,
                    );
            $this->M_signup->save_data($data, $nip);
        }
    }
}