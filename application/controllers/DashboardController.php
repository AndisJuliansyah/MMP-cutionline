<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

	public function __construct () {
		parent::__construct();
		 // $this->load->library('session');
		 $this->load->model('M_dashboard/M_dashboard');  

		 if(empty($this->session->userdata('logged_in'))){
			 header('Location: '.base_url('login'));
			 exit;
		 } 
	}

    public function index(){

    	
          	$lvl = $this->session->userdata('level');
	    	$nip = $this->session->userdata('nip');

	    	$data['kalkulasi'] = $this->M_dashboard->get_kalkulasi($lvl, $nip);
	    	$data['transaksi'] = $this->M_dashboard->get_transaksi($lvl, $nip);
	    	$data['employe'] = $this->M_dashboard->get_employe($lvl, $nip);
	    	
	    	$data['title'] = 'Dashboard';
	    	$data['content'] = 'page/front/index';
	        $this->load->view('page/dashboard/index', $data);
    	
    }

    public function check_data()
	{
		$lvl = $this->input->post('lvl');
		$nip = $this->input->post('nip');
		$no_cuti = $this->input->post('no');
		
		$data = array('notif' => 8);

		$div = $this->db->get_where('tb_employe', array('nip' => $nip))->result();
        $division = $tamp = $div[0]->division;
        $branch = $tamp = $div[0]->branch;
        
       
        	if($lvl == '1'){
        		if(isset($_POST['view'])){
        			if($_POST["view"] != '')
					{
			   			$update_query = $this->db->query("UPDATE tb_headercuti SET notif = 8 WHERE no_cuti = '".$_POST['view']."' and notif between 2 and 5")->result();
					}
	        		$query = $this->db->query("select a.no_cuti, b.name_employe, c.name_status from tb_headercuti a left join tb_employe b on a.nip = b.nip left join tb_status c on a.status = c.level_status where b.division = '$division' and branch = '$branch' and notif between 2 and 5 ORDER BY id_header DESC LIMIT 5");
					$jml = $query->num_rows();
					$output = '';
					if($jml > 0)
					{
						foreach ($query->result() as $key => $value) {
						  $output .= '<li>
			                            <a href="#" id="notif" data-no="'.$value->no_cuti.'">
			                                <div>
			                                    <i class="fa fa-bell fa-fw"></i>Pengajuan Cuti
			                                    <span class="pull-right text-muted small">'.$value->name_status.'</span>
			                                </div>
			                            </a>
		                        	  </li><br>
		                        	  <li class="divider"></li>';
							}
					}else{
					    $output .= '<li>
			                            <a href="#">
			                               <div>
			                                    <i class="fa fa-bell fa-fw"></i>Tidak ada data
			                               </div>
			                            </a>
		                        	  </li>';
					}
					$status_query = $this->db->query("select a.no_cuti from tb_headercuti a left join tb_employe b on a.nip = b.nip WHERE a.nip = '$nip' and notif between 2 and 5");
					$count = $status_query->num_rows();

				 	$output1 = '<span class="top-label label label-warning">'.$count.'</span>';
					$data = array(
					   'notification' => $output,
					   'unseen_notification'  => $count,
					   'unseen_notification1'  => $output1
					);
					echo json_encode($data);
				}
				
        	}else if($lvl == '2'){

        		if($_POST["view"] != '')
					{
			   			$update_query = $this->db->query("UPDATE tb_headercuti SET notif = 8 WHERE no_cuti = '".$_POST['view']."' and notif = 0")->result();
					}
        		if(isset($_POST['view'])){
	        		$query = $this->db->query("select a.no_cuti, b.name_employe, c.name_status from tb_headercuti a left join tb_employe b on a.nip = b.nip left join tb_status c on a.status = c.level_status where b.division = '$division' and branch = '$branch' and a.notif = 0 ORDER BY id_header DESC LIMIT 5");
					$jml = $query->num_rows();
					$output = '';
					if($jml > 0)
					{
						foreach ($query->result() as $key => $value) {
						  $output .= '<li>
			                            <a href="#" id="notif" data-no="'.$value->no_cuti.'">
			                                <div>
			                                    <i class="fa fa-comment fa-fw"></i>Pengajuan Cuti '.$value->name_employe.'
			                                    <span class="pull-right text-muted small">'.$value->name_status.'</span>
			                                </div>
			                            </a>
		                        	  </li><br>
		                        	  <li class="divider"></li>
		                        	  ';
							}
					}else{
					    $output .= '<li>
			                            <a href="#">
			                                <div>
			                                    <i class="fa fa-comment fa-fw"></i>No Notification
			                                </div>
			                            </a>
		                        	  </li>';
					}
					$status_query = $this->db->query("select a.no_cuti from tb_headercuti a left join tb_employe b on a.nip = b.nip where b.division = '$division' and a.notif = 0 and branch = '$branch'");
					$count = $status_query->num_rows();

				 	$output1 = '<span class="top-label label label-warning">'.$count.'</span>';
					$data = array(
					   'notification' => $output,
					   'unseen_notification'  => $count,
					   'unseen_notification1'  => $output1
					);
					echo json_encode($data);
				}
        	}else if($lvl == '3'){
        		if($_POST["view"] != '')
					{
						$this->db->where('no_cuti', $_POST["view"]);
						$this->db->update('tb_headercuti', $data);
					}
        		if(isset($_POST['view'])){
	        		$query = $this->db->query("select a.no_cuti, b.name_employe, c.name_status from tb_headercuti a left join tb_employe b on a.nip = b.nip left join tb_status c on a.status = c.level_status where a.notif = 1 and b.branch = '$branch' ORDER BY id_header DESC LIMIT 5");
					$jml = $query->num_rows();
					$output = '';
					if($jml > 0)
					{
						foreach ($query->result() as $key => $value) {
						  $output .= '<li>
			                            <a href="#" id="notif" data-no="'.$value->no_cuti.'">
			                                <div>
			                                    <i class="fa fa-comment fa-fw"></i>Pengajuan Cuti '.$value->name_employe.'
			                                    <span class="pull-right text-muted small">'.$value->name_status.'</span>
			                                </div>
			                            </a>
		                        	  </li><br>
		                        	  <li class="divider"></li>
		                        	  <li>
                        </li>';
							}
					}else{
					    $output .= '<li>
			                            <a href="#">
			                                <div>
			                                    <i class="fa fa-comment fa-fw"></i>Now Notifikasi
			                                </div>
			                            </a>
		                        	  </li>';
					}
					$status_query = $this->db->query("select a.no_cuti, b.name_employe, c.name_status from tb_headercuti a left join tb_employe b on a.nip = b.nip left join tb_status c on a.status = c.level_status WHERE b.branch = $branch and a.notif = 1");
					$count = $status_query->num_rows();

				 	$output1 = '<span class="top-label label label-warning">'.$count.'</span>';
					$data = array(
					   'notification' => $output,
					   'unseen_notification'  => $count,
					   'unseen_notification1'  => $output1
					);
					echo json_encode($data);
        	}
        }else{
        	if(isset($_POST['view'])){
        			if($_POST["view"] != '')
					{
			   			$update_query = $this->db->query("UPDATE tb_headercuti SET notif = 8 WHERE no_cuti = '".$_POST['view']."' and notif = 3 or 4")->result();
					}
	        		$query = $this->db->query("select a.no_cuti, b.name_employe, c.name_status from tb_headercuti a left join tb_employe b on a.nip = b.nip left join tb_status c on a.status = c.level_status where a.notif = 3 OR a.notif = 4 ORDER BY id_header DESC LIMIT 5");
					$jml = $query->num_rows();
					$output = '';
					if($jml > 0)
					{
						foreach ($query->result() as $key => $value) {
						  $output .= '<li>
			                            <a href="#" id="notif" data-no="'.$value->no_cuti.'">
			                                <div>
			                                    <i class="fa fa-comment fa-fw"></i>Pengajuan Cuti '.$value->name_employe.'
			                                    <span class="pull-right text-muted small">'.$value->name_status.'</span>
			                                </div>
			                            </a>
		                        	  </li><br>
		                        	  <li class="divider"></li>
		                        	  <li>
                        </li>';
							}
					}else{
					    $output .= '<li>
			                            <a href="#">
			                                <div>
			                                    <i class="fa fa-comment fa-fw"></i>Now Notifikasi
			                                </div>
			                            </a>
		                        	  </li>';
					}
					$status_query = $this->db->query("SELECT * FROM tb_headercuti WHERE notif = 3 OR notif = 4");
					$count = $status_query->num_rows();

				 	$output1 = '<span class="top-label label label-warning">'.$count.'</span>';
					$data = array(
					   'notification' => $output,
					   'unseen_notification'  => $count,
					   'unseen_notification1'  => $output1
					);
					echo json_encode($data);
        	}
    	}
	}
}