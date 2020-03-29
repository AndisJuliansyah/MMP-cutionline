<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ManageController extends CI_Controller {

	public function __construct () {
		parent::__construct();

		$this->load->model('M_manage/M_manage');
		if(!$this->session->userdata('logged_in')){
			 header('Location: '.base_url('login'));
			 exit;
		 }   
	}

	public function index(){

    	// $data['divisi'] = $this->M_report->get_divisi();
    	// $data['cabang'] = $this->M_report->get_branch();
    	$data['level'] = $this->M_manage->get_level();
    	
		$data['title'] = 'Management User';
		$data['content'] = 'page/manage/index';
		$this->load->view('page/dashboard/index', $data);
	}

	public function editmanage($id_level){

		$data['menu'] = $this->M_manage->get_menu();
    	$data['access'] = $this->M_manage->get_access($id_level);
		$data['title'] = 'Edit Management User';
		$data['content'] = 'page/manage/editmanage';
		$this->load->view('page/dashboard/index', $data);
	}

	public function saveaccess(){

		$id_menus = $this->input->post('id_menus');
		$ceklis = $this->input->post('ceklis');
		$id_user = $this->input->post('id_user');

		$hitung = $this->db->where('id_users', $id_user)->get('tb_access')->num_rows();
		
		if($ceklis != ''){
			if($hitung > 0){
				$this->db->where('id_users', $id_user);
				$delete = $this->db->delete('tb_access');

				for($i = 0; $i<count($ceklis); $i++){
					$data = array('id_users'=>$id_user, 'id_menus'=>$ceklis[$i],'status'=>'0');
					$this->db->insert('tb_access', $data);
				}
				echo "ok";
			}else{
				for($i = 0; $i<count($ceklis); $i++){
					$data = array('id_users'=>$id_user, 'id_menus'=>$ceklis[$i],'status'=>'0');
					$this->db->insert('tb_access', $data);
				}
				echo "ok";
			}
		}else{
			echo "no";
		}

		return;
	}
}