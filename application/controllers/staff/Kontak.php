<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "2") {
			redirect('', 'refresh');
		}
		$this->load->model("staff/konsumen_model");
		$this->load->model("staff/supplier_model");
		$this->load->library('Ajax_pagination');
		$this->load->library('Supajax_pagination');
		$this->load->library('Crud_library');
		$this->perPage = 10;
		$this->supperPage = 10;
	}

//pagination conf.
	public function index()
	{
		//customer pagination
		$custdata             = array();
		$totalRec             = count($this->konsumen_model->getRows());
		$config['target']     = '#konsumenList';
		$config['base_url']   = base_url() . 'kontak/ajaxPaginationData';
		$config['total_rows'] = $totalRec;
		$config['per_page']   = $this->perPage;
		$config['link_func']  = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		$custdata['customer'] = $this->konsumen_model->getRows(array('limit' => $this->perPage));

		//supplier pagination
		$supdata                 = array();
		$suptotalRec             = count($this->supplier_model->getRows());
		$supconfig['target']     = '#supplierList';
		$supconfig['base_url']   = base_url() . 'kontak/supajaxPaginationData';
		$supconfig['total_rows'] = $suptotalRec;
		$supconfig['per_page']   = $this->supperPage;
		$supconfig['link_func']  = 'supsearchFilter';
		$this->supajax_pagination->initialize($supconfig);

		$supdata['supplier'] = $this->supplier_model->getRows(array('limit' => $this->supperPage));
		$conf                = konfigurasi('Kontak');
		$data                = $custdata + $supdata + $conf;
		
		$this->template->load('staff/layout/template', 'staff/kontak_view', $data);
		

	}

	public function ajaxPaginationData()
	{
		$conditions = array();

		$page = $this->input->post('page');
		if (!$page) {
			$offset = 0;
		} else {
			$offset = $page;
		}
		$keywords = $this->input->post('keywords');
		$sortBy   = $this->input->post('sortBy');
		if (!empty($keywords)) {
			$conditions['search']['keywords'] = $keywords;
		}
		if (!empty($sortBy)) {
			$conditions['search']['sortBy'] = $sortBy;
		}
		$totalRec             = count($this->konsumen_model->getRows($conditions));
		//pagination configuration
		$config['target']     = '#konsumenList';
		$config['base_url']   = base_url() . 'kontak/ajaxPaginationData';
		$config['total_rows'] = $totalRec;
		$config['per_page']   = $this->perPage;
		$config['link_func']  = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		//set start and limit
		$conditions['start']  = $offset;
		$conditions['limit']  = $this->perPage;
		//get posts data
		$custdata['customer'] = $this->konsumen_model->getRows($conditions);
		//load the view
		$this->load->view('staff/ajax_page/ajax_konsumen', $custdata, false);
	}

	public function supajaxPaginationData()
	{
		$supconditions = array();
		//calc offset number
		$suppage = $this->input->post('page');
		if (!$suppage) {
			$supoffset = 0;
		} else {
			$supoffset = $suppage;
		}
		//set conditions for search
		$supkeywords = $this->input->post('supkeywords');
		$supsortBy   = $this->input->post('supsortBy');
		if (!empty($supkeywords)) {
			$supconditions['supsearch']['supkeywords'] = $supkeywords;
		}
		if (!empty($supsortBy)) {
			$supconditions['supsearch']['supsortBy'] = $supsortBy;
		}
		//total rows count
		$suptotalRec             = count($this->supplier_model->getRows($supconditions));
		//pagination configuration
		$supconfig['target']     = '#supplierList';
		$supconfig['base_url']   = base_url() . 'kontak/supajaxPaginationData';
		$supconfig['total_rows'] = $suptotalRec;
		$supconfig['per_page']   = $this->supperPage;
		$supconfig['link_func']  = 'supsearchFilter';
		$this->supajax_pagination->initialize($supconfig);
		//set start and limit
		$supconditions['start'] = $supoffset;
		$supconditions['limit'] = $this->supperPage;
		//get posts data
		$supdata['supplier'] = $this->supplier_model->getRows($supconditions);
		//load the view
		$this->load->view('staff/ajax_page/ajax_supplier', $supdata, false);
	}


//Customer crud
	public function custfrm()
	{
		$data = konfigurasi('Konsumen baru');
		$this->template->load('staff/layout/template', 'staff/create_konsumen', $data);
	}
	public function addkonsumen()
	{
		$customer    = $this->konsumen_model;
		$crudlibrary = $this->crud_library;
		$validation  = $this->form_validation;
		$validation->set_rules($crudlibrary->customersave());

		if ($validation->run()) {
			$result = $customer->save();
			if ($result > 0) {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				//$this->session->set_flashdata('success', 'Berhasil disimpan');
				redirect('staff/kontak/custfrm');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('staff/kontak/custfrm');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('staff/kontak/custfrm');

		}
		
	}

	public function editkonsumen($customer_id = null)
	{
		if (!isset($customer_id)) {
			redirect('staff/kontak');
		}

		$customer    = $this->konsumen_model;
		$crudlibrary = $this->crud_library;
		$validation  = $this->form_validation;
		$validation->set_rules($crudlibrary->customeredit());

		if ($validation->run()) {
			$result = $customer->update();
			if ($result > 0) {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil diperbarui.'));
				redirect('staff/kontak');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Gagal diperbarui.'));
				//redirect('production/kontak');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			//redirect('production/kontak/editkonsumen');

		}

		$value["customer"] = $customer->getById($customer_id);
		if (!$value["customer"]) {
			show_404();
		}
		$conf = konfigurasi('Perbarui konsumen');
		$data = $value + $conf;
		$this->template->load('staff/layout/template', 'staff/edit_konsumen', $data);
	}

	public function delkonsumen($customer_id = null)
	{
		if (!isset($customer_id)) {
			show_404();
		}

		if ($this->konsumen_model->delete($customer_id)) {
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil dihapus.'));
			redirect(site_url('staff/kontak'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal dihapus.'));
			redirect(site_url('staff/kontak'));
		}

	}
	

//supplier Crud
	public function supfrm()
	{
		$data = konfigurasi('Supplier Baru');
		$this->template->load('staff/layout/template', 'staff/create_supplier', $data);
	}
	public function addsupplier()
	{
		$supplier    = $this->supplier_model;
		$crudlibrary = $this->crud_library;
		$validation  = $this->form_validation;
		$validation->set_rules($crudlibrary->suppliersave());

		if ($validation->run()) {
			$result = $supplier->save();
			if ($result > 0) {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('staff/kontak/supfrm');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('staff/kontak/supfrm');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('staff/kontak/supfrm');

		}
	}
	public function editsupplier($supplier_id = null)
	{
		if (!isset($supplier_id)) {
			redirect('production/kontak');
		}

		$supplier    = $this->supplier_model;
		$crudlibrary = $this->crud_library;
		$validation  = $this->form_validation;
		$validation->set_rules($crudlibrary->supplieredit());

		if ($validation->run()) {
			$result = $supplier->update();
			if ($result > 0) {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil diperbarui.'));
				redirect('staff/kontak');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('Gagal diperbarui.'));
				redirect('staff/kontak');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));

		}

		$value["supplier"] = $supplier->getById($supplier_id);
		if (!$value["supplier"]) {
			show_404();
		}
		$conf = konfigurasi('Perbarui Supplier');
		$data = $value + $conf;

		$this->template->load('staff/layout/template', 'staff/edit_supplier', $data);
	}
	public function delsupplier($supplier_id = null)
	{
		if (!isset($supplier_id)) {
			show_404();
		}

		if ($this->supplier_model->delete($supplier_id)) {
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil dihapus.'));
			redirect(site_url('staff/kontak'));

		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal dihapus.'));
			redirect(site_url('staff/kontak'));
		}
	}
}
