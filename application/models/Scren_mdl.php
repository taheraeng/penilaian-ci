<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Scren_mdl extends CI_Model {

    var $table = 'users';
    var $column_order = array(
        'id', 'ip_address', 'username', 'password', 'salt', 'email',
        'activation_code', 'forgotten_password_code', 'forgotten_password_time',
        'remember_code', 'created_on', 'last_login', 'active', 'first_name', 'last_name', 'company', 'phone',
        'idnumber', 'address', 'birthdat', 'gender', 'teamname', 'ideatitle', 'ideadesc', 'ideafile', 'memberstats',
        'headuserid', 'ideatype', 'loginmethod', 'cmsstatus', null);
    var $column_search = array('first_name', 'teamname', 'ideatitle', 'ideadesc');
    var $order = array('id' => 'desc');

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query() {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
     $this->db->select('users.*,nilai.*');
     $this->db->from($this->table);
     $this->db->join('nilai', 'nilai.idpeserta = users.id');
     return $this->db->count_all_results();
 }
 public function ratarata()
 {
    $this->db->distinct();
    $this->db->select('idpeserta');
     $this->db->order_by('idpeserta','asc') ;
    $sql = $this->db->get('screenrelation');
    $sqlresult = $sql->result_array();
    // var_dump($sqlresult);
      $xnilai=array();
    foreach ($sqlresult as $value)
    {
        $this->db->select_avg('xnilai');
        $this->db->where('idpeserta', $value['idpeserta']);
        $this->db->order_by('xnilai','asc') ;
        $query = $this->db->get('screenrelation');
        $result = $query->result_array();
         $res=$result[0]['xnilai'];
         array_push( $xnilai,$res);
        

    }

     // var_dump($xnilai);
    return $xnilai;
}
public function get_by_id($id) {
    $this->db->select('users.*,nilai.*');
    $this->db->from($this->table);
    $this->db->join('nilai', 'nilai.idpeserta = users.id');
    $this->db->where('users.id', $id);
    $query = $this->db->get();
    if ($query->num_rows() < 1) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
    }
    return $query->row();
}

public function getalluser($idscreen) {
    $this->db->select('anggota.*,screenrelation.*,users.*');

    $this->db->from('anggota');
    $this->db->join('screenrelation', 'screenrelation.idscreener = anggota.idscreen');
    $this->db->join('users', 'screenrelation.idpeserta = users.id');
  //  $this->db->group_by('idpeserta');
    $this->db->order_by('xnilai','asc') ;
    // $this->db->where_in('idscreener', $idscreen );
    $query = $this->db->get(); 
   // print_r($query->result_array()[]);
    return $query->result_array();
}
public function dapatkan($idrelation)
{
    $this->db->select('note');
    $this->db->from('screenrelation');
        $this->db->where('idrelation',$idrelation);
        $query = $this->db->get();
        return $query->row();
}

public function gettop100user() {
    $this->db->select('users.*,nilai.*');
    $this->db->from($this->table);
    $this->db->join('nilai', 'nilai.idpeserta = users.id');
         //      $this->db->where('status', "xto100");
    $this->db->order_by("totalidedesk", "desc");
    $this->db->limit('100');
    $query = $this->db->get(); 
    
    return $query->result_array();
}
public function getsemua() {
    $this->db->select('*');
    $this->db->from($this->table);
    $query = $this->db->get(); 
    
    return $query->result_array();
}

public function save($data) {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
}

public function update($where, $data) {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
}

public function delete_by_id($id) {
    $this->db->where('id', $id);
    $this->db->delete($this->table);
}

public function editdata($table = FALSE, $data = FALSE, $idname, $id) {
    $this->db->where($idname, $id);
    $db['query'] = $this->db->update($table, $data);
    $db['id'] = $this->db->insert_id();
    $db['affected_rows'] = $this->db->affected_rows();
    $db['status'] = $this->db->trans_status();
    return $db;
}

public function insertdata($table = FALSE, $data = FALSE) {
    $db['query'] = $this->db->insert($table, $data);
    $db['id'] = $this->db->insert_id();
    $db['affected_rows'] = $this->db->affected_rows();
    $db['status'] = $this->db->trans_status();
    return $db;
}
public function ambilin($idrelation) {
       // $this->db->select('anggota.*,screenrelation.*');
        $this->db->from('screenrelation');
        //$this->db->join('screenrelation', 'screenrelation.idscreener = anggota.idscreen');
        $this->db->where('screenrelation.idrelation', $idrelation);
        $query = $this->db->get();
        return $query->result_array();
    }

}
