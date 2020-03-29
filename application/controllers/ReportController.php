<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ReportController extends CI_Controller {

	public function __construct () {
		parent::__construct();

		$this->load->model('M_report/M_report');
		if(!$this->session->userdata('logged_in')){
			 header('Location: '.base_url('login'));
			 exit;
		 }   
	}

	public function index(){

    	$data['divisi'] = $this->M_report->get_divisi();
    	$data['cabang'] = $this->M_report->get_branch();
    	$data['jenis'] = $this->M_report->get_jeniscuti();
    	
		$data['title'] = 'Report Data';
		$data['content'] = 'page/report/index';
		$this->load->view('page/dashboard/index', $data);
	}

	public function get_transaksi(){

		$nip = $this->input->post('nip');
		$name = $this->input->post('name');
		$divisi = $this->input->post('divisi');
		$cabang = $this->input->post('cabang');
		$status = $this->input->post('status');
		$jenis = $this->input->post('jenis');
		$datestart = $this->input->post('datestart');
		$dateend = $this->input->post('dateend');

		$data = array('nip' => $nip, 'name' => $name, 'divisi' => $divisi, 'cabang' => $cabang, 'status' => $status, 'jenis' => $jenis, 'datestart' => $datestart, 'dateend' => $dateend);

		$_SESSION = $data;
		// $send = $this->process($data);
		$data2['transaksi'] = $this->M_report->get_transaksi($data);
		// print_r($data2['transaksi']); exit();
		$data2['divisi'] = $this->M_report->get_divisi();
    	$data2['cabang'] = $this->M_report->get_branch();
    	$data2['jenis'] = $this->M_report->get_jeniscuti();
		$data2['title'] = 'Report Data';
		$data2['content'] = 'page/report/index';
		$this->load->view('page/dashboard/index', $data2);
	}

	public function export(){
		$nip = $this->input->post('nip');
		$name = $this->input->post('name');
		$divisi = $this->input->post('divisi');
		$cabang = $this->input->post('cabang');
		$status = $this->input->post('status');
		$jenis = $this->input->post('jenis');
		$datestart = $this->input->post('datestart');
		$dateend = $this->input->post('dateend');

		$data = array('nip' => $nip, 'name' => $name, 'divisi' => $divisi, 'cabang' => $cabang, 'status' => $status, 'jenis' => $jenis, 'datestart' => $datestart, 'dateend' => $dateend);
   		$this->load->library('excel');
        $excel = new PHPExcel();
    // Settingan awal fil excel
	    $excel->getProperties()->setCreator('My Notes Code')
	                 ->setLastModifiedBy('My Notes Code')
	                 ->setTitle("Data Cuti Karyawan")
	                 ->setSubject("Karyawan")
	                 ->setDescription("Laporan Semua Data Karyawan")
	                 ->setKeywords("Data Karyawan");
	    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
	    $style_col = array(
	      'font' => array('bold' => true), // Set font nya jadi bold
	      'alignment' => array(
	        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	      ),
	      'borders' => array(
	        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	      )
	    );
	    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
	    $style_row = array(
	      'alignment' => array(
	        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	      ),
	      'borders' => array(
	        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
	        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
	        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
	        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	      )
	    );
	    $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA LAPORAN CUTI KARYAWAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
	    $excel->getActiveSheet()->mergeCells('A1:J1'); // Set Merge Cell pada kolom A1 sampai E1
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
	    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
	    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
	    // Buat header tabel nya pada baris ke 3
	    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
	    $excel->setActiveSheetIndex(0)->setCellValue('B3', "KODE CUTI"); // Set kolom B3 dengan tulisan "NIS"
	    $excel->setActiveSheetIndex(0)->setCellValue('C3', "TANGGAL"); // Set kolom C3 dengan tulisan "NAMA"
	    $excel->setActiveSheetIndex(0)->setCellValue('D3', "NIP"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
	    $excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA KARYAWAN"); // Set kolom E3 dengan tulisan "ALAMAT"
	    $excel->setActiveSheetIndex(0)->setCellValue('F3', "DIVISI");
	    $excel->setActiveSheetIndex(0)->setCellValue('G3', "CABANG");
	    $excel->setActiveSheetIndex(0)->setCellValue('H3', "JENIS CUTI");
	    $excel->setActiveSheetIndex(0)->setCellValue('I3', "KETERANGAN");
	    $excel->setActiveSheetIndex(0)->setCellValue('J3', "STATUS");
	    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
	    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
	    $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
	    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
	    $transaksi = $this->M_report->get_transaksi($data);
	    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
	    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
	    foreach($transaksi as $data){ // Lakukan looping pada variabel siswa
	      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
	      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->no_cuti);
	      for($i = $data->datestart; $i <= $data->dateend; $i++)
	      {
            	$baru = $i;
                $date5 = date_create($baru);
          		// $date6 = date_format($date5, 'd / m / Y');
          		$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $baru);
          }
	      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nip);
	      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->name_employe);
		  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->name_division);
		  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->name_branch);
		  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->name_cuti);
		  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->keterangan);
		  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->name_status);
	      
	      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
	      $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
	      
	      $no++; // Tambah 1 setiap kali looping
	      $numrow++; // Tambah 1 setiap kali looping
	    }
	    // Set width kolom
	    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
	    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
	    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
	    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
	    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Set width kolom E
	    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
	    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
	    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
	    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
	    $excel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
	    
	    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
	    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
	    // Set orientasi kertas jadi LANDSCAPE
	    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	    // Set judul file excel nya
	    $excel->getActiveSheet(0)->setTitle("Laporan Cuti Karyawan");
	    $excel->setActiveSheetIndex(0);
	    // Proses file excel
	    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	    header('Content-Disposition: attachment; filename="Data Cuti.xlsx"'); // Set nama file excel nya
	    header('Cache-Control: max-age=0');
	    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	    $write->save('php://output');

  	}

  	public function get_detail($no_cuti){

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

        $this->load->model('M_cuti/M_cuti');

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
        
        $nip = $data[0]->nip;
        $hak_cuti = $this->M_cuti->avalaiblecuti($nip);

        $jumlah = $hak_cuti[0]->sisa_cuti;
        
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
                                        <td>'.$hak_cuti[0]->all_cuti.'</td>
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
                                        <td>'.$jumlah.'</td>
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