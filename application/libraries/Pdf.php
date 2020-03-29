<?php if ( !('BASEPATH')) exit('No direct <span id="g4x6410v0710_6" class="g4x6410v0710">script access</span> allowed');

require_once APPPATH.'third_party/tcpdf/tcpdf'.EXT;

class Pdf extends TCPDF
{
	protected $ctr = '';

 //    public function __construct()
	// {
 //        parent::__construct();
 //    }
	
	public function __construct($orientation='P', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false)
	{
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
    }

	public function setCtr($ctr)
	{
		$this->ctr = $ctr;
	}
	
	public function Header($ctr = '')
	{
		if($this->ctr=='PO')
		{
			
			$this->SetFont('helvetica', 'B', 10);
			$this->Cell(0, 15, $this->ctr, 0, false, 'R', 0, '', 0, false, 'M', 'M');
		}
		else
		{
			// --------------------------------------------- ASLI ------------------------------------------------------------------
			
			$this->SetFont('helvetica', 'U', 12);
			$this->Cell(0, 30, 'PERMOHONAN CUTI KARYAWAN', 0, false, 'C', 0, '', 0, false, 'M', 'M');
			$this->Cell(0, 15, $this->ctr, 0, false, 'J', 0, '', 0, false, 'M', 'M');
		}
	}

	public function Footer()
	{
		$CI =& get_instance();
		$_alias_username = $CI->session->userdata('_alias_username');
		$_logged_by = $CI->session->userdata('_logged_by');

		$this->SetY(-15);
		$this->SetFont('helvetica', 'I', 8);

		$this->Cell(0, 10, 'Printed by : '.$_logged_by.'('.$_alias_username.'), Date : '.date('D-M-Y H:i:s'), 0, false, 'L', 0, '', 0, false, 'T', 'M');		
		$this->Cell(0, 10, 'Page : '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
	
}