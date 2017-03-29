<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Limatotiga_contr extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Limatotiga_mdl','limatotiga_contr');
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
			$data['userss'] = $this->limatotiga_contr->gettop30user();
			$data['xnilai'] = $this->scren_contr->ratarata();
			$user = $this->limatotiga_contr->gettop30user();
			foreach ($user as $key => $value) {
                $xnilai1 = $this->limatotiga_contr->nilaibaru($value['idpeserta'])->row();
                $xnilai2 = $this->limatotiga_contr->nilaianyar($value['idpeserta'])->row();
                $hasil = ($xnilai1->xnilai + $xnilai2->xnilai) / 2;
                $data['userss'][$key]['xnilai'] = $hasil;
            }
			$this->load->view('biv/Limatotiga_view',$data);
		} else {
			redirect('depan');
		}
		
	}

	public function ajax_list()
	{
		$list = $this->limatotiga_contr->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $limatotiga_contr) {
			$no++;
			$row = array();
			$row[] = $limatotiga_contr->first_name;
			$row[] = $limatotiga_contr->email;
			$row[] = $limatotiga_contr->ideafile;
			$row[] = $limatotiga_contr->phone;

			
			$row[] = '<a href="http://localhost/new-ci/FinalBivLogin/pertama" class="waves btn btn-md btn-danger" href="javascript:void(0)" title="Edit" onclick="delete_person('."'".$limatotiga_contr->id."'".')">Accept</a>';
			
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->limatotiga_contr->count_all(),
			"recordsFiltered" => $this->limatotiga_contr->count_filtered(),
			"data" => $data,
			);
		
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->person->get_by_id($id);
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
		$this->limatotiga_contr->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}
