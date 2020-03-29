<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_listcuti extends CI_Model {

    public function get_transaksi($lvl, $nip){
        
        $div = $this->db->get_where('tb_employe', array('nip' => $nip))->result();
        $division = $tamp = $div[0]->division;
        $branch = $tamp = $div[0]->branch;

        if($lvl == '1'){
            $query = $this->db->query("select a.id_header, a.no_cuti, a.nip, e.name_status, a.total_cuti, c.name_cuti, b.keterangan, b.datestart, b.dateend, d.name_employe, e.label, d.division, d.position, d.date_join, d.signature, a.name_approve1, a.approve1, a.name_approve2, a.approve2, b.datecreate, a.total_stay, a.dateapprove1, a.dateapprove2, f.name_branch from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_jeniscuti c on b.jenis_cuti = c.id_jenis left join tb_employe d on a.nip = d.nip left join tb_status e on a.status = e.level_status left join tb_branch f on d.branch = f.id_branch where a.nip = '$nip' and a.status = 3 group by no_cuti DESC")->result();

        }else if($lvl == '2'){
            $query = $this->db->query("select a.id_header, a.no_cuti, a.nip, e.name_status, a.total_cuti, c.name_cuti, b.keterangan, b.datestart, b.dateend, d.name_employe, e.label, d.division, d.position, d.date_join, d.signature, a.name_approve1, a.approve1, a.name_approve2, a.approve2, b.datecreate, a.total_stay, a.dateapprove1, a.dateapprove2, f.name_branch from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_jeniscuti c on b.jenis_cuti = c.id_jenis left join tb_employe d on a.nip = d.nip left join tb_status e on a.status = e.level_status left join tb_branch f on d.branch = f.id_branch where a.status = 3 and d.division = '$division' group by no_cuti DESC")->result();
        }else if($lvl == '3'){
            $query = $this->db->query("select a.id_header, a.no_cuti, a.nip, e.name_status, a.total_cuti, c.name_cuti, b.keterangan, b.datestart, b.dateend, d.name_employe, e.label, d.division, d.position, d.date_join, d.signature, a.name_approve1, a.approve1, a.name_approve2, a.approve2, b.datecreate, a.total_stay, a.dateapprove1, a.dateapprove2, f.name_branch from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_jeniscuti c on b.jenis_cuti = c.id_jenis left join tb_employe d on a.nip = d.nip left join tb_status e on a.status = e.level_status left join tb_branch f on d.branch = f.id_branch where d.branch = '$branch' and a.status = 3 group by no_cuti DESC")->result();
        }else{
            $query = $this->db->query("select a.id_header, a.no_cuti, a.nip, e.name_status, a.total_cuti, c.name_cuti, b.keterangan, b.datestart, b.dateend, d.name_employe, e.label, d.division, d.position, d.date_join, d.signature, a.name_approve1, a.approve1, a.name_approve2, a.approve2, b.datecreate, a.total_stay, a.dateapprove1, a.dateapprove2, f.name_branch from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_jeniscuti c on b.jenis_cuti = c.id_jenis left join tb_employe d on a.nip = d.nip left join tb_status e on a.status = e.level_status left join tb_branch f on d.branch = f.id_branch where a.status = 3 group by no_cuti DESC")->result();
        }

        return($query);
    }

}
