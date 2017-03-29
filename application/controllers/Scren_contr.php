<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Scren_contr extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Scren_mdl', 'scren_contr');
        //$this->load->model('Person_model');
    }

    public function index() {
        $session = $this->session->userdata('isLogin');
        if ($session == TRUE) {
            $data = array(
                'user' => $this->m_login->ambil_user($this->session->userdata('userid'))
                );
            $this->load->helper('url');
            $idscreen= $data['user']['idscreen'];
            $data['userss'] = $this->scren_contr->getalluser($idscreen);
            $data['xnilai'] = $this->scren_contr->ratarata();
            $this->load->view('biv/Scren_view', $data);
        } else {
            redirect('depan');
        }
    }

    public function ajax_list() {
        $list = $this->xtosera_contr->getalluser();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $xtosera_contr) {
            $no++;
            $row = array();
            $row[] = $xtosera_contr->first_name;
            $row[] = $xtosera_contr->ideatitle;
            $row[] = $xtosera_contr->ideatype;
            $row[] = $xtosera_contr->ideafile;
            $row[] = $xtosera_contr->ideadesc;
            $row[] = $xtosera_contr->totalidedesk;
            $row[] = '<a class="btn btn-md btn-danger" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $xtosera_contr->id . "'" . ')">Nilai</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->xtosera_contr->count_all(),
            "recordsFiltered" => $this->xtosera_contr->count_filtered(),
            "data" => $data,
            );

        echo json_encode($output);
    }

    public function ajax_edit($idrelation) {
        $data = $this->scren_contr->ambilin($idrelation);
        echo json_encode($data);
    }
    

    public function ajax_add() {
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

    public function ajax_update() {
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

    public function ajax_delete($id) {
        $this->person->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function save($idscreen) {
        $id = $this->input->post('id');
        //$ide1=$this->input->post('radioInline1');
        $scren = $this->input->post('scren');
        $ide1 = $this->input->post('radioInline1');
        $ide2 = $this->input->post('radioInline2');
        $desk1 = $this->input->post('radioInline3');
        $desk2 = $this->input->post('radioInline4');
        $desk3 = $this->input->post('radioInline5');
        $desk4 = $this->input->post('radioInline6');
        $desk5 = $this->input->post('radioInline7');
        $manf1 = $this->input->post('radioInline8');
        $manf2 = $this->input->post('radioInline9');
        $manf3 = $this->input->post('radioInline10');
        $manf4 = $this->input->post('radioInline11');
        $manf5 = $this->input->post('radioInline12');
        $totalidedesk = $this->input->post('totalidedesk');
        $totalmanfaat = $this->input->post('totalmanf');
        $totalmanf = round(($manf1 + $manf2 + $manf3 + $manf4 + $manf5) / 25 * 100);
        $total = round((($ide1 + $ide2) / 10 * 40) + (($desk1 + $desk2 + $desk3 + $desk4 + $desk5) / 25 * 60));
        $totalsem = ($totalmanfaat + $totalidedesk)  / 2;
        $data = array(
         'idpeserta' => $this->input->post('id'),
         'ide1' => $this->input->post('radioInline1'),
         'ide2' => $this->input->post('radioInline2'),
         'desk1' => $this->input->post('radioInline3'),
         'desk2' => $this->input->post('radioInline4'),
         'desk3' => $this->input->post('radioInline5'),
         'desk4' => $this->input->post('radioInline6'),
         'desk5' => $this->input->post('radioInline7'),
         'manf1' => $this->input->post('radioInline8'),
         'manf2' => $this->input->post('radioInline9'),
         'manf3' => $this->input->post('radioInline10'),
         'manf4' => $this->input->post('radioInline11'),
         'manf5' => $this->input->post('radioInline12'),
         'noteide' => $this->input->post('idenote'),
         'totalmanf' => $totalmanf,
         'totalidedesk' => $total,
         'totalall' => $totalsem
         );
        
        $query = $this->db->query("SELECT  idnilai,totalmanf FROM nilai WHERE idpeserta=$id");
        $temp = $query->result_array();
        $totalall = ($temp[0]['totalmanf'] + $total)  / 2;
        $data['totalall']=$totalall;

        if ($query->num_rows()  < 1) {
            $this->xtosera_contr->insertdata('nilai', $data);
        } else {
            $this->xtosera_contr->editdata('nilai', $data, 'idpeserta', $id);
        }
        $this->db->set(array('xnilai'=>$data['totalall'],'note'=>$data['noteide']))->where('idscreener',$scren)->where('idpeserta',$id)->update('screenrelation');
        echo json_encode(array("status" => TRUE));
    }

}