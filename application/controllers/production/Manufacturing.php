<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

defined('BASEPATH') or exit('No direct script access allowed');

class Manufacturing extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "1") {
			redirect('', 'refresh');
		}
		$this->load->model("production/manufacturing_model");
		$this->load->library('Ajax_pagination');
		$this->load->library('Crud_library');
		$this->perPage = 10;
	}

	public function index()
	{
		$data = array();

		//total rows count
		$totalRec = count($this->manufacturing_model->getRows());

		//pagination configuration
		$config['target']      = '#manufacturingList';
		$config['base_url']    = base_url().'manufacturing/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		//get the posts data
		$datapage['manufacturing'] = $this->manufacturing_model->getRows(array('limit'=>$this->perPage));
		$conf                      = konfigurasi('Pesanan Produksi');
		$data                      = $datapage + $conf;
		$this->template->load('production/layout/template', 'production/manufacturing_page',$data);
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
		$filterBy = $this->input->post('filterBy');
		if(!empty($keywords)){
			$conditions['search']['keywords'] = $keywords;
		}
		if(!empty($sortBy)){
			$conditions['search']['sortBy']   = $sortBy;
		}
		if(!empty($filterBy)){
			$conditions['search']['filterBy'] = $filterBy;
		}
		
		//total rows count
		$totalRec = count($this->manufacturing_model->getRows($conditions));
		
		//pagination configuration
		$config['target']      = '#manufacturingList';
		$config['base_url']    = base_url().'manufacturing/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['manufacturing']  = $this->manufacturing_model->getRows($conditions);
		
		$this->load->view('production/ajax_page/ajax_manufacturing_order', $data, false);     
		
	}


	function getDateTime()
	{

		$format = date("d-m-Y");
		return $format;
	}

	public function showproduct()
	{
		$product_sku = $this->input->post('product_sku');
		$data = $this->manufacturing_model->getProductAjax($product_sku)->Result();
		echo json_encode($data);

	}

	public function showitemproduct()
	{
		$mo_id       = $_POST['mo_id'];
		$data['item_product']  = $this->manufacturing_model->getItemProduct($mo_id)->result_array();
		$this->load->view('production/modal_view/modal_view_item_product', $data);
	}

	public function newmanufacturing()
	{
		$data                      = konfigurasi('Pesanan Produksi Baru');
		$autocode['mo_code']       = $this->manufacturing_model->getMO_ID();
		$datacust['customer']      = $this->manufacturing_model->getCustomer()->Result();
		$dataprod['product_list']  = $this->manufacturing_model->getProduct()->Result();
		$date['getDate']           = $this->getDateTime();
		$alldata                   = $data + $autocode + $datacust + $dataprod + $date;
		$this->template->load('production/layout/template', 'production/create_manufacturing', $alldata);
	}

	public function addmanufacturingorder()
	{
		$crudlibrary    = $this->crud_library;
		$validation     = $this->form_validation;
		$validation->set_rules($crudlibrary->manufacturing_order_save()); 


		if ($validation->run()) {

			$this->db->trans_start();
			$this->manufacturing_model->savemanufacturingorder();
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('production/manufacturing');
			} else {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('production/manufacturing'); 
			} 
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('production/manufacturing/newmanufacturing'); 
		}


	}

	public function editmanufacturing($mo_id = null)
	{
		if (!isset($mo_id)) 
		{
			redirect('production/manufacturing');
		}
		$valuearray['mo_array'] = $this->manufacturing_model->getById($mo_id)->Result();
		$value['mo_list']       = $this->manufacturing_model->getById($mo_id)->Row();
		if (!$valuearray['mo_array']) 
		{
			show_404();
		}
		$conf                      = konfigurasi('Detail Pesanan Produksi');
		$datacust['customer']      = $this->manufacturing_model->getCustomer()->Result();
		$dataprod['product_list']  = $this->manufacturing_model->getProduct()->Result();
		$data                      = $conf + $datacust + $valuearray + $dataprod + $value;
		$this->template->load('production/layout/template', 'production/edit_manufacturing', $data);

	}

	public function actupdateMO()
	{
		$crudlibrary    = $this->crud_library;
		$validation     = $this->form_validation;
		$validation->set_rules($crudlibrary->manufacturing_order_update()); 


		if ($validation->run()) {

			$this->db->trans_start();
			$this->manufacturing_model->updateMO();
			$this->manufacturing_model->deleteforupdate();
			$this->manufacturing_model->insertforupdate();
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('production/manufacturing');
			} else {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('production/manufacturing'); 
			} 
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('production/manufacturing/newmanufacturing'); 
		}


	}


	public function UpdateStatusStart($mo_id = null)
	{
		if (!isset($mo_id)) 
		{
			show_404();
		}

		if ($this->manufacturing_model->StatusStart($mo_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil diperbarui.'));
			redirect(site_url('production/manufacturing'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal diperbarui.'));
			redirect(site_url('production/manufacturing'));
		}

	}

	public function UpdateStatusDone($mo_id = null)
	{
		if (!isset($mo_id)) 
		{
			show_404();
		}

		if ($this->manufacturing_model->StatusDone($mo_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil diperbarui.'));
			redirect(site_url('production/manufacturing'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal diperbarui.'));
			redirect(site_url('production/manufacturing'));
		}

	}

	public function UpdateStatusReject($mo_id = null)
	{
		if (!isset($mo_id)) 
		{
			show_404();
		}

		if ($this->manufacturing_model->StatusReject($mo_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil diperbarui.'));
			redirect(site_url('production/manufacturing'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal diperbarui.'));
			redirect(site_url('production/manufacturing'));
		}

	}
	public function UpdateStatusNotStart($mo_id = null)
	{
		if (!isset($mo_id)) 
		{
			show_404();
		}

		if ($this->manufacturing_model->StatusNotStart($mo_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil diperbarui.'));
			redirect(site_url('production/manufacturing'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal diperbarui.'));
			redirect(site_url('production/manufacturing'));
		}

	}

	public function pdfinvoiceMO($mo_id = null)
	{
		
		if (!isset($mo_id)) 
		{
			redirect('production/manufacturing');
		}
		$valuearray['mo_array'] = $this->manufacturing_model->getById($mo_id)->Result();
		$value['mo_list']       = $this->manufacturing_model->getById($mo_id)->Row();
		if (!$valuearray['mo_array']) 
		{
			show_404();
		}
		$datacust['customer']      = $this->manufacturing_model->getCustomer()->Result();
		$dataprod['product_list']  = $this->manufacturing_model->getProduct()->Result();
		$data                      = $datacust + $valuearray + $dataprod + $value;

		$this->load->library('pdfgenerator');
		$this->pdfgenerator->setPaper('A4', 'landscape');
		$this->pdfgenerator->filename = "manufacturing_invoice.pdf";
		$this->pdfgenerator->load_view('production/PDF_reporting/invoice_manufacturing_pdf', $data);
	}

	public function ActdeleteMO($mo_id = null)
	{
		if (!isset($mo_id)) 
		{
			show_404();
		}

		if ($this->manufacturing_model->deleteMO($mo_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil dihapus.'));
			redirect(site_url('production/purchase_order'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal dihapus.'));
			redirect(site_url('production/purchase_order'));
		}

	}

}
