<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topfinal_contr extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Topfinal_mdl','topfinal_contr');
        //$this->load->model('Scren_mdl', 'scren_contr');
    }

    public function index()
    {
        $session = $this->session->userdata('isLogin');
        if ($session == TRUE) {
            $data = array(
                'user' => $this->m_login->ambil_user($this->session->userdata('userid'))
                );
            $this->load->helper('url');
            $data['userss'] = $this->topfinal_contr->gettop30user();
            $data['btnnilai'] = $this->topfinal_contr->btnnilai();
            $data['xnilai'] = $this->topfinal_contr->ratarata();
            $user = $this->topfinal_contr->gettop30user();
            foreach ($user as $key => $value) {
                $xnilai1 = $this->topfinal_contr->nilaibaru($value['idpeserta'])->row();
                $xnilai2 = $this->topfinal_contr->nilaianyar($value['idpeserta'])->row();
                $hasil = ($xnilai1->xnilai + $xnilai2->xnilai) / 2;
                $data['userss'][$key]['xnilai'] = $hasil;
            }
            $data['prod'] = $this->topfinal_contr->getprod();
            $data['iot'] = $this->topfinal_contr->getiot();
            $data['level'] = $this->topfinal_contr->getlevel();
            $this->load->view('biv/Topfinal_view',$data);
        } else {
            redirect('depan');
        }
        
    }

    public function ajax_list()
    {
        $list = $this->topfinal_contr->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $topfinal_contr) {
            $no++;
            $row = array();
            $row[] = $topfinal_contr->first_name;
            $row[] = $topfinal_contr->email;
            $row[] = $topfinal_contr->ideafile;
            $row[] = $topfinal_contr->phone;

            
            $row[] = '<a href="http://localhost/new-ci/FinalBivLogin/pertama" class="waves btn btn-md btn-danger" href="javascript:void(0)" title="Edit" onclick="delete_person('."'".$topfinal_contr->id."'".')">Accept</a>';
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->topfinal_contr->count_all(),
            "recordsFiltered" => $this->topfinal_contr->count_filtered(),
            "data" => $data,
            );
        
        echo json_encode($output);
    }
    public function updatestatus($id = NULL,$ideatype = NULL,$where = NULL,$data = NULL)
    {
        $cekbok = $this->input->post('checkboxInline1');
        $data = array(
            'id' => $this->input->post('id'),
            'stat' => $this->input->post('stat'),
            'tiga'=> $this->input->post('status'),
            'ideatype'=> $this->input->post('judul'),
            'phone'=> $this->input->post('scren'),
            'userid'=> $this->input->post('userid'),
            'skrin'=> $this->input->post('skrin'),
            'spe'=> $this->input->post('spe'),
            'spes'=> $this->input->post('spes'),
            'checkboxInline1' => $this->input->post('checkboxInline1'),
            );

        

        $this->db->set('tiga',$data['tiga'])->where('idpeserta',$data['id'])->update('nilai');

        
        echo json_encode($data);    
    }

    public function ajax_edit($id) {
            //$peserta = $this->lolos_contr->ambilin($id);
        $data = $this->topfinal_contr->ambilin($id);
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
        $this->topfinal_contr->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
