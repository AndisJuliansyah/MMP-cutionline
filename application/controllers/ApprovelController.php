<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ApprovelController extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('M_approvel/M_approvel');
    if(!$this->session->userdata('logged_in')){
       header('Location: '.base_url('login'));
       exit;
     }
	}

    public function index(){

        $nip   = $this->session->userdata('nip');
        $level = $this->session->userdata('level');
        $data['transaksi'] = $this->M_approvel->get_transaksi($nip, $level);
    	  $data['title'] = 'Approvel Cuti';
		    $data['content'] = 'page/approvel/index';
        $this->load->view('page/dashboard/index', $data);
    }

    public function approvetransaksi(){

        $level = $this->session->userdata('level');
        $nip   = $this->session->userdata('nip');
        $id = $this->input->post('id');
        $total = $this->input->post('total');
        $nip_employe = $this->input->post('nip');

        $approve = $this->M_approvel->get_approve($nip);
        // print_r($nip_employe); exit();
        // // $data_employ = $this->M_approvel->get_employe($nip);
        

        if($level == '3'){
            $data = array( 'name_approve2' => $approve[0]->name_employe,
                           'approve2' => $approve[0]->signature,
                           'status' => '3',
                           'notif' => '3', 
                           'dateapprove2' => date('Y-m-d'),
                           'revisi' => ''
                );
            $this->M_approvel->managerapprove($id, $data, $total, $nip_employe);
        }else{
            $data = array( 'name_approve1' => $approve[0]->name_employe,
                           'approve1' => $approve[0]->signature,
                           'status' => '1',
                           'notif' => '1', 
                           'dateapprove1' => date('Y-m-d'),
                           'revisi' => '');
        }
        
        $this->M_approvel->addapprove($id, $data);  
    }

    public function revisi(){

        $no = $this->input->post('no');
        $revisi = $this->input->post('revisi');

        $data = array( 'revisi' => $revisi,
                       'status' =>'2', 'notif' =>'2');

        $this->M_approvel->revisiapprove($no, $data);  
    }

    public function failed(){

        $no = $this->input->post('no');
        $revisi = $this->input->post('revisi');

        $data = array( 'revisi' => $revisi,
                       'status' =>'4', 'notif' =>'4');

        $this->M_approvel->failedapprove($no, $data);  
    }
}