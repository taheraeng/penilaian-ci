<?php
class User_model extends CI_Model {

    public $status; 
    public $roles;
    
    function __construct(){
        parent::__construct();
    }
    
    public function insertToken($user_id, $tmp)
    {   
        $token = substr(sha1(rand()), 0, 30); 
        $date = date('Y-m-d');
        
        $string = array(
                'token'=> $token,
                'user_id'=>$user_id,
                'temporary_password'=>$tmp,
                'created'=>$date
            );
        $query = $this->db->insert_string('tokens',$string);
        $this->db->query($query);
        return $token . $user_id;
        
    }
    
    public function isTokenValid($token)
    {
       $tkn = substr($token,0,30);
       $uid = substr($token,30);      
       
        $q = $this->db->get_where('tokens', array(
            'tokens.token' => $tkn, 
            'tokens.user_id' => $uid), 1);                         
               
        if($this->db->affected_rows() > 0){
            $row = $q->row();             
            
            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d'); 
            $todayTS = strtotime($today);
            
            if($createdTS != $todayTS){
                return false;
            }
            
            $user_info = $this->getUserInfo(NULL, $row->user_id);
            return $user_info;
            
        }else{
            return false;
        }
        
    }    
    
    public function getUserInfo($id = NULL, $screen = NULL)
    {
        if($id) {
            $q = $this->db->get_where('anggota', array('userid' => $id), 1);
            if($this->db->affected_rows() > 0){
                $row = $q->row();
                return $row;
            }else{
                error_log('no user found getUserInfo('.$id.')');
                return false;
            }
        } else {
            $q = $this->db->get_where('anggota', array('idscreen' => $screen), 1);
            if($this->db->affected_rows() > 0){
                $row = $q->row();
                return $row;
            }else{
                error_log('no user found getUserInfo('.$screen.')');
                return false;
            }
        }
    }

    public function getTemporaryPassword($id, $token)
    {
        $q = $this->db->get_where('tokens', array('token' => $token), 1);
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            return $row;
        }else{
            error_log('no user found getUserInfo('.$id.')');
            return false;
        }
    }
    
    public function updatePassword($post)
    {   
        $this->db->where('idscreen', $post['user_id']);
        $this->db->update('anggota', array('password' => $post['password'], 'active' => '1'));
        $success = $this->db->affected_rows(); 
        
        if(!$success){
            error_log('Unable to updatePassword('.$post['user_id'].')');
            return false;
        }        
        return true;
    } 

    public function isUserActive($id) {
        $q = $this->db->get_where('anggota', array('idscreen' => $id), 1);
        if($this->db->affected_rows() > 0){
            $row = $q->row();
            if($row->active) {
                return TRUE;
            } else {
                return FALSE;
            }
        }else{
            error_log('no user found getUserInfo('.$id.')');
            return false;
        }
    }
}
