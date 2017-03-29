<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_login extends CI_Model{
	
	function cek_user($userid="",$password="",$active="")
	{
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->where('anggota.userid', $userid);
		$this->db->where('anggota.password', $password);
		//$this->db->where('anggota.active', $active);
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}
	function ambil_user($userid)
    {
        $this->db->select('*');
		$this->db->from('anggota');
		$this->db->where('anggota.userid', $userid);
	//	$this->db->where('anggota.password', $password);
		$query = $this->db->get();
        $query = $query->result_array();
        if($query){
            return $query[0];
        }
    }
    function jumlahiot()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('ideatype', ['IOT,']);
		$this->db->where_in('cmsstatus', ['']);
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
		{
			$row = $query->num_rows();
			return $row;
		}else{
		return 0;}
	}
	function jumlahiotgb()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('ideatype', ['IOT,','IOT, Product Design']);
		$this->db->where_in('cmsstatus', ['']);
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
		{
			$row = $query->num_rows();
			return $row;
		}else{
		return 0;}
	}
	function jumlahiotpd()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('ideatype', ['IOT, Product Design']);
		$this->db->where_in('cmsstatus', ['']);
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
		{
			$row = $query->num_rows();
			return $row;
		}else{
		return 0;}
	}
	function jumlahpd()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('ideatype', ['Product Design']);
		$this->db->where_in('cmsstatus', ['']);
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
		{
			$row = $query->num_rows();
			return $row;
		}else{
		return 0;}
	}
	function jumlahall()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where_in('ideatype', ['IOT,','Product Design', 'IOT, Product Design']);
		$this->db->where_in('cmsstatus', ['']);
		$query = $this->db->get();
		if ($query->num_rows() > 0 )
		{
			$row = $query->num_rows();
			return $row;
		}else{
		return 0;}
	}
}