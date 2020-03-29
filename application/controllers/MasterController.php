<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MasterController extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('M_master/M_master');
        if(!$this->session->userdata('logged_in')){
             header('Location: '.base_url('login'));
             exit;
         }
	}

    public function index(){

        $data['division'] = $this->M_master->get_division();
        $data['division2'] = $this->M_master->get_division();
        // print_r($data['division']); exit();
        $data['avlaiblecuti'] = $this->M_master->get_avlaiblecuti();
        $data['branch'] = $this->M_master->get_branch();
        $data['holiday'] = $this->M_master->get_holiday();
        $data['subjenis'] = $this->M_master->get_subjenis();
        // get where data division
        // $data['datadivisi'] = $this->M_master->get_datadivisi();
    	$data['title'] = 'List Master';
        $data['content'] = 'page/master/index';
        $this->load->view('page/dashboard/index', $data);
    }

    public function add_divisi(){

        $name = $this->input->post('name');

        $data = array('name_division' => $name);

        $this->M_master->add_divisi($data);
    }

    public function edit_divisi(){
        
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        
        $data = array('name_division' => $name);

        $this->M_master->edit_divisi($data, $id);
    }

    public function delete_divisi(){

        $id = $this->input->post('id');
        
        $this->M_master->delete_divisi($id);
    }

    public function edit_jmlcuti(){

        $id   = $this->input->post('id');
        $total = $this->input->post('total');
        $sisa = $this->input->post('sisa');

        $data = array('total_cuti' => $total, 'sisa_cuti' => $sisa);

        $this->M_master->edit_jmlcuti($data, $id);
    }

     public function add_branch(){

        $name = $this->input->post('name');

        $data = array('name_branch' => $name);

        $this->M_master->add_branch($data);
    }

    public function edit_branch(){
        
        $id = $this->input->post('id');
        $name = $this->input->post('name');

        $data = array('name_branch' => $name);

        $this->M_master->edit_branch($data, $id);
    }

    public function delete_branch(){

        $id = $this->input->post('id');
        
        $this->M_master->delete_branch($id);
    }

    public function edit_subjenis(){
        
        $id = $this->input->post('id');
        $name = $this->input->post('date');

        $data = array('total_cuti' => $name);

        $this->M_master->edit_subjenis($data, $id);
    }

     public function add_date(){

        $name = $this->input->post('name');
        $date = $this->input->post('date');

        $data = array('name' => $name, 'date' => $date);

        $this->M_master->add_date($data);
    }

    public function edit_date(){

        $id   = $this->input->post('id');
        $name = $this->input->post('day');
        $date = $this->input->post('date');

        $data = array('name' => $name, 'date' => $date);

        $this->M_master->edit_date($data, $id);
    }

    public function delete_date(){

        $id = $this->input->post('id');
        
        $this->M_master->delete_date($id);
    }
    
    public function bc_data(){
        
        $this->M_master->backup();
    }
}