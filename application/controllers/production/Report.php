<?php

defined('BASEPATH') or exit('No direct script access allowed');
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

class Report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->check_login();
		if ($this->session->userdata('id_role') != "1") {
			redirect('', 'refresh');
		}
		$this->load->model("production/report_model");
		$this->load->library('Ajax_pagination');
		$this->perPage = 10;
	}

	public function index()
	{
		$data = konfigurasi('Laporan');
		$this->template->load('production/layout/template', 'production/report_page',$data);

	}

	public function stokreport()
	{
		$apps                     = konfigurasi('Laporan Stok');
		$datamaterial['material'] = $this->report_model->getMaterial()->Result();
		$data                     = $apps + $datamaterial;
		$this->template->load('production/layout/template', 'production/stok_report_view',$data);

	}


	public function ajaxInStockReport()
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
		$selmaterial = $this->input->post('selmaterial');
		$startDate   = $this->input->post('startDate');
		$endDate     = $this->input->post('endDate');
		if(!empty($selmaterial)){
			$conditions['search']['selmaterial'] = $selmaterial;
		}
		if(!empty($startDate)){
			$conditions['search']['startDate']   = $startDate;
		}
		if(!empty($endDate)){
			$conditions['search']['endDate']     = $endDate;
		}
		
		//total rows count
		$totalRec = count($this->report_model->getInstockReport($conditions));
		
		//pagination configuration
		$config['target']      = '#instockList';
		$config['base_url']    = base_url().'report/ajaxInStockReport';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['inventory']     = $this->report_model->getInstockReport($conditions);
		$this->load->view('production/ajax_page/ajax_instock_report_page', $data, false);     
		
	}

	public function ajaxOutStockReport()
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
		$selmaterialoutstock = $this->input->post('selmaterialoutstock');
		$startDateOutStock   = $this->input->post('startDateOutStock');
		$endDateOutStock     = $this->input->post('endDateOutStock');
		if(!empty($selmaterialoutstock)){
			$conditions['search']['selmaterialoutstock'] = $selmaterialoutstock;
		}
		if(!empty($startDateOutStock)){
			$conditions['search']['startDateOutStock']   = $startDateOutStock;
		}
		if(!empty($endDateOutStock)){
			$conditions['search']['endDateOutStock']     = $endDateOutStock;
		}
		
		//total rows count
		$totalRec = count($this->report_model->getOutstockReport($conditions));
		
		//pagination configuration
		$config['target']      = '#outstockList';
		$config['base_url']    = base_url().'report/ajaxOutStockReport';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['inventory']     = $this->report_model->getOutstockReport($conditions);
		$this->load->view('production/ajax_page/ajax_outstock_report_page', $data, false);     
		
	}

	public function ajaxRecapStockReport()
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
		$selmaterialrecap = $this->input->post('selmaterialrecap');
		$startDateRecap   = $this->input->post('startDateRecap');
		$endDateRecap     = $this->input->post('endDateRecap');
		if(!empty($selmaterialrecap)){
			$conditions['search']['selmaterialrecap'] = $selmaterialrecap;
		}
		if(!empty($startDateRecap)){
			$conditions['search']['startDateRecap']   = $startDateRecap;
		}
		if(!empty($endDateRecap)){
			$conditions['search']['endDateRecap']     = $endDateRecap;
		}
		
		//total rows count
		$totalRec = count($this->report_model->getRecapstockReport($conditions));
		
		//pagination configuration
		$config['target']      = '#recapstockList';
		$config['base_url']    = base_url().'report/ajaxRecapStockReport';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['inventory']     = $this->report_model->getRecapstockReport($conditions);
		$this->load->view('production/ajax_page/ajax_recap_report_page', $data, false);     
		
	}


	public function printInstock()
	{
		$conditions = array();

		$selmaterial   = $this->input->post('selmaterial');
		$startDate     = $this->input->post('startDate');
		$endDate       = $this->input->post('endDate');

		if(!empty($selmaterial)){
			$conditions['search']['selmaterial'] = $selmaterial;
		}
		if(!empty($startDate)){
			$conditions['search']['startDate']   = $startDate;
		}
		if(!empty($endDate)){
			$conditions['search']['endDate']     = $endDate;
		}

		$dataPrintArray['report_stock'] = $this->report_model->getPrintInstockReport($conditions)->result_array();
		$dataPrint['report_data'] = $this->report_model->getPrintInstockReport($conditions)->Row();
		$firstDate['start']       = $this->input->post('startDate');
		$secondDate['end']        = $this->input->post('endDate');
		$datapage = $dataPrintArray + $dataPrint + $firstDate + $secondDate;

		$this->load->library('Pdfgenerator');
		$this->pdfgenerator->setPaper('A4', 'landscape');
		$this->pdfgenerator->filename = "laporan-stok-masuk.pdf";
		$this->pdfgenerator->load_view('production/PDF_reporting/instock_report_pdf', $datapage);

		//$this->load->view('production/pdf_reporting/instock_report_pdf', $datapage);   
	}

	public function printOutstock()
	{
		$conditions = array();

		$selmaterialoutstock = $this->input->post('selmaterialoutstock');
		$startDateOutStock   = $this->input->post('startDateOutStock');
		$endDateOutStock     = $this->input->post('endDateOutStock');
		if(!empty($selmaterialoutstock)){
			$conditions['search']['selmaterialoutstock'] = $selmaterialoutstock;
		}
		if(!empty($startDateOutStock)){
			$conditions['search']['startDateOutStock']   = $startDateOutStock;
		}
		if(!empty($endDateOutStock)){
			$conditions['search']['endDateOutStock']     = $endDateOutStock;
		}

		$dataPrintArray['report_stock'] = $this->report_model->getPrintOutstockReport($conditions)->result_array();
		$dataPrint['report_data']       = $this->report_model->getPrintInstockReport($conditions)->Row();
		$firstDate['start']             = $this->input->post('startDateOutStock');
		$secondDate['end']              = $this->input->post('endDateOutStock');
		$datapage = $dataPrintArray + $dataPrint + $firstDate + $secondDate;

		$this->load->library('Pdfgenerator');
		$this->pdfgenerator->setPaper('A4', 'landscape');
		$this->pdfgenerator->filename = "laporan-stok-keluar.pdf";
		$this->pdfgenerator->load_view('production/PDF_reporting/outstock_report_pdf', $datapage);

		//$this->load->view('production/pdf_reporting/instock_report_pdf', $datapage);   
	}


	public function printRecapstock()
	{
		$conditions = array();

		//set conditions for search
		$selmaterialrecap = $this->input->post('selmaterialrecap');
		$startDateRecap   = $this->input->post('startDateRecap');
		$endDateRecap     = $this->input->post('endDateRecap');
		if(!empty($selmaterialrecap)){
			$conditions['search']['selmaterialrecap'] = $selmaterialrecap;
		}
		if(!empty($startDateRecap)){
			$conditions['search']['startDateRecap']   = $startDateRecap;
		}
		if(!empty($endDateRecap)){
			$conditions['search']['endDateRecap']     = $endDateRecap;
		}

		$dataPrintArray['report_stock'] = $this->report_model->getPrintRecapstockReport($conditions)->result_array();
		$firstDate['start']             = $this->input->post('startDateRecap');
		$secondDate['end']              = $this->input->post('endDateRecap');
		$datapage = $dataPrintArray + $firstDate + $secondDate;

		$this->load->library('Pdfgenerator');
		$this->pdfgenerator->setPaper('A4', 'landscape');
		$this->pdfgenerator->filename = "laporan-recap-mutasi.pdf";
		$this->pdfgenerator->load_view('production/PDF_reporting/recap_report_pdf', $datapage);

	}

	public function mrpreport()
	{
		$apps                     = konfigurasi('Laporan Rekap MRP');
		$dataMO['mo_list'] = $this->report_model->getMOlist()->Result();
		$data                     = $apps + $dataMO;
		$this->template->load('production/layout/template', 'production/mrp_report_view',$data);

	}

	public function ajaxMrpReport()
	{
		$conditions = array();
	
		//set conditions for search
		$selprod     = $this->input->post('selprod');
		$startDate   = $this->input->post('startDate');
		$endDate     = $this->input->post('endDate');
		if(!empty($selprod)){
			$conditions['search']['selprod'] = $selprod;
		}
		if(!empty($startDate)){
			$conditions['search']['startDate']   = $startDate;
		}
		if(!empty($endDate)){
			$conditions['search']['endDate']     = $endDate;
		}
		
	


		$data['mrp_list']     = $this->report_model->getMrpReport($conditions);
		$this->load->view('production/ajax_page/ajax_mrp_report_page', $data, false);     
		
	}

	public function printMRPReport()
	{
		$conditions = array();

		//set conditions for search
		$selprod     = $this->input->post('selprod');
		$startDate   = $this->input->post('startDate');
		$endDate     = $this->input->post('endDate');
		if(!empty($selprod)){
			$conditions['search']['selprod'] = $selprod;
		}
		if(!empty($startDate)){
			$conditions['search']['startDate']   = $startDate;
		}
		if(!empty($endDate)){
			$conditions['search']['endDate']     = $endDate;
		}

		$dataPrintArray['mrp_list']    = $this->report_model->getPrintMrpReport($conditions)->result_array();
		$firstDate['start']             = $this->input->post('startDate');
		$secondDate['end']              = $this->input->post('endDate');
		$datapage = $dataPrintArray + $firstDate + $secondDate;

		$this->load->library('Pdfgenerator');
		$this->pdfgenerator->setPaper('A4', 'landscape');
		$this->pdfgenerator->filename = "laporan-recap-mrp.pdf";
		$this->pdfgenerator->load_view('production/PDF_reporting/mrp_report_pdf', $datapage);

	}


	public function moreport()
	{
		$apps                     = konfigurasi('Laporan Rekap Manufacturing Orders');
		$dataMO['mo_list'] 		  = $this->report_model->getMOlist()->Result();
		$data                     = $apps + $dataMO;
		$this->template->load('production/layout/template', 'production/mo_report_view',$data);

	}

	public function ajaxMoReport()
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
		$selprod     = $this->input->post('selprod');
		$startDate   = $this->input->post('startDate');
		$endDate     = $this->input->post('endDate');
		if(!empty($selprod)){
			$conditions['search']['selprod'] = $selprod;
		}
		if(!empty($startDate)){
			$conditions['search']['startDate']   = $startDate;
		}
		if(!empty($endDate)){
			$conditions['search']['endDate']     = $endDate;
		}
		
		//total rows count
		$totalRec = count($this->report_model->getMoReport($conditions));
		
		//pagination configuration
		$config['target']      = '#moList';
		$config['base_url']    = base_url().'report/ajaxMoReport';
		$config['total_rows']  = $totalRec;
		$config['per_page']    = $this->perPage;
		$config['link_func']   = 'searchFilter';
		$this->ajax_pagination->initialize($config);
		
		//set start and limit
		$conditions['start']   = $offset;
		$conditions['limit']   = $this->perPage;


		$data['manufacturing']     = $this->report_model->getMoReport($conditions);
		$this->load->view('production/ajax_page/ajax_mo_report_page', $data, false);     
		
	}

	public function printMoReport()
	{
		$conditions = array();

		//set conditions for search
		$selprod     = $this->input->post('selprod');
		$startDate   = $this->input->post('startDate');
		$endDate     = $this->input->post('endDate');
		if(!empty($selprod)){
			$conditions['search']['selprod'] = $selprod;
		}
		if(!empty($startDate)){
			$conditions['search']['startDate']   = $startDate;
		}
		if(!empty($endDate)){
			$conditions['search']['endDate']     = $endDate;
		}

		$dataPrintArray['manufacturing']     = $this->report_model->getPrintMoReport($conditions)->result_array();
		$firstDate['start']             = $this->input->post('startDate');
		$secondDate['end']              = $this->input->post('endDate');
		$datapage = $dataPrintArray + $firstDate + $secondDate;

		$this->load->library('Pdfgenerator');
		$this->pdfgenerator->setPaper('A4', 'landscape');
		$this->pdfgenerator->filename = "laporan-recap-mo.pdf";
		$this->pdfgenerator->load_view('production/PDF_reporting/mo_report_pdf', $datapage);

	}


	
}
