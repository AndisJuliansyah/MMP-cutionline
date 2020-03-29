<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_employe extends CI_Model {

	public function get_employe() {

       $get = $this->db->query("select a.nip, a.name_employe, a.id_employe, a.position, a.division, b.name_branch, a.date_join, c.name_division, d.name_level, e.sisa_cuti from tb_employe a left join tb_branch b on a.branch = b.id_branch left join tb_division c on a.division = c.id_div left join tb_level d on a.position = d.id_level left join tb_avlaiblecuti e on a.nip = e.nip")->result();

       return($get);
    }

    public function get_employ($id){

    	$get = $this->db->get_where('tb_employe', array('id_employe' => $id))->result();

    	return($get);
    }

    public function get_division() {

       $get = $this->db->get('tb_division')->result();

       return($get);
    }

    public function get_position() {

       $get = $this->db->get('tb_level')->result();

       return($get);
    }

    public function get_branch() {

       $get = $this->db->get('tb_branch')->result();

       return($get);
    }

    public function save_data($data, $data2){

        $cek = $this->db->get_where('tb_employe', array('nip' => $data['nip']));
        $row = $cek->num_rows();

        if($row > 0){
            echo "no";
        }else{
            $save = $this->db->insert('tb_employe', $data);

            if($save){
                $this->db->insert('tb_avlaiblecuti', $data2);
                echo "ok";
            }else{
                echo "no";
            } 
        }
    	return ($save);
    }

    public function update_data($data, $id){
        $this->load->helper('file');
    	$get = $this->db->get_where('tb_employe', array('id_employe' => $id))->result();
    	$img = "assets/img/employe/".$get[0]->image;
    	$sgn = "assets/img/employe/".$get[0]->signature;

        
    	if ($data['image'] != '' && $data['signature'] != '') {
                    unlink($img);
                    unlink($sgn);
		}else if($data['signature'] != ''){
                    unset($data['image']);
		        	unlink($sgn);
		}else if($data['image'] != ''){
                    unset($data['signature']);
		        	unlink($img);
		}else{
                    unset($data['image']);
                    unset($data['signature']);
        }
     
    	$this->db->where('id_employe', $id);
        $query = $this->db->update('tb_employe', $data);

        if ($query) {
          echo "ok";
        }else{
          echo "no";
        }

        return($query);
    }

    public function delete_data($id){

    	$get = $this->db->get_where('tb_employe', array('id_employe' => $id))->result();
    	$img = "assets/img/employe/".$get[0]->image;
    	$sgn = "assets/img/employe/".$get[0]->signature;

    	$this->db->where('id_employe', $id);
    	$del = $this->db->delete('tb_employe');

    	if($del){
    		unlink($img);
    		unlink($sgn);
            $this->db->where('nip', $get[0]->nip);
            $this->db->delete('tb_avlaiblecuti');
    		echo "ok";
    	}else{
    		echo "no";
    	}

    	return($del);
    }
}
