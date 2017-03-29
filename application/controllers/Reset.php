<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller {

    public function index()
    {
        $data=array(
            'user'=> $this->m_login->ambil_user($this->session->userdata('userid')),
            'jumlah'=> $this->m_login->jumlahmdl(),
            'jumlahpd'=> $this->m_login->jumlahpd(),
            'jumlahall'=> $this->m_login->jumlahall()
        );
        $this->load->view('home/reset',$data);
    }
}