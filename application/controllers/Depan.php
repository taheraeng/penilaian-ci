<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depan extends CI_Controller {

	public function index()
	{
		$data=array(
			'user'=> $this->m_login->ambil_user($this->session->userdata('userid')),
			'jumlahiot'=> $this->m_login->jumlahiot(),
            'jumlahiotgb'=> $this->m_login->jumlahiotgb(),
			'jumlahpd'=> $this->m_login->jumlahpd(),
            'jumlahiotpd'=> $this->m_login->jumlahiotpd(),
			'jumlahall'=> $this->m_login->jumlahall()
			);

        if($this->session->userdata('isLogin')) {
            if($this->session->userdata('active')) {
                $this->load->view('home/Index', $data);
            } else {
                $this->session->set_flashdata('flash_message', 'Ini adalah login pertama, untuk keamanan silahkan reset password Anda');
                redirect('akun/reset');
            }
        } else {
            $this->load->view('home/Index',$data);
        }
	}
}
