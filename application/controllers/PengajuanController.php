<?php defined('BASEPATH') OR exit('No direct script access allowed');

class PengajuanController extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('m_pengajuancuti/M_pengajuancuti'); 
	}

    public function index(){

    	$nip = $this->session->userdata('nip');
        $data['transaksi'] = $this->M_pengajuancuti->get_transaksi($nip);
        $data['status'] = $this->M_pengajuancuti->get_status($nip);
    	$data['title'] = 'Pengajuan Cuti';
		$data['content'] = 'page/formcuti/index';
        $this->load->view('page/dashboard/index', $data);
    }

    public function delete(){

        $id = $this->input->post('id');
        $kode = $this->input->post('kode');

        $send = $this->M_pengajuancuti->delete($id, $kode);

        echo $send;
    }

    public function status_cuti(){

       $nip = $this->session->userdata('nip');

       echo $this->M_pengajuancuti->get_status($nip);
    }

}