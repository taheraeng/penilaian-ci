<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topiot_contr extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Topiot_mdl','topiot_contr');
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
            $data['userss'] = $this->topiot_contr->gettop30user();
            $user = $this->topiot_contr->gettop30user();
            foreach ($user as $key => $value) {
                $xnilai = $this->topiot_contr->nilaibaru($value['idpeserta'])->row();
                $data['userss'][$key]['xnilai'] = $xnilai->xnilai;
            }
            $data['xnilai'] = $this->scren_contr->ratarata();
            $data['prod'] = $this->topiot_contr->getprod();
            $data['iot'] = $this->topiot_contr->getiot();
            $data['level'] = $this->topiot_contr->getlevel();
            $this->load->view('biv/Topiot_view',$data);
        } else {
            redirect('depan');
        }
        
    }

    public function ajax_list()
    {
        $list = $this->topiot_contr->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $topiot_contr) {
            $no++;
            $row = array();
            $row[] = $topiot_contr->first_name;
            $row[] = $topiot_contr->email;
            $row[] = $topiot_contr->ideafile;
            $row[] = $topiot_contr->phone;

            
            $row[] = '<a href="http://localhost/new-ci/FinalBivLogin/pertama" class="waves btn btn-md btn-danger" href="javascript:void(0)" title="Edit" onclick="delete_person('."'".$topiot_contr->id."'".')">Accept</a>';
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->topiot_contr->count_all(),
            "recordsFiltered" => $this->topiot_contr->count_filtered(),
            "data" => $data,
            );
        
        echo json_encode($output);
    }

    public function ajax_edit($id) {
            //$peserta = $this->lolos_contr->ambilin($id);
        $data = $this->topiot_contr->ambilin($id);
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
        $this->topiot_contr->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
