<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

defined('BASEPATH') or exit('No direct script access allowed');

class Purchase_order extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "1") {
			redirect('', 'refresh');
		}
		$this->load->model("production/purchase_order_model");
		$this->load->library('Ajax_pagination');
		$this->load->library('Crud_library');
		$this->perPage = 10;
	}

	public function index()
	{
		$data = array();

		//total rows count
		$totalRec = count($this->purchase_order_model->getRows());

		//pagination configuration
		$config['target']      = '#poList';
		$config['base_url']    = base_url().'purchase_order/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		//get the posts data
		$datapage['po_list']      = $this->purchase_order_model->getRows(array('limit'=>$this->perPage));
		$conf                     = konfigurasi('Daftar Pesanan Pembelian');
		$data                     = $datapage + $conf;
		$this->template->load('production/layout/template', 'production/purchase_order_page',$data);
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
		$filterBy = $this->input->post('filterBy');
		if(!empty($sortBy)){
			$conditions['search']['sortBy'] = $sortBy;
		}
		if(!empty($filterBy)){
			$conditions['search']['filterBy'] = $filterBy;
		}
		
		
		//total rows count
		$totalRec = count($this->purchase_order_model->getRows($conditions));
		
		//pagination configuration
		$config['target']      = '#poList';
		$config['base_url']    = base_url().'purchase_order/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['po_list']  = $this->purchase_order_model->getRows($conditions);
		
		$this->load->view('production/ajax_page/ajax_purchase_order_page', $data, false);     
		
	}

	public function newpo()
	{
		$data                      = konfigurasi('Pesanan Pembelian Baru');
		$autocode['po_code']       = $this->purchase_order_model->getPO_ID();
		$datasupplier['supplier']  = $this->purchase_order_model->getSupplier()->Result();
		$datamaterial['material_list']  = $this->purchase_order_model->getitemMaterial()->Result();
		$alldata                   = $data + $autocode + $datasupplier + $datamaterial;
		$this->template->load('production/layout/template', 'production/create_po', $alldata);
	}

	public function showmaterialAjax()
	{
		$inv_id = $this->input->post('inv_id');
		$data = $this->purchase_order_model->getitemMaterialAjax($inv_id)->Result();
		echo json_encode($data);

	}

	public function showitemPO()
	{
		$po_id            = $_POST['po_id'];
		$data['item_po']  = $this->purchase_order_model->getItemPO($po_id)->result_array();
		$this->load->view('production/modal_view/modal_view_item_po', $data);
	}

	public function savepo()
	{
		$crudlibrary    = $this->crud_library;
		$validation     = $this->form_validation;
		$validation->set_rules($crudlibrary->po_save()); 


		if ($validation->run()) {

			$this->db->trans_start();
			$this->purchase_order_model->insertpo();
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('production/purchase_order');
			} else {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('production/purchase_order'); 
			} 
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('production/purchase_order/newpo'); 
		}
	}

	public function showdetailPO($po_id = null)
	{
		if (!isset($po_id)) 
		{
			redirect('production/purchase_order');
		}
		$valuearray['po_array'] = $this->purchase_order_model->getItemPO($po_id)->Result();
		$value['po_data']       = $this->purchase_order_model->getItemPO($po_id)->Row();
		if (!$valuearray['po_array'] && !$value['po_data']) 
		{
			show_404();
		}
		$conf                              = konfigurasi('Detail Pesanan Pembelian');
		$datasupplier['supplier']          = $this->purchase_order_model->getSupplier()->Result();
		$datamaterial['material_list']  = $this->purchase_order_model->getitemMaterial()->Result();
		$data                              = $value + $conf + $valuearray + $datasupplier + $datamaterial;
		$this->template->load('production/layout/template', 'production/detail_po_page', $data);

	}

	public function updatePO()
	{
		$crudlibrary    = $this->crud_library;
		$validation     = $this->form_validation;
		$validation->set_rules($crudlibrary->po_save()); 

		if ($validation->run()) {
			$this->db->trans_start();
			$this->purchase_order_model->updatePO();
			$this->purchase_order_model->deleteforupdate();
			$this->purchase_order_model->insertforupdate();
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('production/purchase_order');
			} else {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('production/purchase_order'); 
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('production/purchase_order/newpo'); 
		}

	}

	public function ActdeletePO($po_id = null)
	{
		if (!isset($po_id)) 
		{
			show_404();
		}

		if ($this->purchase_order_model->deletePO($po_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil dihapus.'));
			redirect(site_url('production/purchase_order'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal dihapus.'));
			redirect(site_url('production/purchase_order'));
		}

	}

	public function newpo_mrp($mrp_id = null)
	{
		if (!isset($mrp_id)) 
		{
			redirect('production/mrp');
		}
		$valuearray['mrp_array'] = $this->purchase_order_model->getpoMRP($mrp_id)->Result();
		$value['mrp_data']       = $this->purchase_order_model->getpoMRP($mrp_id)->Row();
		if (!$valuearray['mrp_array'] && !$value['mrp_data']) 
		{
			show_404();
		}
		$autocode['po_code']       = $this->purchase_order_model->getPO_ID();
		$datasupplier['supplier']  = $this->purchase_order_model->getSupplier()->Result();
		$datamaterial['material_list']  = $this->purchase_order_model->getitemMaterial()->Result();
		$conf                      = konfigurasi('Pesanan Pembelian Rujukan');
		$data                      = $value + $conf + $valuearray + $autocode + $datasupplier + $datamaterial;
		$this->template->load('production/layout/template', 'production/create_po_mrp_ref', $data);

	}

	public function newpo_recap_mrp($mo_id = null)
	{
		if (!isset($mo_id)) 
		{
			redirect('production/mrp');
		}
		$valuearray['mrp_array'] = $this->purchase_order_model->getporecapMRP($mo_id)->Result();
		$value['mrp_data']       = $this->purchase_order_model->getporecapMRP($mo_id)->Row();
		if (!$valuearray['mrp_array'] && !$value['mrp_data']) 
		{
			show_404();
		}
		$autocode['po_code']            = $this->purchase_order_model->getPO_ID();
		$datasupplier['supplier']       = $this->purchase_order_model->getSupplier()->Result();
		$datamaterial['material_list']  = $this->purchase_order_model->getitemMaterial()->Result();
		$conf                           = konfigurasi('Pesanan Pembelian Rujukan');
		$data                           = $value + $conf + $valuearray + $autocode + $datasupplier + $datamaterial;
		$this->template->load('production/layout/template', 'production/create_po_recap_mrp_ref', $data);

	}


	public function saveporecapmrp()
	{
		$crudlibrary    = $this->crud_library;
		$validation     = $this->form_validation;
		$validation->set_rules($crudlibrary->po_save()); 


		if ($validation->run()) {

			$this->db->trans_start();
			$this->purchase_order_model->insertporecapmrp();
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('production/mrp');
			} else {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('production/mrp'); 
			} 
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('production/mrp'); 
		}
	}


	public function UpdateStatusAccepted($detpo_id = null)
	{
		if (!isset($detpo_id)) 
		{
			show_404();
		}

		$executeModel = $this->purchase_order_model->StatusAccepted($detpo_id);
		
		if ($executeModel == false) {
			$this->session->set_flashdata('msg', show_err_msg('Gagal diperbarui.'));
			redirect(site_url('production/purchase_order'));
		} else {
			var_dump($executeModel);
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil diperbarui.'));
			redirect(site_url('production/purchase_order'));
		}

	}

	public function UpdateStatusNotAccepted($detpo_id = null)
	{
		if (!isset($detpo_id)) 
		{
			show_404();
		}

		if ($this->purchase_order_model->StatusNotAccepted($detpo_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil diperbarui.'));
			redirect(site_url('production/purchase_order'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal diperbarui.'));
			redirect(site_url('production/purchase_order'));
		}

	}
	public function UpdateStatusReject($detpo_id = null)
	{
		if (!isset($detpo_id)) 
		{
			show_404();
		}

		if ($this->purchase_order_model->StatusReject($detpo_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil diperbarui.'));
			redirect(site_url('production/purchase_order'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal diperbarui.'));
			redirect(site_url('production/purchase_order'));
		}

	}



	

}
