<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "3") {
			redirect('', 'refresh');
		}
		$this->load->model("owner/home_model");
	}

	public function index()
	{
		$apps = konfigurasi('Dashboard Owner');
		$datapage['manufacturing'] = $this->home_model->getProductionMemo()->Result();
		$data =  $apps + $datapage;
		$this->template->load('owner/layout/template', 'owner/dashboard',$data);

	}
}
