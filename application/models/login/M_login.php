<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_login extends CI_Model {

    function login() {

        $username = $this->input->post('username');
        $password = $this->input->post('pass');

        $query = $this->db->query(" select a.id_users, a.nip, a.n_name, a.username, a.level, a.pass, b.image from tb_users a left join tb_employe b on a.nip = b.nip where username = '$username'");
        $row = $query->num_rows();

        if ($row > 0) {
            $row = $query->row();

            //print_r($row); die();
            $hash = $row->pass;

            if (password_verify($password, $hash)) {

                $data = array(
                    'id_users' => $row->id_users,
                    'nip' => $row->nip, 
                    'n_name' => $row->n_name,
                    'username' => $row->username,
                    'level' => $row->level,
                    'image' => $row->image,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($data);
                redirect(base_url("dashboardcontroller"));
            } else {
                $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Oppss</h4>
                    <p>Password Failed Try again</p>
                </div>');    
                redirect('Login');
            }
        } else {
            $this->session->set_flashdata('msg', 
                '<div class="alert alert-danger">
                    <h4>Oppss</h4>
                    <p>Username Failed Try again</p>
                </div>');    
                redirect('Login');
        }
    }

    public function log_out() {

        $this->session->unset_userdata(array('id_users','username', 'nip', 'n_name', 'level', 'image', 'logged_in'));
        $this->session->sess_destroy();
        redirect(base_url("login"));
    }

}
