<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "2") {
			redirect('', 'refresh');
		}
		$this->load->model("staff/inventory_model");
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}

	public function index()
	{
		$data = array();

		//total rows count
		$totalRec = count($this->inventory_model->getRows());

		//pagination configuration
		$config['target']      = '#inventoryList';
		$config['base_url']    = base_url().'inventory/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		//get the posts data
		$datapage['inventory']    = $this->inventory_model->getRows(array('limit'=>$this->perPage));
		$conf                     = konfigurasi('Catatan Persediaan');
		$data                     = $datapage + $conf;
		$this->template->load('staff/layout/template', 'staff/inventory_page',$data);
	}

	public function ajaxPaginationData()
	{
		$conditions = array();
		
		//calc offset number
		$page = $this->input->post('page');
		if(!$page){
			$offset = 0;
		}else{
			$offset = $page;
		}
		
		//set conditions for search
		$keywords = $this->input->post('keywords');
		$sortBy   = $this->input->post('sortBy');
		$sortDate = $this->input->post('sortDate');
		if(!empty($keywords)){
			$conditions['search']['keywords'] = $keywords;
		}
		if(!empty($sortBy)){
			$conditions['search']['sortBy']   = $sortBy;
		}
		if(!empty($sortDate)){
			$conditions['search']['sortDate'] = $sortDate;
		}
		
		
		//total rows count
		$totalRec = count($this->inventory_model->getRows($conditions));
		
		//pagination configuration
		$config['target']      = '#inventoryList';
		$config['base_url']    = base_url().'inventory/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['inventory']  = $this->inventory_model->getRows($conditions);
		$this->load->view('staff/ajax_page/ajax_inventory_page', $data, false);     
		
	}

	

}
