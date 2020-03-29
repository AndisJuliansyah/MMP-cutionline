<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class M_report extends CI_Model {

  public function get_divisi() {

      $query = $this->db->get('tb_division')->result();

      return($query);
  }

  public function get_branch() {

      $query = $this->db->get('tb_branch')->result();

      return($query);
  }

  public function get_jeniscuti() {

      $query = $this->db->get('tb_jeniscuti')->result();

      return($query);
  }

	public function get_transaksi($data) {

      if($data["nip"] != ''){
        //echo "a";
        $query = $this->db->query('select a.no_cuti, a.nip, c.name_employe, d.name_division, e.name_branch, f.name_cuti, b.keterangan, g.name_status, b.datestart, g.label, b.dateend from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_employe c on a.nip = c.nip left join tb_division d on c.division = d.id_div left join tb_branch e on c.branch = e.id_branch left join tb_jeniscuti f on b.jenis_cuti = f.id_jenis left join tb_status g on a.status = g.level_status where a.nip like "%'.$data["nip"].'%" and c.name_employe like "%'.$data["name"].'%" and c.division like "%'.$data['divisi'].'%" and c.branch like "%'.$data['cabang'].'%" and a.status like "%'.$data['status'].'%" and b.jenis_cuti like "%'.$data['jenis'].'%"')->result();
      }
      if($data["name"] != ''){
        //echo "b";
        $query = $this->db->query('select a.no_cuti, a.nip, c.name_employe, d.name_division, e.name_branch, f.name_cuti, b.keterangan, g.name_status, b.datestart, g.label, b.dateend from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_employe c on a.nip = c.nip left join tb_division d on c.division = d.id_div left join tb_branch e on c.branch = e.id_branch left join tb_jeniscuti f on b.jenis_cuti = f.id_jenis left join tb_status g on a.status = g.level_status where a.nip like "%'.$data["nip"].'%" and c.name_employe like "%'.$data["name"].'%" and c.division like "%'.$data['divisi'].'%" and c.branch like "%'.$data['cabang'].'%" and a.status like "%'.$data['status'].'%" and b.jenis_cuti like "%'.$data['jenis'].'%"')->result();
      }
      if($data["divisi"] != ''){
        //echo "c";
        $query = $this->db->query('select a.no_cuti, a.nip, c.name_employe, d.name_division, e.name_branch, f.name_cuti, b.keterangan, g.name_status, b.datestart, g.label, b.dateend from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_employe c on a.nip = c.nip left join tb_division d on c.division = d.id_div left join tb_branch e on c.branch = e.id_branch left join tb_jeniscuti f on b.jenis_cuti = f.id_jenis left join tb_status g on a.status = g.level_status where a.nip like "%'.$data["nip"].'%" and c.name_employe like "%'.$data["name"].'%" and c.division like "%'.$data['divisi'].'%" and c.branch like "%'.$data['cabang'].'%" and a.status like "%'.$data['status'].'%" and b.jenis_cuti like "%'.$data['jenis'].'%"')->result();
      }
      if($data["cabang"] != ''){
        //echo "d";
        $query = $this->db->query('select a.no_cuti, a.nip, c.name_employe, d.name_division, e.name_branch, f.name_cuti, b.keterangan, g.name_status, b.datestart, g.label, b.dateend from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_employe c on a.nip = c.nip left join tb_division d on c.division = d.id_div left join tb_branch e on c.branch = e.id_branch left join tb_jeniscuti f on b.jenis_cuti = f.id_jenis left join tb_status g on a.status = g.level_status where a.nip like "%'.$data["nip"].'%" and c.name_employe like "%'.$data["name"].'%" and c.division like "%'.$data['divisi'].'%" and c.branch like "%'.$data['cabang'].'%" and a.status like "%'.$data['status'].'%" and b.jenis_cuti like "%'.$data['jenis'].'%"')->result();
      }
      if($data["status"] != ''){
        //echo "e";
        $query = $this->db->query('select a.no_cuti, a.nip, c.name_employe, d.name_division, e.name_branch, f.name_cuti, b.keterangan, g.name_status, b.datestart, g.label, b.dateend from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_employe c on a.nip = c.nip left join tb_division d on c.division = d.id_div left join tb_branch e on c.branch = e.id_branch left join tb_jeniscuti f on b.jenis_cuti = f.id_jenis left join tb_status g on a.status = g.level_status where a.nip like "%'.$data["nip"].'%" and c.name_employe like "%'.$data["name"].'%" and c.division like "%'.$data['divisi'].'%" and c.branch like "%'.$data['cabang'].'%" and a.status like "%'.$data['status'].'%" and b.jenis_cuti like "%'.$data['jenis'].'%"')->result();
      }
       if($data["jenis"] != ''){
        //echo "f";
        $query = $this->db->query('select a.no_cuti, a.nip, c.name_employe, d.name_division, e.name_branch, f.name_cuti, b.keterangan, g.name_status, b.datestart, g.label, b.dateend from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_employe c on a.nip = c.nip left join tb_division d on c.division = d.id_div left join tb_branch e on c.branch = e.id_branch left join tb_jeniscuti f on b.jenis_cuti = f.id_jenis left join tb_status g on a.status = g.level_status where a.nip like "%'.$data["nip"].'%" and c.name_employe like "%'.$data["name"].'%" and c.division like "%'.$data['divisi'].'%" and c.branch like "%'.$data['cabang'].'%" and a.status like "%'.$data['status'].'%" and b.jenis_cuti like "%'.$data['jenis'].'%"')->result();
      }
      if($data["datestart"] != ''){
        //echo "g";
         $query = $this->db->query('select a.no_cuti, a.nip, c.name_employe, d.name_division, e.name_branch, f.name_cuti, b.keterangan, g.name_status, b.datestart, g.label, b.dateend from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_employe c on a.nip = c.nip left join tb_division d on c.division = d.id_div left join tb_branch e on c.branch = e.id_branch left join tb_jeniscuti f on b.jenis_cuti = f.id_jenis left join tb_status g on a.status = g.level_status where a.nip like "%'.$data["nip"].'%" and c.name_employe like "%'.$data["name"].'%" and c.division like "%'.$data['divisi'].'%" and c.branch like "%'.$data['cabang'].'%" and a.status like "%'.$data['status'].'%" and b.jenis_cuti like "%'.$data['jenis'].'%" and b.datestart between "'.$data['datestart'].'" and "'.$data['dateend'].'"')->result();
      }
      

       return $query;

  }

}
