<?php defined('BASEPATH') OR exit('No direct script access allowed');

class EmployeController extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('M_employe/M_employe');
        if(!$this->session->userdata('logged_in')){
             header('Location: '.base_url('login'));
             exit;
         } 
	}

    public function index(){

        $data['user'] = $this->M_employe->get_employe();
    	$data['title'] = 'List Employe';
        $data['content'] = 'page/employe/index';
        $this->load->view('page/dashboard/index', $data);
    }

    public function addemploye(){
        
        $data['division'] = $this->M_employe->get_division();
        $data['branch'] = $this->M_employe->get_branch();
        $data['position'] = $this->M_employe->get_position();

        $data['title'] = 'Add Employe';
        $data['content'] = 'page/employe/add_employe';
        $this->load->view('page/dashboard/index', $data);
    }

    public function add_data(){

        $nip = $this->input->post('nip');
        $name = $this->input->post('name');
        $position = $this->input->post('position');
        $division = $this->input->post('division');
        $branch = $this->input->post('branch');
        $join = $this->input->post('join');
        $total = $this->input->post('total');

        $this->load->library('upload');
        $dataInfo = array();
        $number_of_files = sizeof($_FILES['userfile']['tmp_name']);
        $files = $_FILES['userfile'];

        for ($i = 0; $i < $number_of_files; $i++) {
            $_FILES['userfile']['name'] = $files['name'][$i];
            $_FILES['userfile']['type'] = $files['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['error'][$i];
            $_FILES['userfile']['size'] = $files['size'][$i];

            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload('userfile');
            $dataInfo[] = $this->upload->data();
        }

        $data = array(
            'nip' => $nip,
            'name_employe' => $name,
            'position' => $position,
            'division' => $division,
            'branch' => $branch,
            'date_join' => $join,
            'image' => $files['name'][0],
            'signature' => $files['name'][1],
        );

        $data2 = array('nip' => $nip, 'total_cuti' => $total, 'sisa_cuti' => $total);

            $this->M_employe->save_data($data, $data2);
        }

        public function set_upload_options(){   
           
            $config = array();
            $config['upload_path'] = 'assets/img/employe/';
            $config['allowed_types'] = "jpg|png";
            $config['max_size'] = "1024000";
            $config['overwrite'] = TRUE;

            return $config;
        }

    public function editemploye($id){
        
        $data['employe'] = $this->M_employe->get_employ($id);
        $data['division'] = $this->M_employe->get_division();
        $data['branch'] = $this->M_employe->get_branch();
        $data['position'] = $this->M_employe->get_position();

        $data['title'] = 'Add Employe';
        $data['content'] = 'page/employe/edit_employe';
        $this->load->view('page/dashboard/index', $data);
    }

    public function update_data(){

        $id = $this->input->post('id');
        $nip = $this->input->post('nip');
        $name = $this->input->post('name');
        $position = $this->input->post('position');
        $division = $this->input->post('division');
        $branch = $this->input->post('branch');
        $join = $this->input->post('join');
        $files = $_FILES['userfile'];

        $this->load->library('upload');
        $dataInfo = array();
        $number_of_files = sizeof($_FILES['userfile']['tmp_name']);
        

        for ($i = 0; $i < $number_of_files; $i++) {
            $_FILES['userfile']['name'] = $files['name'][$i];
            $_FILES['userfile']['type'] = $files['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['error'][$i];
            $_FILES['userfile']['size'] = $files['size'][$i];

            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload('userfile');
            $dataInfo[] = $this->upload->data();
        }

            $data = array(
                'nip' => $nip,
                'name_employe' => $name,
                'position' => $position,
                'division' => $division,
                'branch' => $branch,
                'date_join' => $join,
                'image' => $files['name'][0],
                'signature'=>$files['name'][1]
                );

            $this->M_employe->update_data($data, $id);
    }

    public function deleteemploye(){

        $id = $this->input->post('id');

        $this->M_employe->delete_data($id);
    }
    
}