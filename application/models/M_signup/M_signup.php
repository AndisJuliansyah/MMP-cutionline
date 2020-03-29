<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_signup extends CI_Model {

    public function get_employe() {

       $get = $this->db->query("select a.nip, a.name_employe, a.position, d.name_division, b.name_branch, a.date_join, c.name_level from tb_employe a left join tb_branch b on a.branch = b.id_branch left join tb_level c on a.position = c.id_level left join tb_division d on a.division = d.id_div")->result();

       return($get);
    }

    public function get_employee($nip) {

       $get = $this->db->query("select a.nip, a.name_employe, a.position, d.name_division, b.name_branch, a.date_join, c.id_level, c.name_level from tb_employe a left join tb_branch b on a.branch = b.id_branch left join tb_level c on a.position = c.id_level left join tb_division d on a.division = d.id_div where nip = '$nip'");
       $olah = $get->result_array();
       
       return json_encode(array('ada' => $olah[0]));
    }

    public function get_active() {

       $get = $this->db->get('tb_active')->result();
       
       return $get;
    }

    public function get_level() {

       $get = $this->db->get('tb_level')->result();
       
       return $get;
    }

    public function save_data($data, $nip) {
        
       $cek = $this->db->get_where('tb_users', array('nip' => $nip));
       $olah = $cek->num_rows();
       if($olah > 0){
          echo "no";
          exit();
       }
        $save = $this->db->insert('tb_users', $data);
          if ($save) {
              echo "ok";
          }else{
            echo "nu";
        }
  }

}
