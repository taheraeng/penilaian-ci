<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_contr extends CI_Controller {

	public function index()
	{
		$this->load->view('home/Reset');
	}
}
