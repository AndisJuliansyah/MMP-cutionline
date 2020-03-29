<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_approvel extends CI_Model {

	public function get_transaksi($nip, $level) {

        $div = $this->db->get_where('tb_employe', array('nip' => $nip))->result();
        $nip = $tamp = $div[0]->division;

        if($level == '3'){
            $query = $this->db->query("select a.id_header, a.no_cuti, a.nip, e.name_status, a.total_cuti, c.name_cuti, b.keterangan, b.datestart, b.dateend, d.name_employe, e.label from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_jeniscuti c on b.jenis_cuti = c.id_jenis left join tb_employe d on a.nip = d.nip left join tb_status e on a.status = e.level_status where a.status = 1 group by no_cuti DESC")->result();

        }else if($level == '2'){
            $query = $this->db->query("select a.id_header, a.no_cuti, a.nip, e.name_status, a.total_cuti, c.name_cuti, b.keterangan, b.datestart, b.dateend, d.name_employe, e.label from tb_headercuti a left join tb_cuti b on a.no_cuti = b.no_cuti left join tb_jeniscuti c on b.jenis_cuti = c.id_jenis left join tb_employe d on a.nip = d.nip left join tb_status e on a.status = e.level_status where a.status = 0 and division='$nip' group by no_cuti DESC")->result();
        }else{
            $query = "NO ACCESS";
        }

        return($query);
    }

    public function get_approve($nip){

        $data = $this->db->get_where('tb_employe', array('nip' => $nip))->result();

        return($data);
    }

    public function addapprove($id, $data){

        $this->db->where('id_header', $id);
        $data = $this->db->update('tb_headercuti', $data);

        if($data){
            echo "ok";
        }else{
            echo "no";
        }
    }

    public function managerapprove($id, $data, $total, $nip_employe){

        $query = $this->db->get_where('tb_cuti', array('id_cuti' => $id))->result();

        if($query[0]->jenis_cuti == 2){
                    $this->db->where('id_header', $id);
            $data = $this->db->update('tb_headercuti', $data);

            if($data){
                echo "ok";
            }else{
                echo "no";
            }
        }else{
            $getavlaible = $this->db->get_where('tb_avlaiblecuti', array('nip'=>$nip_employe))->result();
            $getpertahun = $this->db->get_where('tb_backup', array('nip'=>$nip_employe))->result();

            
            if(!empty($getpertahun)){
                if($getpertahun[0]->sisa != 0){

                    $jml = $getpertahun[0]->sisa - $total;
                    $jml2 = $getpertahun[0]->get_sisa + $total;

                    $this->db->where('id_header', $id);
                    $data = $this->db->update('tb_headercuti', $data);

                    if($data){
                        $data1 = array('sisa' => $jml, 'get_sisa' => $jml2);
                        $this->db->where('nip', $nip_employe);
                        $data3 = $this->db->update('tb_backup', $data1);
                            if($data3){
                                echo "ok";   
                            }
                    }else{
                        echo "no";
                    }
                }else{
                    
                    $jumlah = $getavlaible[0]->sisa_cuti - $total;
                    $jumlah2 = $getavlaible[0]->all_cuti + $total;

                            $this->db->where('id_header', $id);
                    $data = $this->db->update('tb_headercuti', $data);
                    
                    if($data){
                        $data1 = array('sisa_cuti' => $jumlah, 'all_cuti' => $jumlah2);
                        $this->db->where('nip', $nip_employe);
                        $data3 = $this->db->update('tb_avlaiblecuti', $data1);
                        if($data3){
                            echo "ok";   
                        }
                    }else{
                        echo "no";
                    }
                }
            }else{
                    $jumlah = $getavlaible[0]->sisa_cuti - $total;
                    $jumlah2 = $getavlaible[0]->all_cuti + $total;

                            $this->db->where('id_header', $id);
                    $data = $this->db->update('tb_headercuti', $data);
                    
                    if($data){
                        $data1 = array('sisa_cuti' => $jumlah, 'all_cuti' => $jumlah2);
                        $this->db->where('nip', $nip_employe);
                        $data3 = $this->db->update('tb_avlaiblecuti', $data1);
                        if($data3){
                            echo "ok";   
                        }
                    }else{
                        echo "no";
                    }  
            }
        }
    }

    public function revisiapprove($no, $data){

        $this->db->where('id_header', $no);
        $data = $this->db->update('tb_headercuti', $data);

        if($data){
            echo "ok";
        }else{
            echo "no";
        }
    }

     public function failedapprove($no, $data){

        $this->db->where('id_header', $no);
        $data = $this->db->update('tb_headercuti', $data);

        if($data){
            echo "ok";
        }else{
            echo "no";
        }
    }
    
}
