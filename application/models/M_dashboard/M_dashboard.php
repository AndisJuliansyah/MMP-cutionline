<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	public function get_kalkulasi($lvl, $nip) {

        $div = $this->db->get_where('tb_employe', array('nip' => $nip))->result();
        $division = $tamp = $div[0]->division;
        $branch = $tamp = $div[0]->branch;

        if($lvl == '1'){
            $avlaible = $this->db->query("select a.total_cuti, a.sisa_cuti, a.all_cuti from tb_avlaiblecuti a left join tb_employe b on a.nip = b.nip left join tb_headercuti c on b.nip = c.nip where a.nip ='$nip'")->result();

            return($avlaible);
          }else if($lvl == '2'){
            $avlaible = $this->db->query("select a.no_cuti, b.name_employe, c.name_status from tb_headercuti a left join tb_employe b on a.nip = b.nip left join tb_status c on a.status = c.level_status where b.division = '$division' and a.status = 0 and b.branch='$branch'");
            
            $count = $avlaible->num_rows();

            return($count);
          }else if($lvl == '3'){
            $avlaible = $this->db->query("select a.no_cuti, b.name_employe, c.name_status from tb_headercuti a left join tb_employe b on a.nip = b.nip left join tb_status c on a.status = c.level_status where a.status = 1 and b.branch = '$branch' ");
            
            $count = $avlaible->num_rows();

            return($count);
          }else{

          }
    }

  public function get_transaksi($lvl, $nip) {

        if($lvl == '1'){
            $transaksi = $this->db->query("select * from tb_headercuti where nip = '$nip' and status = 4");
            $count = $transaksi->num_rows();

            return($count);
          }else if($lvl == '3'){
            $transaksi = $this->db->query("select * from tb_headercuti where nip = '$nip' and status = 4");
            $count = $transaksi->num_rows();

            return($count);
        }else{
            $transaksi = $this->db->query("select * from tb_headercuti where status between 0 and 2");
            $transaksi2 = $this->db->query("select * from tb_headercuti where status = 3");
            $transaksi3 = $this->db->query("select * from tb_headercuti where status = 4");
            $count = $transaksi->num_rows();
            $count2 = $transaksi2->num_rows();
            $count3 = $transaksi3->num_rows();

            return $count.','.$count2.','.$count3;
        }
    }

  public function get_employe($lvl, $nip) {

        $div = $this->db->get_where('tb_employe', array('nip' => $nip))->result();
        $division = $tamp = $div[0]->division;
        $branch = $tamp = $div[0]->branch;

        if($lvl == '2'){
            $transaksi = $this->db->query("select * from tb_employe where position != '2' and division = '$division' and branch='$branch' and position='1'");
            $count = $transaksi->num_rows();

            return($count);
        }else if($lvl == '3'){
            $transaksi = $this->db->query("select * from tb_employe where position != '3' and branch='$branch'");
            $count = $transaksi->num_rows();

            return($count);
        }else{
            $transaksi = $this->db->query("select * from tb_employe");
            $count = $transaksi->num_rows();

            return($count);
        }
    }

}
