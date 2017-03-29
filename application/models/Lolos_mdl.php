<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lolos_mdl extends CI_Model {

	var $table = 'users';
	var $column_order = array(
		'id','ip_address','username','password','salt','email',
		'activation_code','forgotten_password_code','forgotten_password_time',
		'remember_code','created_on','last_login','active','first_name','last_name','company','phone',
		'idnumber','address','birthdat','gender','teamname','ideatitle','ideadesc','ideafile','memberstats',
		'headuserid','ideatype','loginmethod','cmsstatus',null);
	var $column_search = array('first_name','teamname','ideatitle','ideadesc');
	var $order = array('status' => '1');
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;

		foreach ($this->column_search as $item)  
		{
			if($_POST['search']['value']) 
			{				
				if($i===0) 
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end(); 
			}
			$i++;
		}
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getsemua() {
		$this->db->select('users.*,lolos.*,anggota.*,users.ideatype');
		$this->db->from($this->table);
		$this->db->join('lolos', 'lolos.idpeserta = users.id');
		$this->db->join('anggota', 'anggota.idscreen = lolos.acc');
		$this->db->where('lolos.status !=',0 );
		$query = $this->db->get(); 
		return $query->result_array();
	}
	public function getprod() {
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->where('ideatype', "Product Design");
		$query = $this->db->get(); 
		return $query->result_array();
	}
	public function getiot() {
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->where('ideatype', "IOT,");
		$query = $this->db->get(); 
		return $query->result_array();
	}
	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
	public function ubah($where, $data)
	{
		$this->db->set('users',$data['status'])->where('users',$data['id'])->update('users');
	}
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function ambilin($id) {
		$this->db->select('users.*,screenrelation.idscreener');
		$this->db->from($this->table);
		$this->db->join('screenrelation', 'screenrelation.idpeserta = users.id');
		$this->db->where('users.id', $id);
		$query = $this->db->get();

		if ($query->num_rows() < 1)
		{
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('id', $id);
			$query = $this->db->get();
			
		}
		return $query->result_array();
	}
}