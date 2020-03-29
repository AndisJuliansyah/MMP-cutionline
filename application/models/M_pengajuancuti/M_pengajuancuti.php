<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_pengajuancuti extends CI_Model {

	public function get_transaksi($nip) {

        $query = $this->db->query("select a.id_header, a.no_cuti, a.nip, a.status, a.total_cuti, c.name_cuti, b.keterangan, b.datestart, b.dateend, d.name_employe, e.name_status, e.label from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_jeniscuti c on b.jenis_cuti = c.id_jenis left join tb_employe d on a.nip = d.nip left join tb_status e on a.status = e.level_status where a.nip='$nip'  group by no_cuti DESC")->result();

        return($query);
    }

    public function get_status($nip) {

        $query = $this->db->query("select status from tb_headercuti where nip ='$nip'")->result();

        $tampung = "";
        foreach ($query as $key ) {
             $tampung .= "".$key->status."";
        }
        //$tampung = rtrim($tampung, ",");
        return '{"lem" : "'.$tampung.'"}';
    }

    public function delete($id, $kode){

    	$proses = $this->db->delete('tb_headercuti', array('id_header' => $id));

    	if($proses){
    		$this->db->delete('tb_cuti', array('no_cuti' => $kode));
    		echo "ok";
    	}else{
    		echo "no";
    	}
    }
    
}
