<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (version_compare(PHP_VERSION, '7.2.0', '>=')) 
{
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

defined('BASEPATH') or exit('No direct script access allowed');

class Item_material extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "1") {
			redirect('', 'refresh');
		}
		$this->load->model("production/material_model");
		$this->load->library('Ajax_pagination');
		$this->load->library('crud_library');
		$this->perPage = 10;

	}

	public function index()
	{
		$data = array();

		//total rows count
		$totalRec = count($this->material_model->getRows());

		//pagination configuration
		$config['target']      = '#materialList';
		$config['base_url']    = base_url().'item_material/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		//get the posts data
		$datapage['item_material'] = $this->material_model->getRows(array('limit'=>$this->perPage));
		$conf = konfigurasi('Item Bahan Baku');
		$data = $datapage + $conf;
		$this->template->load('production/layout/template', 'production/material_view',$data);
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
			$conditions['search']['sortBy']   = $sortBy;
		}
		
		//total rows count
		$totalRec = count($this->material_model->getRows($conditions));
		
		//pagination configuration
		$config['target']      = '#materialList';
		$config['base_url']    = base_url().'item_material/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['item_material']  = $this->material_model->getRows($conditions);
		
		$this->load->view('production/ajax_page/ajax_material', $data, false);     
		
	}

	public function addcategory() 
	{
		$data = $this->material_model->savecategory();
		echo json_encode($data);
	}

	public function addunit() 
	{
		$data = $this->material_model->saveunit();
		echo json_encode($data);
	}

	public function addmastervariant() 
	{
		$data = $this->material_model->savemastervariant();
		echo json_encode($data);
	}

	public function showunit()
	{
		$data = $this->material_model->getUnit()->Result();
		echo json_encode($data);
	}


	public function showmastervariant()
	{
		$data = $this->material_model->getMasterVariant()->Result();
		echo json_encode($data);
	}

	public function showcategory()
	{
		$data = $this->material_model->getCategory()->Result();
		echo json_encode($data);

	}

	public function newmaterial()
	{
		$data = konfigurasi('Bahan Baku Baru');
		$this->template->load('production/layout/template', 'production/create_material', $data);
	}

	public function addmaterial()
	{
		$material    = $this->material_model;


		if(empty($this->input->post('material_variancheck'))) {
			$crudlibrary1          = $this->crud_library;
			$validation_nonvar     = $this->form_validation;
			$validation_nonvar->set_rules($crudlibrary1->materialsavenonvar());

			if ($validation_nonvar->run()){
				$result = $material->savematerial();
				if ($this->db->trans_status() === FALSE)
				{   
					$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
					redirect('production/item_material/newmaterial');
				} else {
					$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
					redirect('production/item_material/newmaterial'); }
				} else {
					$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
					redirect('production/item_material/newmaterial'); 
				}

			} else { 
				$crudlibrary2   = $this->crud_library;
				$validation     = $this->form_validation;
				$validation->set_rules($crudlibrary2->materialsave());

				if ($validation->run()) {
					$result = $material->savematerial();
					if ($this->db->trans_status() === FALSE)
					{   
						$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
						redirect('production/item_material/newmaterial');
					} else {
						$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
						redirect('production/item_material/newmaterial'); }
					} else {
						$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
						redirect('production/item_material/newmaterial'); 
					}

				}


			}


			public function editmaterial($material_code = null)
			{
				if (!isset($material_code)) 
				{
					redirect('production/item_material');
				}
				$valuearray['material_array'] = $this->material_model->getById($material_code)->Result();
				$value['material_edit']       = $this->material_model->getById($material_code)->Row();
				if (!$valuearray['material_edit'] && !$value['material_edit']) 
				{
					show_404();
				}
				$conf                               = konfigurasi('Perbarui Kartu Produk');
				$datavar['master_variant_material'] = $this->material_model->getMasterVariant()->Result();
				$datacat['material_category']       = $this->material_model->getCategory()->Result();
				$dataunit['unit_of_measure']        = $this->material_model->getUnit()->Result();
				$data                               = $value + $conf + $datacat + $valuearray + $datavar + $dataunit;
				$this->template->load('production/layout/template', 'production/edit_material', $data);

			}

			public function editprocess()
			{

				$this->db->trans_start();
				$this->material_model->updatematerial();
				$this->material_model->deleteforupdate();
				$this->material_model->insertforupdate();
				$this->db->trans_complete(); 

				if ($this->db->trans_status() === FALSE)
				{
					$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
					redirect('production/item_material');
				} else {
					$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
					redirect('production/item_material'); 
				}

			}

			public function delmaterial($material_code = null)
			{
				if (!isset($material_code)) 
				{
					show_404();
				}

				if ($this->material_model->deletematerial($material_code)) 
				{
					$this->session->set_flashdata('msg', show_succ_msg('Berhasil dihapus.'));
					redirect(site_url('production/item_material'));
				} else {
					$this->session->set_flashdata('msg', show_err_msg('Gagal dihapus.'));
					redirect(site_url('production/item_material'));
				}

			}



		}

