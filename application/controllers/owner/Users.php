<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "3") {
			redirect('', 'refresh');
		}
		$this->load->model("owner/users_model");
		$this->load->library('Ajax_pagination');
		$this->load->library('Crud_library');
		$this->perPage = 10;
	}


	public function index()
	{
		$data = array();

		//total rows count
		$totalRec = count($this->users_model->getRows());

		//pagination configuration
		$config['target']      = '#userList';
		$config['base_url']    = base_url().'users/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		//get the posts data
		$datapage['users'] = $this->users_model->getRows(array('limit'=>$this->perPage));
		$conf = konfigurasi('Manajemen Pengguna');
		$data = $datapage + $conf;
		$this->template->load('owner/layout/template', 'owner/users_view',$data);
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
		$totalRec = count($this->users_model->getRows($conditions));

		//pagination configuration
		$config['target']      = '#userList';
		$config['base_url']    = base_url().'users/ajaxPaginationData';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);

		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['users']  = $this->users_model->getRows($conditions);

		$this->load->view('owner/ajax_page/ajax_users', $data, false);     

	}

	public function newuser()
	{
		$apps = konfigurasi('Pengguna Baru');
		$datarole['posisi'] = $this->users_model->getRoles()->Result();
		$data = $apps + $datarole;
		$this->template->load('owner/layout/template', 'owner/create_user', $data);
	}


	public function adduser()
	{
		$crudlibrary    = $this->crud_library;
		$validation     = $this->form_validation;
		$validation->set_rules($crudlibrary->saveuser()); 

		if ($validation->run()) {

			$this->db->trans_start();
			$this->users_model->insertuser();
			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('owner/users/newuser');
			} else {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('owner/users/newuser'); 
			} 
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('owner/users/newuser'); 
		}


	}

	public function showdetailusers($user_id = null)
	{
		if (!isset($user_id)) {
			redirect('owner/users');
		}
		$value['edit_user']   = $this->users_model->getDetailUser($user_id)->Row();
		$conf                 = konfigurasi('Detail Informasi Pengguna');
		$datarole['posisi']   = $this->users_model->getRoles()->Result();
		$data                 = $value + $conf + $datarole;
		$this->template->load('owner/layout/template', 'owner/detail_user_page', $data);

	}

	public function updateuser()
	{
		$crudlibrary    = $this->crud_library;
		$validation     = $this->form_validation;
		$validation->set_rules($crudlibrary->saveuseredit()); 

		if ($validation->run()) {
			$this->db->trans_start();
			$this->users_model->saveupdateuser();
			$this->db->trans_complete(); 

			if ($this->db->trans_status() === FALSE)
			{
				$this->session->set_flashdata('msg', show_err_msg('Gagal disimpan.'));
				redirect('owner/users');
			} else {
				$this->session->set_flashdata('msg', show_succ_msg('Berhasil disimpan.'));
				redirect('owner/users'); 
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('owner/users'); 
		}
	}

	public function Actdeleteuser($user_id = null)
	{
		if (!isset($user_id)) 
		{
			show_404();
		}

		if ($this->users_model->deluser($user_id)) 
		{
			$this->session->set_flashdata('msg', show_succ_msg('Berhasil dihapus.'));
			redirect(site_url('owner/users'));
		} else {
			$this->session->set_flashdata('msg', show_err_msg('Gagal dihapus.'));
			redirect(site_url('owner/users'));
		}

	}

}
