<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "2") {
			redirect('', 'refresh');
		}
		$this->load->model("staff/home_model");
	}

	public function index()
	{
		$apps = konfigurasi('Dashboard');
		$datapage['manufacturing'] = $this->home_model->getProductionMemo()->Result();
		$data =  $apps + $datapage;
		$this->template->load('staff/layout/template', 'staff/dashboard',$data);

	}
}
