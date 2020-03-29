<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_cuti extends CI_Model {

	public function get_employe($nip) {

        $sql = $this->db->query("select a.nip, a.name_employe, c.name_level, e.name_division, a.date_join, a.signature, b.total_cuti, b.sisa_cuti from tb_employe a left join tb_avlaiblecuti b on a.nip = b.nip left join tb_level c on a.position = c.id_level left join tb_division e on a.division = e.id_div where a.nip='".$nip."'");
        $res = $sql->result();

        return($res);
    }

  public function get_cutipertahun($nip){

        $tahun = date('Y') - 1;
        $sql = $this->db->query("SELECT * FROM tb_backup WHERE nip = '".$nip."' and year(datecreate) ='$tahun'");
        $res = $sql->result();
        
        return($res);
    }

  public function get_transaksi($nip, $thn){

        $sql = $this->db->query("SELECT * FROM tb_cuti WHERE nip = '".$nip."' and year(datecreate) ='$thn'");
        $res = $sql->num_rows();

        return($res);
  }

  public function sum_cuti($nip, $tahun){

        $sql = $this->db->query("SELECT sum(total_cuti) FROM tb_cuti WHERE nip = '".$nip."' and year(datecreate) ='$tahun'");
        $res = $sql->result();

        return($res);
  }

  public function code_otomatis(){

        $tahun = date('Y');
        $nomor = "CT";
        $query = $this->db->query("SELECT max(no_cuti) as maxKode FROM tb_cuti WHERE year(datecreate) ='$tahun'");
        $data = $query->result();
        $no= $data[0]->maxKode;
        $pecah = substr($no,8);

        $noUrut= intval($pecah) + 1;
        $kode =  sprintf("%04s", $noUrut);
        $kodejadi = $nomor.'-'.$tahun.'-'.$kode;  
            return $kodejadi;
    }   
          

    public function get_jenis() {

        $sql = $this->db->get('tb_jeniscuti');
        $res = $sql->result();

        return($res);
    }

    public function get_subjenis() {

        $sql = $this->db->get('tb_subjenis');
        $res = $sql->result();

        return($res);
    }

    public function get_status($no_cuti) {

        $query = $this->db->get_where('tb_headercuti', array('no_cuti' => $no_cuti))->result();
        // print_r($no_cuti); exit();
        $sql = $this->db->query('select * from tb_status where id_status > 0 and id_status < 4');
        $res = $sql->result();
        $data = '';
        foreach ($res as $key) {
            if($query[0]->status == $key->level_status){
              $data .= '<td style="width:70px;">
                              <input type="hidden" name="status" value="'.$key->name_status.'">
                              <img src="assets/img/silang.png" style="width:20px; height: 20px;border:0,1px solid black">
                          </td>';
            }else{
                $data .= '<td style="width:70px;">
                              <input type="hidden" name="status" value="'.$key->name_status.'">
                              <img src="assets/img/kotak.png" style="width:20px; height: 20px;">
                          </td>';
            }
        }
        return($data);
    }

    public function get_sub($no_cuti) {

        $query = $this->db->get_where('tb_cuti', array('no_cuti' => $no_cuti))->result();
        // print_r($query[0]->subjenis);
        $sql = $this->db->query('select * from tb_subjenis');
        $res = $sql->result();
        $data = '';
        foreach ($res as $key) {
          if($query[0]->subjenis == $key->id_subjenis){
              $data .= '<tr>
                        <td style="width:70px;">
                                <input type="hidden" name="status" value="'.$key->id_subjenis.'">
                                <img src="assets/img/silang.png" style="width:20px; height: 20px;">
                        </td>
                        <td style="width:70px;">'.$key->name_subjenis.' :</td>
                        <td style="width:70px;"></td>
                        <td style="width:70px;">hari</td>
                      </tr>';
          }else{
            $data .= '<tr>
                        <td style="width:70px;">
                                <input type="hidden" name="status" value="'.$key->id_subjenis.'">
                                <img src="assets/img/kotak.png" style="width:20px; height: 20px;">
                        </td>
                        <td style="width:70px;">'.$key->name_subjenis.' :</td>
                        <td style="width:70px;"></td>
                        <td style="width:70px;">hari</td>
                      </tr>';
          }
            
        }
        return($data);
    }

    public function get_sisa($nip){

    	$query = $this->db->query("select b.sisa_cuti from tb_employe a left join tb_avlaiblecuti b on a.nip = b.nip where a.nip='$nip'")->result();
    	$tamp = $query[0]->sisa_cuti;
      
    	return($tamp);
    }

    public function get_pertahun($nip){
      $tahun = date('Y') - 1;
      $query = $this->db->query("select sisa from tb_backup where year(datecreate) ='$tahun'")->result();
      $tamp = $query[0]->sisa;
      
      return($tamp);
    }

    public function get_cutikhusus($subjenis){

      $query = $this->db->get_where('tb_subjenis', array('id_subjenis' => $subjenis))->result();
      $tamp = $query[0]->total_cuti;

      return($tamp);
    }

    public function get_tanggal(){

    	$query = $this->db->query("select date from tb_date");
    	$tampung = "";
    	foreach ($query->result_array() as $key ) {
    		 $tampung .= "'".$key['date']."',";
    	}

    	$tampung = rtrim($tampung, ",");
    	return '{"lem" : "'.$tampung.'"}';
    }

    public function update_sisa($nip,$total_day){

        $query = $this->db->query("select sisa_cuti from tb_avlaiblecuti where nip='".$nip."'")->result();
        $tamp = $query[0]->sisa_cuti;
        $pengurangan = $tamp - $total_day;

        $this->db->set('sisa_cuti', $pengurangan);
        $this->db->where('nip', $nip);
        $this->db->update('tb_avlaiblecuti');
        
        return;
    }

    public function add_cuti($data, $data1){
      
        $date1 = $data[0]['datestart'];
        $date2 = $data[0]['dateend'];

        $cek = $this->db->query('Select * from tb_cuti where datestart = "'.$date1.'" and dateend = "'.$date2.'"');
        $rows = $cek->num_rows();
        
        if($rows>1){
          echo "no";
        }else{
          $this->db->insert_batch('tb_cuti', $data);
          $this->db->insert('tb_headercuti', $data1);
          echo "ok";
        }

        return;
    }

    public function sendcuti($no, $data){

        $this->db->where('id_header', $no);
        $data = $this->db->update('tb_headercuti', $data);

        if($data){
            echo "ok";
        }else{
            echo "no";
        }
    }

    public function get_datatrans($code){

       $query = $this->db->get_where('tb_cuti', array('no_cuti' => $code))->result();

       return($query);
    }

    public function get_jeniskete($code){

       $query = $this->db->query("select * from tb_cuti where no_cuti = '".$code."'group by keterangan ASC")->result();

       return($query);
    }

    public function update_data($data, $idcuti, $id_cuti, $data1, $no){
      
      $nip = $data[0]['nip']; 

        if($idcuti[0] != ''){
          //kondisi edit data lama dan penambahan data baru\
          $proses = $this->db->delete('tb_cuti', array('no_cuti' => $id_cuti, 'nip' => $nip));
                    $this->db->insert_batch('tb_cuti', $data);
        }else if($id_cuti[0] == ''){
          //kondisi saat data baru all
          $this->db->insert_batch('tb_cuti', $data);
        }else if($idcuti[0] != '' && $id_cuti[0] != ''){
          $this->db->insert_batch('tb_cuti', $data);
        }else{
            if($data[0]['id_cuti'] == ''){
            //kondisi saat input data baru dan masih ada data lama
                $this->db->insert_batch('tb_cuti', $data);
            }else{
                //kondisi saat data lama all
                $this->db->update_batch('tb_cuti', $data, 'id_cuti');
            }
        }

                 $this->db->set('total_cuti', $data1['total_cuti']);
                 $this->db->where('no_cuti', $no);
      $process = $this->db->update('tb_headercuti');
        if ($process) {
          echo "ok";
        }else{
          echo "no";
        }
        return;
    }

    public function delete_detail($id, $total, $no){
      
      $cektotal = $this->db->get_where('tb_headercuti', array('no_cuti' => $no))->result();
      $pengurangan = $cektotal[0]->total_cuti - $total;
      
      $proses = $this->db->delete('tb_cuti', array('id_cuti' => $id));

      if ($proses) {

            $this->db->set('total_cuti', $pengurangan);
            $this->db->where('no_cuti', $no);
            $this->db->update('tb_headercuti');

            echo "ok";
        }else{
            echo "no";
        }
    }

    public function get_data($no_cuti){
      
        $query = $this->db->query("select a.id_header, a.no_cuti, a.nip, e.name_status, a.total_cuti, c.name_cuti, b.keterangan, b.datestart, b.dateend, d.name_employe, e.label, f.name_division, g.name_level, d.date_join, d.signature, a.name_approve1, a.approve1, a.name_approve2, a.approve2, b.datecreate, a.total_stay, a.dateapprove1, a.dateapprove2, g.name_level, f.name_division from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_jeniscuti c on b.jenis_cuti = c.id_jenis left join tb_employe d on a.nip = d.nip left join tb_status e on a.status = e.level_status left join tb_division f on d.division = f.id_div left join tb_level g on d.position = g.id_level where a.no_cuti = '$no_cuti' group by no_cuti DESC")->result();

        return($query);
    }

    public function avalaiblecuti($nip){
      
        $query = $this->db->get_where('tb_avlaiblecuti', array('nip'=>$nip))->result();

        return($query);
    }

}
