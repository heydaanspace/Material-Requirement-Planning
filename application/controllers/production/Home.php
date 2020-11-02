<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "1") {
			redirect('', 'refresh');
		}
		$this->load->model("production/home_model");
	}

	public function index()
	{
		$apps = konfigurasi('Dashboard');
		$datapage['manufacturing'] = $this->home_model->getProductionMemo()->Result();
		//$data['item_product']  = $this->manufacturing_model->getItemProduct($mo_id)->result_array();
		$data =  $apps + $datapage;
		$this->template->load('production/layout/template', 'production/dashboard',$data);

	}
}
