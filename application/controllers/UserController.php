<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('M_user/M_user');
        if(!$this->session->userdata('logged_in')){
             header('Location: '.base_url('login'));
             exit;
         } 
	}

    public function index(){

    	// $nip = $this->session->userdata('nip');
    	// $data['jenis'] = $this->M_cuti->get_jenis();
    	// $data['employe'] = $this->M_cuti->get_employe($nip);
        $data['user'] = $this->M_user->get_user();
        // print_r($data['user']); exit();
    	$data['title'] = 'List User';
        $data['content'] = 'page/user/index';
        $this->load->view('page/dashboard/index', $data);
    }

    public function adduser(){

        $data['employe'] = $this->M_user->get_employe();
        $data['active'] = $this->M_user->get_active();
        $data['level'] = $this->M_user->get_level();
        // print_r($data['active']); exit();
        $data['title'] = 'Add User';
        $data['content'] = 'page/user/adduser';
        $this->load->view('page/dashboard/index', $data);
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
            $this->M_user->save_data($data, $nip);
        }
    }

    public function get_employe(){

        $nip = $this->input->post('nip');

        echo $this->M_user->get_employee($nip);

        //echo json_encode($data);
    }

    public function Edituser($id_users){

        
        //print_r($data['active']); exit();
        $data['active'] = $this->M_user->get_active();
        $data['user'] = $this->M_user->get_users($id_users);
        $data['level'] = $this->M_user->get_level();
        $data['title'] = 'Edit User';
        $data['content'] = 'page/user/edituser';
        $this->load->view('page/dashboard/index', $data);
    }

    public function edit_data(){

        $id = $this->input->post('id_users');
        $cek_pass = $this->db->get_where('tb_users', array('id_users'=>$id))->result();
        $username = $this->input->post('username');
        $pass = $this->input->post('pass');
        $status = $this->input->post('status');
        $level = $this->input->post('level');

        if($pass == $cek_pass[0]->pass){
            $data = array(
                        'username' => $username,
                        'pass' => $pass,
                        'status' => $status,
                        'level' => $level,
                    );

            $this->M_user->edit_data($data, $id);
        }else{
            $edit_pass = password_hash($pass, PASSWORD_BCRYPT);

            $data = array(
                        'username' => $username,
                        'pass' => $edit_pass,
                        'status' => $status,
                        'level' => $level,
                    );

            $this->M_user->edit_data($data, $id);
        }
    }

    public function deleteuser(){

        $id = $this->input->post('id');
        
        $this->M_user->delete_data($id);
    }
}