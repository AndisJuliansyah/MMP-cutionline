<?php
/**
 * User  : Indras Yuda Suprapto
 * Email : baim.moh@gmail.com
 * Date  : 22-08-2017
 * Time  : 15:07
 */
class Mmp_Lib {

    private $CI = NULL;

    public function __construct() {
        
        $this->CI =& get_instance();
    }

    function Menu(){
        $this->CI->db->select('*');
        $this->CI->db->from('tb_menus');
        $this->CI->db->where('status', '0');
        $this->CI->db->order_by('list');
        $query = $this->CI->db->get();
        return $query->result();
    }
    
    function SubMenu(){
        $this->CI->db->select('*');
        $this->CI->db->from('tb_submenus');
        $this->CI->db->where('status', '0');
        $this->CI->db->order_by('id_submenus');
        $query = $this->CI->db->get();
        return $query->result();
    }

    // function Menuaccess($id_level){

    //     $query = $this->db->get_where('tb_access', array('id_users' => $id_level))->result();

    //     return($query);
    // }

    function MenuUser($level){
        // print_r($id_users); exit();
        // $this->CI->db->select('a.*,b.n_menus, b.id_submenus, a.id_menus');
        // $this->CI->db->from('tb_access a');
        // $this->CI->db->join('tb_menus b', 'b.id_menus = a.id_menus', 'left');
        // $this->CI->db->where('a.id_users', $id_users);
        // $this->CI->db->where('a.status', '0');
        // $query = $this->CI->db->get();

        $query = $this->CI->db->query("select a.id_menus, b.n_menus, b.id_submenus, b.icon, b.url from tb_access a left join tb_menus b on a.id_menus = b.id_menus where a.id_users = $level and a.status = 0 order by b.list asc")->result();
        
        return($query);
    }

}