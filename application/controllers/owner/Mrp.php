<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

defined('BASEPATH') or exit('No direct script access allowed');

class Mrp extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "3") {
			redirect('', 'refresh');
		}
		$this->load->model("owner/mrp_model");
		$this->load->library('Ajax_pagination');
		$this->load->library('Crud_library');
		$this->perPage = 10;
	}

	public function index()
	{
		$data = array();

		//total rows count
		$totalRec = count($this->mrp_model->getRows());

		//pagination configuration
		$config['target']      = '#mrpList';
		$config['base_url']    = base_url().'mrp/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		//get the posts data
		$datapage['mrp_data']     = $this->mrp_model->getRows(array('limit'=>$this->perPage));
		$dataMO['mo_list']		  = $this->mrp_model->getMOlist()->Result();
		$conf                     = konfigurasi('Tabel MRP');
		$data                     = $datapage + $conf + $dataMO;
		$this->template->load('owner/layout/template', 'owner/mrp_page',$data);
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
		$sortBy   = $this->input->post('sortBy');
		$filterDate = $this->input->post('filterDate');
		if(!empty($sortBy)){
			$conditions['search']['sortBy']   = $sortBy;
		}
		if(!empty($filterDate)){
			$conditions['search']['filterDate'] = $filterDate;
		}
		
		
		//total rows count
		$totalRec = count($this->mrp_model->getRows($conditions));
		
		//pagination configuration
		$config['target']      = '#inventoryList';
		$config['base_url']    = base_url().'mrp/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['mrp_data']  = $this->mrp_model->getRows($conditions);
		$this->load->view('owner/ajax_page/ajax_mrp_page', $data, false);     
		
	}

	public function getDateTime()
	{
		$format = date("d-m-Y");
		return $format;
	}

	public function newmrp()
	{
		$data                 = konfigurasi('Tetapkan MRP Baru');
		$autocode['no_mrp']   = $this->mrp_model->getMRP_ID();
		$dataMO['mo_list']    = $this->mrp_model->getMOlist()->Result();
		$date['getDate']      = $this->getDateTime();
		$alldata              = $data + $autocode + $date + $dataMO;
		$this->template->load('owner/layout/template', 'owner/create_mrp', $alldata);
	}

	public function showitemproductmrp()
	{

		$selmo_code = $this->input->post('selmo_code'); 
		$data       = $this->mrp_model->getProductList($selmo_code)->Result();
		echo json_encode($data);

	}
	
	public function showproductmrp2()
	{
		
		$selmo_code = $this->input->post('selmo_code');
		if(!empty($selmo_code)){
			$conditions = $selmo_code;
		}
		
		$data['item_product']  = $this->mrp_model->getproduct2($conditions);
		
		$this->load->view('owner/ajax_create_mrp', $data, false);    
	}


	public function showmaterial()
	{
		$sel_prod = $this->input->post('sel_prod');
		if(!empty($sel_prod)){
			$conditions = $sel_prod;
		}
		$selmo_code = $this->input->post('selmo_code'); 

		$data['item_material']              = $this->mrp_model->getmaterial($conditions)->result_array();
		$data['item_material_of_product']   = $this->mrp_model->getmaterial($conditions)->Row();
		$data['detail_mo1']                 = $this->mrp_model->getProductList($selmo_code)->Row();
		$data['detail_mo2']                 = $this->mrp_model->getdetmanufacturing($selmo_code,$sel_prod)->Row();

		$this->load->view('owner/ajax_page/ajax_new_mrp', $data, false);  
	}



	public function showdetmanufacturing()
	{

		$selmo_code   = $this->input->post('selmo_code');
		$sel_prod     = $this->input->post('sel_prod');
		$data         = $this->mrp_model->getdetmanufacturing($selmo_code,$sel_prod)->Result();
		echo json_encode($data);

	}

	public function savemrp()
	{
		$crudlibrary    = $this->crud_library;
		$validation     = $this->form_validation;
		$validation->set_rules($crudlibrary->mrp_save()); 


		if ($validation->run()) {

			$this->db->trans_start();
			$this->mrp_model->insertmrp();
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('owner/manufacturing');
			} else {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('owner/mrp'); 
			} 
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('owner/mrp/newmrp'); 
		}
	}

	public function showdetailmrp($mrp_code = null)
	{
		if (!isset($mrp_code)) 
		{
			redirect('owner/mrp');
		}
		$valuearray['mrp_array'] = $this->mrp_model->getdetailMRP($mrp_code)->Result();
		$value['mrp_data']       = $this->mrp_model->getdetailMRP($mrp_code)->Row();
		if (!$valuearray['mrp_array'] && !$value['mrp_data']) 
		{
			show_404();
		}
		$conf                              = konfigurasi('Detail MRP');
		$data                              = $value + $conf + $valuearray;
		$this->template->load('owner/layout/template', 'owner/detail_mrp_page', $data);

	}

	public function showRecapPorel($mo_id = null)
	{
		if (!isset($mo_id)) 
		{
			redirect('owner/mrp');
		}
		$valuearray1['mrp_array1'] = $this->mrp_model->getrecapMRP($mo_id)->Result();
		$valuearray2['mrp_array2']       = $this->mrp_model->getproductrecapMRP($mo_id)->Result();
		$value['mrp_data']       = $this->mrp_model->getproductrecapMRP($mo_id)->Row();
		if (!$valuearray1['mrp_array1'] && !$valuearray2['mrp_array2']) 
		{
			show_404();
		}
		$conf                              = konfigurasi('Rekap Planned Order Releases');
		$data                              = $valuearray1 + $conf + $valuearray2 + $value;
		$this->template->load('owner/layout/template', 'owner/planned_order_releases', $data);

	}


	public function ActdeleteMRP($mrp_id = null)
	{
		if (!isset($mrp_id)) 
		{
			show_404();
		}

		if ($this->mrp_model->deleteMRP($mrp_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil dihapus.'));
			redirect(site_url('owner/mrp'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal dihapus.'));
			redirect(site_url('owner/mrp'));
		}

	}

	public function pdfrecapMRP($mo_id = null)
	{
		if (!isset($mo_id)) 
		{
			redirect('owner/mrp');
		}
		$valuearray1['mrp_array1']  = $this->mrp_model->getrecapMRP($mo_id)->Result();
		$valuearray2['mrp_array2']  = $this->mrp_model->getproductrecapMRP($mo_id)->Result();
		$value['mrp_data']          = $this->mrp_model->getproductrecapMRP($mo_id)->Row();
		
		$data                              = $valuearray1 + $valuearray2 + $value;

		$this->load->library('pdfgenerator');
		$this->pdfgenerator->setPaper('A4', 'landscape');
		$this->pdfgenerator->filename = "recap-porel-mrp.pdf";
		$this->pdfgenerator->load_view('owner/PDF_reporting/recap_porel_pdf', $data);
	}


}
