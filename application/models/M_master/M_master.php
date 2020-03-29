<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_master extends CI_Model {

	public function get_division(){

		$query = $this->db->get('tb_division')->result();

		return($query);
	}

	public function get_avlaiblecuti(){
		
		$query = $this->db->get('tb_avlaiblecuti')->result();
		return($query);
	}

	public function get_branch(){
		$query = $this->db->get('tb_branch')->result();
		return($query);
	}

	public function get_holiday(){
		$query = $this->db->get('tb_date')->result();
		return($query);
	}

	public function get_subjenis(){
		$query = $this->db->get('tb_subjenis')->result();
		return($query);
	}

	public function add_divisi($data){
		
		$cek = $this->db->get_where('tb_division', array('name_division' => $data['name_division']));
		$row = $cek->num_rows();

		if($row > 0){
			echo "no";
		}else{

			$save = $this->db->insert('tb_division', $data);
			if($save){
				echo "ok";
			}else{
				echo "no";
			}
		}
		return($save);
	}

	public function edit_divisi($data, $id){
		
		$cek = $this->db->get_where('tb_division', array('name_division' => $data['name_division']));
		$row = $cek->num_rows();

		if($row > 0){
			echo "no";
		}

				$this->db->set('name_division', $data['name_division']);
				$this->db->where('id_div', $id);
		$save = $this->db->update('tb_division');

		if ($save) {
			echo "ok";
		}else{
			echo "no";
		}

		return($save);
	}

	public function edit_jmlcuti($data, $id){

				$this->db->set('total_cuti', $data['total_cuti']);
				$this->db->set('sisa_cuti', $data['sisa_cuti']);
				$this->db->where('id_avlaible', $id);
		$save = $this->db->update('tb_avlaiblecuti');

		if ($save) {
			echo "ok";
		}else{
			echo "no";
		}

		return($save);
	}

	public function delete_divisi($id){

		$this->db->where('id_div', $id);
		$delete = $this->db->delete('tb_division');

		if ($delete) {
			echo "ok";
		}else{
			echo "no";
		}

		return($delete);
	}

	public function add_branch($data){
		
		$cek = $this->db->get_where('tb_branch', array('name_branch' => $data['name_branch']));
		$row = $cek->num_rows();

		if($row > 0){
			echo "no";
		}else{
			$save = $this->db->insert('tb_branch', $data);
			if($save){
				echo "ok";
			}else{
				echo "no";
			}
		}
		return($save);
	}

	public function edit_branch($data, $id){

		$cek = $this->db->get_where('tb_branch', array('name_branch' => $data['name_branch']));
		$row = $cek->num_rows();

		if($row > 0){
			echo "no";
		}

		$this->db->set('name_branch', $data['name_branch']);
		$this->db->where('id_branch', $id);
		$save = $this->db->update('tb_branch');

		if ($save) {
			echo "ok";
		}else{
			echo "no";
		}

		return($save);
	}

	public function delete_branch($id){
		
		$this->db->where('id_branch', $id);
		$delete = $this->db->delete('tb_branch');

		if ($delete) {
			echo "ok";
		}else{
			echo "no";
		}

		return($delete);
	}

	public function edit_subjenis($data, $id){

		$this->db->set('total_cuti', $data['total_cuti']);
		$this->db->where('id_subjenis', $id);
		$save = $this->db->update('tb_subjenis');

		if ($save) {
			echo "ok";
		}else{
			echo "no";
		}

		return($save);
	}

	public function add_date($data){
		
		$cek = $this->db->get_where('tb_date', array('name' => $data['name'], 'date' => $data['date']));
		$row = $cek->num_rows();

		if($row > 0){
			echo "no";
		}else{

			$this->db->where('id_date', $id);
			$save = $this->db->update('tb_date', $data);

			if ($save) {
				echo "ok";
			}else{
				echo "no";
			}
			
		}
		return($save);
	}

	public function edit_date($data, $id){

		$cek = $this->db->get_where('tb_date', array('name' => $data['name'], 'date' => $data['date']));
		$row = $cek->num_rows();

		if($row > 0){
			echo "no";
		}else{

			$this->db->where('id_date', $id);
			$save = $this->db->update('tb_date', $data);

			if ($save) {
				echo "ok";
			}else{
				echo "no";
			}

		}
		return($save);
	}

	public function delete_date($id){
		
		$this->db->where('id_date', $id);
		$delete = $this->db->delete('tb_date');

		if ($delete) {
			echo "ok";
		}else{
			echo "no";
		}

		return($delete);
	}

	public function backup(){

		$get = $this->db->get('tb_avlaiblecuti')->result();
		$year = date('Y');
		$data = array();
        $index = 0;
        foreach($get as $datanis){ 
        		array_push($data, array(
                        'nip'=>$datanis->nip,
                        'sisa'=>$datanis->sisa_cuti,
                        'sisa_tahun'=>$datanis->sisa_cuti,
                        'datecreate'=> date('Y-m-d'),
                        'get_sisa'=>'',
                      ));
                        $index++;
                    }
        
        $get = $this->db->get_where('tb_backup', array('year(datecreate)'=> $year))->num_rows();
        
        if($get > 0){
        	echo "no";
        }else{
        	$this->db->insert_batch('tb_backup', $data);
        	echo "ok";
        }
       
      	return;
	}
}
