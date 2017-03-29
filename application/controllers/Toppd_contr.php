<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Toppd_contr extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Toppd_mdl','toppd_contr');
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
            $data['userss'] = $this->toppd_contr->gettop30user();
            $data['btnnilai'] = $this->toppd_contr->btnnilai();
            $data['xnilai'] = $this->toppd_contr->ratarata();
            $user = $this->toppd_contr->gettop30user();
            foreach ($user as $key => $value) {
                $xnilai = $this->toppd_contr->nilaibaru($value['idpeserta'])->row();
                $data['userss'][$key]['xnilai'] = $xnilai->xnilai;
            }
            $data['prod'] = $this->toppd_contr->getprod();
            $data['iot'] = $this->toppd_contr->getiot();
            $data['level'] = $this->toppd_contr->getlevel();
            $this->load->view('biv/Toppd_view',$data);
        } else {
            redirect('depan');
        }
        
    }

    public function ajax_list()
    {
        $list = $this->toppd_contr->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $toppd_contr) {
            $no++;
            $row = array();
            $row[] = $toppd_contr->first_name;
            $row[] = $toppd_contr->email;
            $row[] = $toppd_contr->ideafile;
            $row[] = $toppd_contr->phone;

            
            $row[] = '<a href="http://localhost/new-ci/FinalBivLogin/pertama" class="waves btn btn-md btn-danger" href="javascript:void(0)" title="Edit" onclick="delete_person('."'".$toppd_contr->id."'".')">Accept</a>';
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->toppd_contr->count_all(),
            "recordsFiltered" => $this->toppd_contr->count_filtered(),
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
        $data = $this->toppd_contr->ambilin($id);
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
        $this->toppd_contr->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

}
