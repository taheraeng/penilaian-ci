<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lolos_contr extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Lolos_mdl', 'lolos_contr');
    }
    public function index() {
        $session = $this->session->userdata('isLogin');
        if ($session == TRUE) {
            $data = array(
                'user' => $this->m_login->ambil_user($this->session->userdata('userid'))
                );
            $this->load->helper('url');
            $data['userss'] = $this->lolos_contr->getsemua();
            $data['prod'] = $this->lolos_contr->getprod();
            $data['iot'] = $this->lolos_contr->getiot();
            $this->load->view('biv/Lolos_view', $data);
        } else {
            redirect('depan');
        }
    }
    public function updatestatus($id = NULL,$ideatype = NULL,$where = NULL,$data = NULL)
    {
        $cekbok = $this->input->post('checkboxInline1');
        $data = array(
            'id' => $this->input->post('id'),
            'status'=> $this->input->post('status'),
            'ideatype'=> $this->input->post('judul'),
            'phone'=> $this->input->post('scren'),
            'userid'=> $this->input->post('userid'),
            'idscreen'=> $this->input->post('screener'),
            'spe'=> $this->input->post('spe'),
            'spes'=> $this->input->post('spes'),
            'checkboxInline1' => $this->input->post('checkboxInline1'),
            );

        if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('nilai')->num_rows() == 0)
        {
            $this->db->set(array('idpeserta'=>$data['id'],
             'status'=>$data['status']))->where('id',$data['id'])->insert('nilai');
        }

        if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('nilaitiga')->num_rows() == 0)
        {
            $this->db->set(array('idpeserta'=>$data['id'],
             'status'=>$data['status']))->where('id',$data['id'])->insert('nilaitiga');
        }

        $this->db->set('status',$data['status'])->where('idpeserta',$data['id'])->update('lolos');

        if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('screenrelation')->num_rows() == 0)
        {
            foreach ($data['idscreen'] as $value)
            {
                $this->db->set(array('idscreener'=>$value,'ideatype'=>$data['ideatype'],'idpeserta'=>$data['id']))->where('id',$data['id'])->insert('screenrelation');
            }
        }
        // else
        // {
        //     foreach ($data['idscreen'] as $value)
        //     {
        //         $this->db->set(array('idscreener'=>$value,'ideatype'=>$data['ideatype'],'idpeserta'=>$data['id']))->where('idpeserta',$data['id'])->insert('screenrelation');
        //     }
        // }
        echo json_encode($data);    
    }

    public function lihat($id)
    {
        $data = $this->lolos_contr->get_by_id($id);
        echo json_encode($data);
    }
    public function ajax_edit($id) {
            //$peserta = $this->lolos_contr->ambilin($id);
        $data = $this->lolos_contr->ambilin($id);
            //$data['peserta'] = $this->lolos_contr->ambilin($id);
            //var_export($data);
            // $data['skrin'] = $this->lolos_contr->scrin($peserta->idscreener);

        echo json_encode($data);
    }


    public function updatecntr($id = NULL,$ideatype = NULL,$where = NULL,$data = NULL)
    {
        $cekbok = $this->input->post('checkboxInline1');
        $data = array(
            'id' => $this->input->post('id'),
            'status'=> $this->input->post('status'),
            'ideatype'=> $this->input->post('judul'),
            'phone'=> $this->input->post('scren'),
            'userid'=> $this->input->post('userid'),
            'idscreen'=> $this->input->post('screener'),
            'checkboxInline1' => $this->input->post('checkboxInline1'),
            );

        if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('nilai')->num_rows() == 0)
        {
            $this->db->set(array('idpeserta'=>$data['id'],
             'status'=>$data['status']))->where('id',$data['id'])->insert('nilai');
        }else
        {
            $this->db->select('idpeserta')->where('idpeserta',$data['id'])->delete('nilai');
        }

        if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('nilaitiga')->num_rows() == 0)
        {
            $this->db->set(array('idpeserta'=>$data['id'],
             'status'=>$data['status']))->where('id',$data['id'])->insert('nilaitiga');
        }else
        {
            $this->db->select('idpeserta')->where('idpeserta',$data['id'])->delete('nilaitiga');
        }


        $this->db->set('status',$data['status'])->where('idpeserta',$data['id'])->update('lolos');

        if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('screenrelation')->num_rows() == 0)
        {
            foreach ($data['idscreen'] as $value)
            {
                $this->db->set(array('idscreener'=>$value,'ideatype'=>$data['ideatype'],'idpeserta'=>$data['id']))->where('id',$data['id'])->insert('screenrelation');
            }
        }
        else
        {
            $this->db->select('idpeserta')->where('idpeserta',$data['id'])->delete('screenrelation');
        }
        echo json_encode($data);    
    }
}