<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ListController extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('M_listcuti/M_listcuti');
        if(!$this->session->userdata('logged_in')){
             header('Location: '.base_url('login'));
             exit;
         }
	}

    public function index(){

    	$lvl = $this->session->userdata('level');
    	$nip = $this->session->userdata('nip');
    	
    	$data['transaksi'] = $this->M_listcuti->get_transaksi($lvl, $nip);
    	$data['title'] = 'List Cuti';
		$data['content'] = 'page/listCuti/index';
        $this->load->view('page/dashboard/index', $data);
    }
}