<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topip_contr extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Topip_mdl','topip_contr');
        $this->load->model('Scren_mdl', 'scren_contr');
    }

    public function index()
    {
        $session = $this->session->userdata('isLogin');
        if ($session == TRUE) {
            $data = array(
                'user' => $this->m_login->ambil_user($this->session->userdata('userid'))
                );
            $this->load->helper('url');
            $data['userss'] = $this->topip_contr->gettop30user();
            $user = $this->topip_contr->gettop30user();
            foreach ($user as $key => $value) {
                $xnilai = $this->topip_contr->nilaibaru($value['idpeserta'])->row();
                $data['userss'][$key]['xnilai'] = $xnilai->xnilai;
            }
            $data['xnilai'] = $this->scren_contr->ratarata();
            $data['prod'] = $this->topip_contr->getprod();
            $data['iot'] = $this->topip_contr->getiot();
            $data['level'] = $this->topip_contr->getlevel();
            $this->load->view('biv/Topip_view',$data);
        } else {
            redirect('depan');
        }
        
    }

    public function ajax_list()
    {
        $list = $this->topip_contr->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $topip_contr) {
            $no++;
            $row = array();
            $row[] = $topip_contr->first_name;
            $row[] = $topip_contr->email;
            $row[] = $topip_contr->ideafile;
            $row[] = $topip_contr->phone;

            
            $row[] = '<a href="http://localhost/new-ci/FinalBivLogin/pertama" class="waves btn btn-md btn-danger" href="javascript:void(0)" title="Edit" onclick="delete_person('."'".$topip_contr->id."'".')">Accept</a>';
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->topip_contr->count_all(),
            "recordsFiltered" => $this->topip_contr->count_filtered(),
            "data" => $data,
            );
        
        echo json_encode($output);
    }

    public function ajax_edit($id) {
            //$peserta = $this->lolos_contr->ambilin($id);
        $data = $this->topip_contr->ambilin($id);
            //$data['peserta'] = $this->lolos_contr->ambilin($id);
            //var_export($data);
            // $data['skrin'] = $this->lolos_contr->scrin($peserta->idscreener);

        echo json_encode($data);
    }

    public function ajax_add()
    {
        $data = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'dob' => $this->input->post('dob'),
            );
        $insert = $this->person->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $data = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'gender' => $this->input->post('gender'),
            'address' => $this->input->post('address'),
            'dob' => $this->input->post('dob'),
            );
        $this->person->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->topip_contr->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
