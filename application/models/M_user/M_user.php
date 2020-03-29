<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_user extends CI_Model {

	public function get_user() {

       $get = $this->db->query("select a.nip, a.id_users, a.username, c.name_level, b.name_active, b.span from tb_users a left join tb_active b on a.status = b.id_join left join tb_level c on a.level = c.id_level")->result();

       return($get);
    }

    public function get_employe() {

       $get = $this->db->query("select a.nip, a.name_employe, a.position, a.division, b.name_branch, a.date_join from tb_employe a left join tb_branch b on a.branch = b.id_branch")->result();

       return($get);
    }

    public function get_employee($nip) {

       $get = $this->db->query("select a.nip, a.name_employe, a.position, a.division, b.name_branch, a.date_join from tb_employe a left join tb_branch b on a.branch = b.id_branch where nip = '$nip'");
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

  public function get_users($id_users) {

       $get = $this->db->get_where('tb_users', array('id_users' => $id_users));
       $res = $get->result();

       return($res);
  }


  public function edit_data($data, $id) {

        $this->db->where('id_users', $id);
        $query = $this->db->update('tb_users', $data);

        if ($query) {
          echo "ok";
        }else{
          echo "no";
        }
  }

  function delete_data($id){

    $this->db->where('id_users', $id);
    $query = $this->db->delete('tb_users');
    
    if ($query) {
        echo "ok";
    }else{
        echo "no";
    }
  }

}
