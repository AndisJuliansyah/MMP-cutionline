<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CutiController extends CI_Controller {

	public function __construct () {
		parent::__construct();
		$this->load->model('m_cuti/M_cuti');
        if(!$this->session->userdata('logged_in')){
             header('Location: '.base_url('login'));
             exit;
         }
	}

    public function index(){

    	$nip = $this->session->userdata('nip');
    	$data['jenis'] = $this->M_cuti->get_jenis();
    	$data['employe'] = $this->M_cuti->get_employe($nip);
        $data['sisa'] = $this->M_cuti->get_cutipertahun($nip);
        $data['code'] = $this->M_cuti->code_otomatis();
    	$data['title'] = 'Form Cuti';
		$data['content'] = 'page/formcuti/addcuti';
        $this->load->view('page/dashboard/index', $data);
    }

    public function sumcuti(){

        $cek = $this->db->query("select date from tb_date");
        $tamp = $cek->result_array();

    	$data1 = $this->input->post('date');
    	$data2 = $this->input->post('date2');

		$awal_cuti = strtotime($data1);
		$akhir_cuti = strtotime($data2);
		
		
		$haricuti = array();
		$sabtuminggu = array();
		for ($i=$awal_cuti; $i <= $akhir_cuti; $i += (60 * 60 * 24)) {
			if (date('w', $i) !== '0' && date('w', $i) !== '6') {
					$haricuti[] = $i;
				} else {
					$sabtuminggu[] = $i;
				}
		}

        $baru = array();
        $baru2 = array();
        for($i = $data1; $i <= $data2; $i++){
            for($a=0; $a < count($tamp); $a++){
                if($i == $tamp[$a]['date']){
                    $baru[] = $tamp[$a]['date'];
                }
            }
            $baru2[] = $i;
        }
        $jumlahlibur = count($baru);
		$jumlah_cuti = count($haricuti);
		
        if($jumlahlibur == 0){
            echo $jumlah_cuti;
        }else{
            echo $jumlah_cuti-$jumlahlibur;
        }
				
    }

    // public function tes(){

    //     $cek = $this->db->query("select date from tb_date");
    //     $tamp = $cek->result_array();

    //     $from='2018-12-23';
    //     $to ='2018-12-26';

    //     $baru = array();
    //     $baru2 = array();
    //     for($i = $from; $i <= $to; $i++){
    //         for($a=0; $a < count($tamp); $a++){
    //             if($i == $tamp[$a]['date']){
    //                 $tes = $tamp[$a]['date'].'<br>';
    //                  echo '<p style="color:red;">'.$tes.'</p>';
    //             }
    //         }
    //         $day = $i;
    //     }
    //     echo $day;    
    // }

    public function get_date(){
    	echo $this->M_cuti->get_tanggal();

    }

    public function get_subjenis(){
        
        $jns = $this->input->post('jenis_cuti');
        if ($jns != '') {

            $query = $this->db->get_where('tb_subjenis', array('id_jenis' => $jns))->result();

            $data = '';
            foreach ($query as $rows) {
                $data .= '<option value="' . $rows->id_subjenis . '">' . $rows->name_subjenis . '</option>';
            }
        }else{
                $data .= '<option value="#">-- Select --</option>';
        }
        
        if ($data) {
            echo $data;
        }else{
            echo "no";
        }
        return($data);
    }

    public function add(){
        
    	$nip = $this->input->post('nip');
        $code = $this->input->post('code');
    	$name = $this->input->post('name');
    	$position = $this->input->post('position');
    	$division = $this->input->post('division');
    	$join = $this->input->post('join');
    	$total_day= $this->input->post('jml');
        $total_stay= $this->input->post('sisa');
    	$signature = $this->input->post('signature');
    	$jeniscuti = $this->input->post('jenis_cuti');
        $subjenis = $this->input->post('subjenis');
    	$keterangan = $this->input->post('keterangan');
    	$date1 = $this->input->post('start');
    	$date2 = $this->input->post('finish');
    	$total = $this->input->post('jumlah');
        $thn = date('Y');
        $month = date('m');

        $cek_transaksi = $this->M_cuti->get_transaksi($nip, $thn);
        $employe = $this->M_cuti->get_employe($nip);
        $cek_sisa = $this->M_cuti->get_sisa($nip);
        $cek_sisa2 = $this->M_cuti->get_pertahun($nip);
        
        if($subjenis != ''){
                if($month == '02'){
                    $this->db->set('sisa', '0');
                    $this->db->update('tb_backup');
                }
                $data = array();
                $index = 0;
                foreach($date1 as $datanis){ 
                  array_push($data, array(
                    'no_cuti'=>$code,
                    'datestart'=>$datanis,
                    'dateend'=>$date2[$index],
                    'nip'=>$nip,
                    'total_cuti'=>$total[$index],
                    'jenis_cuti'=>$jeniscuti,
                    'subjenis'=>$subjenis,
                    'datecreate'=> date('Y-m-d'),
                    'keterangan'=>$keterangan,
                  ));
                    $index++;
                }

                $data1 = array('no_cuti'=>$code,
                                'nip'=>$nip,
                                'status'=>5,
                                'total_stay'=>$total_stay,
                                'total_cuti'=>$total_day
                               );

            $this->M_cuti->add_cuti($data, $data1);
        }

        // if($cek_transaksi > 0){

            if($cek_sisa < $total[0]){
            
                echo "Sisa Cuti Anda Tidak Cukup";
            
            }else{
                if($month == '02'){
                    $this->db->set('sisa', '0');
                    $this->db->update('tb_backup');
                }
                    $data = array();
                    $index = 0;
                    foreach($date1 as $datanis){ 
                      array_push($data, array(
                        'no_cuti'=>$code,
                        'datestart'=>$datanis,
                        'dateend'=>$date2[$index],
                        'nip'=>$nip,
                        'total_cuti'=>$total[$index],
                        'jenis_cuti'=>$jeniscuti,
                        'subjenis'=>$subjenis,
                        'datecreate'=> date('Y-m-d'),
                        'keterangan'=>$keterangan,
                      ));
                        $index++;
                    }

                    $data1 = array('no_cuti'=>$code,
                                    'nip'=>$nip,
                                    'status'=>5,
                                    'total_stay'=>$total_stay,
                                    'total_cuti'=>$total_day
                                   );

                   $this->M_cuti->add_cuti($data, $data1); 
            }

        // }else{
        //     $tahun = date('Y') - 1;
        //     $all = $this->M_cuti->sum_cuti($nip, $tahun);
        //     $jumlah = 12 - $all;
        //     $potong = 5;
        //     $cuti_tahun = $employe[0]->total_cuti;
        //     $total = $cuti_tahun - $potong + $cek_sisa2;
            
        //     $this->db->set('sisa_cuti', $total);
        //     $this->db->where('nip', $nip);
        //     $this->db->update('tb_avlaiblecuti');

        //     $data1 = array('no_cuti'=>$code,
        //                     'nip'=>$nip,
        //                     'status'=>5,
        //                     'total_stay'=>$total_stay,
        //                     'total_cuti'=>$total_day
        //                     );

        //     $this->M_cuti->add_cuti($data, $data1);
        // }
    }

    public function edit($code){

        $nip = $this->session->userdata('nip');
        $data['employe'] = $this->M_cuti->get_employe($nip);
        $data['cek_data'] = $this->db->get_where('tb_headercuti', array('no_cuti' => $code))->result();
        $data['jenis_kete'] = $this->M_cuti->get_jeniskete($code);
        $data['subjenis'] = $this->M_cuti->get_subjenis();
        // echo '<pre>' ;
        // print_r($jenis_kete[0]); echo '</pre>';die();
        $data['jenis'] = $this->M_cuti->get_jenis();
        $data['title'] = 'Edit Pengajuan';
        $data['content'] = 'page/formcuti/editcuti';
        $this->load->view('page/dashboard/index', $data);

    }

    public function send_data(){

        $no = $this->input->post('id');

        $data = array('status' => 0, 'notif' => 0);

        $this->M_cuti->sendcuti($no, $data);
    }

    public function datacuti(){

        $code  = $this->input->post('data');

        $data = $this->M_cuti->get_datatrans($code);

        echo json_encode($data);
    }

    public function update(){

        // post data lama
        $id_cuti = $this->input->post('id_cuti');
        $date1 = $this->input->post('start');
        $date2 = $this->input->post('finish');
        $total = $this->input->post('jumlah');
        $jeniscuti = $this->input->post('jenis_cuti');
        $subjenis = $this->input->post('subjenis');
        $keterangan = $this->input->post('keterangan');
        $total_day= $this->input->post('jml');
        
        //post data baru
        $idcuti = $this->input->post('id_cut');
        $no_cuti = $this->input->post('nocuti');
        $nip = $this->input->post('nip');
        $dates = $this->input->post('startad');
        $dates2 = $this->input->post('finishad');
        $total2 = $this->input->post('jumlahad');

        //print_r($subjenis); exit();
        //cek sisa
        $cek_sisa = $this->M_cuti->get_sisa($nip);
        //Proses Cuti Khusus
        if($subjenis != '0'){
            $cek_khusus = $this->M_cuti->get_cutikhusus($subjenis);
                if($total_day[0]>$cek_khusus){
                    echo "melebihi ketentuan";
                }else{
                    if($dates != ''){
                        if($id_cuti!=''){
                              
                                $data = array();
                                $index = 0;
                                    foreach($dates as $datanis){ 
                                      array_push($data, array(
                                        'id_cuti'=>$idcuti[$index],
                                        'no_cuti'=>$no_cuti,
                                        'nip'=>$nip,
                                        'datestart'=>$datanis,
                                        'dateend'=>$dates2[$index],
                                        'total_cuti'=>$total2[$index],
                                        'jenis_cuti'=>$jeniscuti,
                                        'subjenis'=>$subjenis,
                                        'keterangan'=>$keterangan,
                                        'datecreate'=> date('Y-m-d'),
                                      ));
                                        $index++;
                                    }
                        }else{
                                $data = array();
                                $index = 0;
                                    foreach($dates as $datanis){ 
                                      array_push($data, array(
                                        'id_cuti'=>$idcuti[$index],
                                        'no_cuti'=>$no_cuti,
                                        'nip'=>$nip,
                                        'datestart'=>$datanis,
                                        'dateend'=>$dates2[$index],
                                        'total_cuti'=>$total2[$index],
                                        'jenis_cuti'=>$jeniscuti,
                                        'subjenis'=>$subjenis,
                                        'keterangan'=>$keterangan,
                                        'datecreate'=> date('Y-m-d'),
                                      ));
                                        $index++;
                                    }
                        }
                }else{
                        $data = array();
                        $index = 0;
                            foreach($date1 as $datanis){ 
                              array_push($data, array(
                                'id_cuti' => $id_cuti[$index],
                                'no_cuti'=>$no_cuti,
                                'nip'=>$nip,
                                'datestart'=>$datanis,
                                'dateend'=>$date2[$index],
                                'total_cuti'=>$total[$index],
                                'jenis_cuti'=>$jeniscuti,
                                'subjenis'=>$subjenis,
                                'keterangan'=>$keterangan,
                                'datecreate'=> date('Y-m-d'),
                              ));
                                $index++;
                            }
                    }
                    $data1 = array('total_cuti'=>$total_day);
                }
            $this->M_cuti->update_data($data, $idcuti, $id_cuti, $data1);
        }else{

        //Proses Cuti Tahunan
            if($cek_sisa<$total_day[0]){
                echo "Sisa Cuti Anda Tidak Cukup";
            }else{
            if($dates != ''){
                    if($id_cuti!=''){
                          
                            $data = array();
                            $index = 0;
                                foreach($dates as $datanis){ 
                                  array_push($data, array(
                                    'id_cuti'=>$idcuti[$index],
                                    'no_cuti'=>$no_cuti,
                                    'nip'=>$nip,
                                    'datestart'=>$datanis,
                                    'dateend'=>$dates2[$index],
                                    'total_cuti'=>$total2[$index],
                                    'jenis_cuti'=>$jeniscuti,
                                    'subjenis'=>$subjenis,
                                    'keterangan'=>$keterangan,
                                    'datecreate'=> date('Y-m-d'),
                                  ));
                                    $index++;
                                }
                    }else{
                            $data = array();
                            $index = 0;
                                foreach($dates as $datanis){ 
                                  array_push($data, array(
                                    'id_cuti'=>$idcuti[$index],
                                    'no_cuti'=>$no_cuti,
                                    'nip'=>$nip,
                                    'datestart'=>$datanis,
                                    'dateend'=>$dates2[$index],
                                    'total_cuti'=>$total2[$index],
                                    'jenis_cuti'=>$jeniscuti,
                                    'subjenis'=>$subjenis,
                                    'keterangan'=>$keterangan,
                                    'datecreate'=> date('Y-m-d'),
                                  ));
                                    $index++;
                                }
                    }
            }else{
                    $data = array();
                    $index = 0;
                        foreach($date1 as $datanis){ 
                          array_push($data, array(
                            'id_cuti' => $id_cuti[$index],
                            'no_cuti'=>$no_cuti,
                            'nip'=>$nip,
                            'datestart'=>$datanis,
                            'dateend'=>$date2[$index],
                            'total_cuti'=>$total[$index],
                            'jenis_cuti'=>$jeniscuti,
                            'subjenis'=>$subjenis,
                            'keterangan'=>$keterangan,
                            'datecreate'=> date('Y-m-d'),
                          ));
                            $index++;
                        }
                }
            }
                $data1 = array('total_cuti'=>$total_day);
        
            $this->M_cuti->update_data($data, $idcuti, $id_cuti, $data1, $no_cuti);
        }
    }

    public function delete_detail(){
        
        $id = $this->input->post('id');
        $total_cuti = $this->input->post('total');
        $no = $this->input->post('no');
        $send = $this->M_cuti->delete_detail($id, $total_cuti, $no);

        echo $send;
    }

    public function review($no_cuti){
        //print_r($no_cuti); die();
        $this->load->library('pdf');

        $pdf = new PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, false, 'ISO-8859-1', false);
        $pdf->SetProtection(array('modify', 'annot-forms', 'fill-forms', 'extract', 'assemble'), '', null, 0, null);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetMargins(10, 10, 10, true);
        $pdf->AddPage();

        
        $template = $this->template_pdf($no_cuti);
        $pdf->writeHTML(utf8_decode($template), true, false, false, false, '');
        $pdf->Output('.pdf', 'I');

        exit();
    }

    public function template_pdf($no_cuti){

        $data = $this->M_cuti->get_data($no_cuti);
        $status = $this->M_cuti->get_status($no_cuti);
        $subjenis = $this->M_cuti->get_sub($no_cuti);
        // $coba = $status;

       // echo $subjenis; exit();
        $date = date_create($data[0]->date_join);
        $date1 = date_create($data[0]->datestart);
        $date2 = date_create($data[0]->dateend);
        $date3 = date_create($data[0]->datecreate);
        $date4 = date_create($data[0]->dateapprove1);
        $date5 = date_create($data[0]->dateapprove2);

        $rombak6 = date_format($date, 'M Y');
        $rombak = date_format($date1, 'd / m / Y');
        $rombak2 = date_format($date2, 'd / m / Y');
        $rombak3 = date_format($date3, 'd / m / Y');
        $rombak4 = date_format($date4, 'd / m / Y');
        $rombak5 = date_format($date5, 'd / m / Y');
        
        $year = date('Y');
        $nip = $data[0]->nip;
        $hak_cuti = $this->M_cuti->avalaiblecuti($nip);
        $hak_cuti2 = $this->db->get_where('tb_backup', array('nip' => $nip))->result();
        $hak_cutipertahun = $this->db->query("SELECT sum(total_cuti) as jml FROM tb_cuti WHERE nip = '".$nip."' and year(datecreate) ='$year'")->result();
        $jumlah = $hak_cuti[0]->sisa_cuti;
        if(empty($hak_cuti2)){
            $jml_backup = 0 + $jumlah;
        }else{
            $jml_backup = $hak_cuti2[0]->sisa + $jumlah;
        }

        
        
        // $nip = $this->session->userdata('nip');
        // $data = $this->M_cuti->get_employe($nip);
        
        $template = '
        <style>
        table {
            border-collapse: collapse;
            margin-bottom: 10px
        }

        .tab2{
            border: 0.1px solid black;
            padding: 7;
        }

        .tab1{
            border-left: 0.1px solid black;
            border-right: 0.1px solid black;
        }

        .tab3{
            border-left: 0.1px solid black;
            border-right: 0.1px solid black;
            border-bottom: 0.1px solid black;
        }

        table {
            padding-bottom: 6px;
        }

        img{
            width: 150px;
            height: 40px;
        }
        

        </style>
                
                    <lable><b>PT. MEGAH MEDIKA PHARMA</b></lable><br>
                    
                    <table>
                    
                        <tr>
                            <td class="tab2">Nama : '.$data[0]->name_employe.'</td>
                            <td class="tab2">Bagian : '.$data[0]->name_division.'</td>
                            <td class="tab2">NIP : '.$data[0]->nip.'</td>
                        </tr>
                        <tr>
                            <td class="tab2">Jabatan : '.$data[0]->name_level.'</td>
                            <td class="tab2">Hak Cuti Tahunan : '.$hak_cuti[0]->total_cuti.'</td>
                            <td class="tab2">Tgl Masuk Kerja : '.$rombak6.'</td>
                        </tr>
                    </table>
                    <table style="padding:4px;">
                        <tr>
                            <td class="tab2">Dari Tanggal : '.$rombak.' </td>
                            <td class="tab2" rowspan="2">
                                <table>
                                    <thead>
                                        <tr>
                                           '.$status.'
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td align="center">Direvisi</td>
                                            <td align="center">Diambil</td>
                                            <td align="center">Dibatalkan</td>
                                        </tr>
                                        </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="tab2">Sampai Dengan : '.$rombak2.'</td>
                        </tr>
                        <tr>
                            <td class="tab2">CUTI KHUSUS</td>
                            <td class="tab2">CUTI TAHUNAN</td>
                        </tr>
                        <tr>
                            <td class="tab1">
                                <table>
                                <thead>
                                        '.$subjenis.'
                                </thead>
                            </table>
                            </td>
                            <td class="tab1">
                                <table border="0,1">
                                <thead>
                                    <tr>
                                        <td style="width:105px">Hak Cuti</td>
                                        <td>:</td>
                                        <td>'.$data[0]->total_stay.'</td>
                                        <td>hari</td>
                                    </tr>
                                    <tr>
                                        <td style="width:105px">Cuti Yg Telah Diambil</td>
                                        <td>:</td>
                                        <td>'.$hak_cutipertahun[0]->jml.'</td>
                                        <td>hari</td>
                                    </tr>
                                    <tr>
                                        <td style="width:105px;">Cuti Yg Akan Diambil</td>
                                        <td>:</td>
                                        <td>'.$data[0]->total_cuti.'</td>
                                        <td>hari</td>
                                    </tr>
                                    <tr>
                                        <td style="width:105px">Sisa Hak Cuti Terakhir</td>
                                        <td>:</td>
                                        <td>'.$jml_backup.'</td>
                                        <td>hari</td>
                                    </tr>
                                </thead>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="tab2">Alasan : <br>'.$data[0]->keterangan.'</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <td colspan="3" class="tab2">1. Form ini diisi pemohon, yang asli deserahkan kepada Bagian Personalia dari umum, rangkapnya disimpan oleh pemohon.<br>2. Pengisian form paling lambat 7 hari(untuk Kantor Pusat) dan 14 hari (untuk kantor Cabang) sebelum cuti diambil dan telah disetujui oleh Kacab/Kabag/Kadiv/Direksi dan diketahui oleh Personalia</td>
                        </tr>
                        <tr>
                            <td class="tab2" style="text-align:center">Tanda Tangan</td>
                            <td class="tab2" style="text-align:center">Menyetujui</td>
                            <td class="tab2" style="text-align:center">Mengetahui</td>
                        </tr>
                        <tr>
                            <td class="tab1" style="text-align:center">Pemohon</td>
                            <td class="tab1" style="text-align:center">Atasan</td>
                            <td class="tab1" style="text-align:center">Personalia</td>
                        </tr>
                        <tr>
                            <td class="tab1" style="position:center"><img src="assets/img/employe/'.$data[0]->signature.'"/></td>
                            <td class="tab1" style="position:center"><img src="assets/img/employe/'.$data[0]->approve1.'"/></td>
                            <td class="tab1" style="position:center"><img src="assets/img/employe/'.$data[0]->approve2.'"/></td>
                        </tr>
                        <tr>
                            <td class="tab1" style="text-align:center">( '.$data[0]->name_employe.' )</td>
                            <td class="tab1" style="text-align:center">( '.$data[0]->name_approve1.' )</td>
                            <td class="tab1" style="text-align:center">( '.$data[0]->name_approve2.' )</td>
                        </tr>
                        <tr>
                            <td class="tab3" style="text-align:center">Tanggal :'.$rombak3.'</td>
                            <td class="tab3" style="text-align:center">Tanggal :'.$rombak4.'</td>
                            <td class="tab3" style="text-align:center">Tanggal :'.$rombak5.'</td>
                        </tr>
                    </table>';  
       
        return ($template);
    }
}