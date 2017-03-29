<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topsera_contr extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Topsera_mdl','topsera_contr');
    }

    public function index()
    {
        $session = $this->session->userdata('isLogin');
        if ($session == TRUE) {
            $data = array(
                'user' => $this->m_login->ambil_user($this->session->userdata('userid'))
                );
            $this->load->helper('url');
            $data['userss'] = $this->topsera_contr->gettopi();
            $data['xnilai'] = $this->topsera_contr->ratarata();
            $user = $this->topsera_contr->gettopi();

            foreach ($user as $key => $value) {
                $xnilai = $this->topsera_contr->nilaibaru($value['idpeserta'])->row();
                $data['userss'][$key]['xnilai'] = $xnilai->xnilai;
            }
            //var_export($data['userss']);
            $data['prod'] = $this->topsera_contr->getprod();
            $data['iot'] = $this->topsera_contr->getiot();
            $data['level'] = $this->topsera_contr->getlevel();
            $this->load->view('biv/Topsera_view',$data);
        } else {
            redirect('depan');
        }
        
    }

    public function ajax_list()
    {
        $list = $this->topsera_contr->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $topsera_contr) {
            $no++;
            $row = array();
            $row[] = $topsera_contr->first_name;
            $row[] = $topsera_contr->email;
            $row[] = $topsera_contr->ideafile;
            $row[] = $topsera_contr->phone;

            
            $row[] = '<a href="http://localhost/new-ci/FinalBivLogin/pertama" class="waves btn btn-md btn-danger" href="javascript:void(0)" title="Edit" onclick="delete_person('."'".$topsera_contr->id."'".')">Accept</a>';
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->topsera_contr->count_all(),
            "recordsFiltered" => $this->topsera_contr->count_filtered(),
            "data" => $data,
            );
        
        echo json_encode($output);
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
        $this->topsera_contr->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
    public function updatestatus($id = NULL,$ideatype = NULL,$where = NULL,$data = NULL)
    {
        $cekbok = $this->input->post('checkboxInline1');
        $data = array(
            'id' => $this->input->post('id'),
            'top'=> $this->input->post('top'),
            'ideatype'=> $this->input->post('judul'),
            'phone'=> $this->input->post('scren'),
            'userid'=> $this->input->post('userid'),
            'idscreen'=> $this->input->post('screener'),
            'spe'=> $this->input->post('spe'),
            'spes'=> $this->input->post('spes'),
            'checkboxInline1' => $this->input->post('checkboxInline1'),
            );
        $this->db->set('top',$data['top'])->where('idpeserta',$data['id'])->update('nilai');
        foreach ($data['idscreen'] as $value)
        $this->db->set(array('idscreener'=>$value,'ideatype'=>$data['ideatype'],'idpeserta'=>$data['id']))->where('id',$data['id'])->insert('screentahap');

        // if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('nilai')->num_rows() == 0)
        // {
        //     $this->db->set(array('idpeserta'=>$data['id'],
        //      'status'=>$data['status']))->where('id',$data['id'])->insert('nilai');
        // }

        // if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('nilaitiga')->num_rows() == 0)
        // {
        //     $this->db->set(array('idpeserta'=>$data['id'],
        //      'status'=>$data['status']))->where('id',$data['id'])->insert('nilaitiga');
        // }

        // $this->db->set('status',$data['status'])->where('idpeserta',$data['id'])->update('lolos');

        // if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('screenrelation')->num_rows() == 0)
        // {
        //     foreach ($data['idscreen'] as $value)
        //     {
        //         $this->db->set(array('idscreener'=>$value,'ideatype'=>$data['ideatype'],'idpeserta'=>$data['id']))->where('id',$data['id'])->insert('screenrelation');
        //     }
        // }
        // else
        // {
        //     foreach ($data['idscreen'] as $value)
        //     {
        //         $this->db->set(array('idscreener'=>$value,'ideatype'=>$data['ideatype'],'idpeserta'=>$data['id']))->where('idpeserta',$data['id'])->insert('screenrelation');
        //     }
        // }
        echo json_encode($data);    
    }
    public function ajax_edit($id) {
            //$peserta = $this->lolos_contr->ambilin($id);
        $data = $this->topsera_contr->ambilin($id);
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
            'top'=> $this->input->post('top'),
            'ideatype'=> $this->input->post('judul'),
            'phone'=> $this->input->post('scren'),
            'userid'=> $this->input->post('userid'),
            'idscreen'=> $this->input->post('screener'),
            'checkboxInline1' => $this->input->post('checkboxInline1'),
            );
        $this->db->set('top',$data['top'])->where('idpeserta',$data['id'])->update('nilai');

        // if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('nilai')->num_rows() == 0)
        // {
        //     $this->db->set(array('idpeserta'=>$data['id'],
        //      'status'=>$data['status']))->where('id',$data['id'])->insert('nilai');
        // }else
        // {
        //     $this->db->select('idpeserta')->where('idpeserta',$data['id'])->delete('nilai');
        // }

        // if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('nilaitiga')->num_rows() == 0)
        // {
        //     $this->db->set(array('idpeserta'=>$data['id'],
        //      'status'=>$data['status']))->where('id',$data['id'])->insert('nilaitiga');
        // }else
        // {
        //     $this->db->select('idpeserta')->where('idpeserta',$data['id'])->delete('nilaitiga');
        // }


        // $this->db->set('status',$data['status'])->where('idpeserta',$data['id'])->update('lolos');

        // if($this->db->select('idpeserta')->where('idpeserta',$data['id'])->get('screenrelation')->num_rows() == 0)
        // {
        //     foreach ($data['idscreen'] as $value)
        //     {
        //         $this->db->set(array('idscreener'=>$value,'ideatype'=>$data['ideatype'],'idpeserta'=>$data['id']))->where('id',$data['id'])->insert('screenrelation');
        //     }
        // }
        // else
        // {
        //     $this->db->select('idpeserta')->where('idpeserta',$data['id'])->delete('screenrelation');
        // }
        echo json_encode($data);    
    }

}
