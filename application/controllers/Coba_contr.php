<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coba_contr extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Coba_mdl', 'coba_contr');
    }
    public function index()
    {
        $session = $this->session->userdata('isLogin');
        if ($session == TRUE) {
        $data=array(
            'user'=> $this->m_login->ambil_user($this->session->userdata('userid'))
            );
        $this->load->helper('url');
        $data['userss'] = $this->coba_contr->getsemua();
        $data['prod'] = $this->coba_contr->getprod();
        $data['iot'] = $this->coba_contr->getiot();
        $this->load->view('biv/Coba_view', $data);
        } else {
            redirect('/');
        }

    }
    public function tolakin($id = NULL,$ideatype = NULL,$where = NULL,$data = NULL)
    {
        $data = array(
            'id' => $this->input->post('id'),
            'stat' => $this->input->post('stat'),
            'status'=> $this->input->post('status'),
            'ideatype'=> $this->input->post('judul'),
            'phone'=> $this->input->post('scren'),
            'userid'=> $this->input->post('userid'),
            'skrin'=> $this->input->post('skrin'),
            'spe'=> $this->input->post('spe'),
            'spes'=> $this->input->post('spes'),
            'checkboxInline1' => $this->input->post('checkboxInline1'),
            );
        $this->db->set('accep',$data['status'])->where('id',$data['id'])->update('users');
    }
    public function updatestatus($id = NULL,$ideatype = NULL,$where = NULL,$data = NULL)
    {
        $cekbok = $this->input->post('checkboxInline1');
        $data = array(
            'id' => $this->input->post('id'),
            'stat' => $this->input->post('stat'),
            'status'=> $this->input->post('status'),
            'ideatype'=> $this->input->post('judul'),
            'phone'=> $this->input->post('scren'),
            'userid'=> $this->input->post('userid'),
            'skrin'=> $this->input->post('skrin'),
            'spe'=> $this->input->post('spe'),
            'spes'=> $this->input->post('spes'),
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

        if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('lolos')->num_rows() == 0)
        {
            $this->db->set(array('idpeserta'=>$data['id'],
               'status'=>$data['status'],'acc'=>$data['stat']))->where('id',$data['id'])->insert('lolos');
        }
        else
        {
            $this->db->select('idpeserta')->where('idpeserta',$data['id'])->delete('lolos');
        }

        if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('nilaitiga')->num_rows() == 0)
        {
            $this->db->set(array('idpeserta'=>$data['id'],
               'status'=>$data['status']))->where('id',$data['id'])->insert('nilaitiga');
        }

        $this->db->set('status',$data['status'])->where('id',$data['id'])->update('users');

        if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('screenrelation')->num_rows() == 0)
        {
            foreach ($data['idscreen'] as $value)
            {
                $this->db->set(array('idscreener'=>$value,'ideatype'=>$data['ideatype'],'idpeserta'=>$data['id']))->where('id',$data['id'])->insert('screenrelation');
            }
        }
        echo json_encode($data);    
    }

    public function lihat($id)
    {
        $data = $this->coba_contr->get_by_id($id);
        echo json_encode($data);
    }
    public function ajax_edit($id) {
        $data = $this->coba_contr->ambilin($id);
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


        $this->db->set('status',$data['status'])->where('id',$data['id'])->update('users');

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

    public function screened() {
        $userid = $this->input->post('user');
        $ideaid = $this->input->post('idea');
        $status = $this->input->post('status');
        $postdate = date("Y/m/d H:i:s");
        $data = array(
            'user_id' => $userid,
            'idea_id' => $ideaid,
            'status' => $status,
            'postdate' => $postdate
        );
        echo json_encode(array(
            'status' => 'screened',
            'postData' => $data
        ));
    }
}