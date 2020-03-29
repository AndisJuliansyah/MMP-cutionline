<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class M_manage extends CI_Model {

  public function get_level() {

      $query = $this->db->get('tb_level')->result();

      return($query);
  }

  public function get_menu() {

      $query = $this->db->get('tb_menus')->result();

      return($query);
  }

  public function get_access($id_level) {

      $query = $this->db->query("select a.id_menus, b.n_menus, a.status from tb_access a left join tb_menus b on a.id_menus = b.id_menus where a.id_users = $id_level and a.status = 0")->result();
      // echo "<pre>";
      // print_r($query); echo "<pre>"; exit();
      return($query);
  }
}
