<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (version_compare(PHP_VERSION, '7.2.0', '>=')) 
{
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

defined('BASEPATH') or exit('No direct script access allowed');

class Product_card extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "1") {
			redirect('', 'refresh');
		}
		$this->load->model("production/product_model");
		$this->load->library('Ajax_pagination');
		$this->load->library('Crud_library');
		$this->load->helper('heydaans_helper');
		$this->perPage = 10;

	}

	public function index()
	{
		$data = array();

		//total rows count
		$totalRec = count($this->product_model->getRows());

		//pagination configuration
		$config['target']      = '#productList';
		$config['base_url']    = base_url().'product_card/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		//get the posts data
		$datapage['product_card'] = $this->product_model->getRows(array('limit'=>$this->perPage));
		$conf                     = konfigurasi('Kartu Produk');
		$data                     = $datapage + $conf;
		$this->template->load('production/layout/template', 'production/product_view',$data);
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
		if(!empty($keywords)){
			$conditions['search']['keywords'] = $keywords;
		}
		if(!empty($sortBy)){
			$conditions['search']['sortBy'] = $sortBy;
		}
		
		//total rows count
		$totalRec = count($this->product_model->getRows($conditions));
		
		//pagination configuration
		$config['target']      = '#productList';
		$config['base_url']    = base_url().'product_card/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['product_card']  = $this->product_model->getRows($conditions);
		
		$this->load->view('production/ajax_page/ajax_product', $data, false);     
		
	}

	public function showproduct()
	{
		$data = $this->product_model->getProduct()->Result();
		echo json_encode($data);

	}

	public function showbom()
	{
		$product_sku       = $_POST['product_sku'];
		$data['bom_list']  = $this->product_model->getBOM($product_sku)->result_array();
		$this->load->view('production/modal_view/modal_view_bom', $data);
	}

	public function showmaterial()
	{
		$material_sku = $this->input->post('material_sku');
		$data         = $this->product_model->getMaterialAjax($material_sku)->Result();
		echo json_encode($data);

	}

	public function addcategory() 
	{
		$data = $this->product_model->savecategory();
		echo json_encode($data);
	}

	public function showcategory()
	{
		$data = $this->product_model->getCategory()->Result();
		echo json_encode($data);

	}

	public function addunit() 
	{
		$data = $this->product_model->saveunit();
		echo json_encode($data);
	}

	public function showunit()
	{
		$data = $this->product_model->getUnit()->Result();
		echo json_encode($data);

	}

	public function addmastervariant() 
	{
		$data = $this->product_model->savemastervariant();
		echo json_encode($data); 
	}

	public function showmastervariant()
	{
		$data = $this->product_model->getMasterVariant()->Result();
		echo json_encode($data); 
	}

	public function newproduct()
	{
		$datavar['master_variant_product'] = $this->product_model->getMasterVariant()->Result();
		$conf                              = konfigurasi('Produk Baru');
		$data                              = $datavar+$conf;
		$this->template->load('production/layout/template', 'production/create_product', $data);
	}

	public function newbom()
	{
		$dataprod['product_list']       = $this->product_model->getProduct()->Result();
		$datamaterial['material_list']  = $this->product_model->getMaterial()->Result();
		$conf                           = konfigurasi('Tetapkan Struktur Produk');
		$data                           = $dataprod + $conf + $datamaterial;
		$this->template->load('production/layout/template', 'production/create_bom', $data);
	}


	public function editproductcard($product_code = null)
	{
		if (!isset($product_code)) 
		{
			redirect('production/product_card');
		}
		$valuearray['product_array'] = $this->product_model->getById($product_code)->Result();
		$value['product_edit']       = $this->product_model->getById($product_code)->Row();
		if (!$valuearray['product_edit'] && !$value['product_edit']) 
		{
			show_404();
		}
		$conf                              = konfigurasi('Perbarui Kartu Produk');
		$datavar['master_variant_product'] = $this->product_model->getMasterVariant()->Result();
		$datacat['product_category']       = $this->product_model->getCategory()->Result();
		$dataunit['unit_of_measure']       = $this->product_model->getUnit()->Result();
		$data                              = $value + $conf + $datacat + $valuearray + $datavar + $dataunit;
		$this->template->load('production/layout/template', 'production/edit_product', $data);

	}

	public function editprocess()
	{

		$this->db->trans_start();
		$this->product_model->updateproduct();
		$this->product_model->deleteforupdate();
		$this->product_model->insertforupdate();
		$this->db->trans_complete(); 

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
			redirect('production/product_card');
		} else {
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
			redirect('production/product_card'); 
		}

	}

	public function updatebom()
	{

		$this->db->trans_start();
		$this->product_model->deleteforupdatebom();
		//$this->product_model->saveupdatebillofmaterial();
		$this->db->trans_complete(); 

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
			redirect('production/product_card');
		} else {
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
			redirect('production/product_card'); 
		}

	}

	public function showdetailBOM($product_sku = null)
	{
		if (!isset($product_sku)) 
		{
			redirect('production/product_card');
		}
		$valuearray['product_array'] = $this->product_model->getBOM($product_sku)->Result();
		$value['product_data']       = $this->product_model->getBOM($product_sku)->Row();
		if (!$valuearray['product_array'] && !$value['product_data']) 
		{
			show_404();
		}
		$conf                              = konfigurasi('Rincian Struktur Produk');
		$datakomponen['komponen']               = $this->product_model->getMaterial()->Result();
		$data                              = $value + $conf + $valuearray + $datakomponen;
		$this->template->load('production/layout/template', 'production/detail_BOM', $data);

	}

	public function delproduct($product_code = null)
	{
		if (!isset($product_code)) 
		{
			show_404();
		}

		if ($this->product_model->deleteproduct($product_code)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil dihapus.'));
			redirect(site_url('production/product_card'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal dihapus.'));
			redirect(site_url('production/product_card'));
		}

	}

	public function addbillofmaterial()
	{
		$crudlibrary    = $this->crud_library;
		$validation     = $this->form_validation;
		$validation->set_rules($crudlibrary->bomsave()); 

		if ($validation->run()) {

			$this->db->trans_start();
			$this->product_model->savebillofmaterial();
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('production/product_card');
			} else {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('production/product_card'); 
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('production/product_card/newbom'); 
		}

	}

	public function addproductcard()
	{

		$productcard    = $this->product_model;

		if(empty($this->input->post('variancheck'))) 
		{
			$crudlibrary1          = $this->crud_library;
			$validation_nonvar     = $this->form_validation;
			$validation_nonvar->set_rules($crudlibrary1->productsavenonvar());

			if ($validation_nonvar->run())
			{
				$result = $productcard->saveproductcard();
				if ($this->db->trans_status() === FALSE)
				{   
					$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
					redirect('production/product_card/newproduct');
				} else {
					$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
					redirect('production/product_card/newproduct'); }
				} else {
					$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
					redirect('production/product_card/newproduct'); 
				}

			} else { 
				$crudlibrary2    = $this->crud_library;
				$validation     = $this->form_validation;
				$validation->set_rules($crudlibrary2->productsave());

				if ($validation->run()) 
				{
					$result = $productcard->saveproductcard();
					if ($this->db->trans_status() === FALSE)
					{   
						$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
						redirect('production/product_card/newproduct');
					} else {
						$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
						redirect('production/product_card/newproduct'); }
					} else {
						$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
						redirect('production/product_card/newproduct'); 
					}

				}
			}

		}

