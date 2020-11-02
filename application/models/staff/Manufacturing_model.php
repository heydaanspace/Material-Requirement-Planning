<?php
class manufacturing_model extends CI_Model
{

	public function getRows($params = array()){

		$this->db->select('a.mo_code,a.mo_id, c.*, a.created_date, a.production_start, a.prod_deadline, a.production_cost, a.total_cost, a.additional_info, a.status, b.quantity, COUNT(b.product_sku) as jumlah_produk');
		$this->db->from('manufacturing_order a');
		$this->db->join('detail_manufacturing_order b','a.mo_id=b.mo_id');
		$this->db->join('customer c','c.customer_id=a.customer_id');
		$this->db->Group_by('a.mo_id');

				//filter data by searched keywords
		if(!empty($params['search']['key'])){
			$this->db->like('a.mo_code',$params['search']['keywords']);
		}
				//sort data by ascending or desceding order
		if(!empty($params['search']['sortBy'])){
			$this->db->order_by('a.created_date',$params['search']['sortBy']);
		}else{
			$this->db->order_by('a.created_date','DESC');
		}
		if(!empty($params['search']['filterBy'])){
			$this->db->where('a.status',$params['search']['filterBy']);
		}
				//set start and limit
		if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit'],$params['start']);
		}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
			$this->db->limit($params['limit']);
		}
				//get records
		$query = $this->db->get();
				//return fetched data
		return ($query->num_rows() > 0)?$query->result_array():FALSE;
	}

	public function getMO_ID()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(mo_code,2)) AS mo_max FROM manufacturing_order");
		$prefix = "PROD";
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->mo_max)+1;
				$kd = sprintf("%02s", $tmp);
			}
		}else{
			$kd = "01";
		}
		date_default_timezone_set('Asia/Jakarta');
		return $prefix.('-').date('dmy').('-').$kd;
	}



	public function getProduct()
	{
		$this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
		$this->db->from('product_category a');
		$this->db->join('product b', 'a.category_id=b.category_id');
		$this->db->join('product_sku c', 'b.product_code=c.product_code');
		$this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');

		$query = $this->db->get();
		return $query;
	}

	public function getCustomer() 
	{
		$query = $this->db->get('customer');
		return $query;
	}

	public function getProductAjax($product_sku)
	{
		$this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
		$this->db->from('product_category a');
		$this->db->join('product b', 'a.category_id=b.category_id');
		$this->db->join('product_sku c', 'b.product_code=c.product_code');
		$this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
		$this->db->where('c.product_sku', $product_sku);

		$query = $this->db->get();
		return $query;
	}

	public function getItemProduct($mo_id) 
	{

		$this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, c.sku_id, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
		$this->db->from('product_category a');
		$this->db->join('product b', 'a.category_id=b.category_id');
		$this->db->join('product_sku c', 'b.product_code=c.product_code');
		$this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
		$subQuery1 = $this->db->get_compiled_select();

		$this->db->select('a.*, b.*, c.*');
		$this->db->from("($subQuery1) a");
		$this->db->join('detail_manufacturing_order b', 'a.product_sku=b.product_sku');
		$this->db->join('manufacturing_order c', 'c.mo_id=b.mo_id');
		$this->db->join('customer d', 'd.customer_id=c.customer_id');
		$this->db->where('c.mo_id', $mo_id);
		$query = $this->db->get();
		return $query;

	}

	public function savemanufacturingorder()
	{

		$dataMO['mo_code']          = $this->input->post('imo_code');
		$dataMO['customer_id']      = $this->input->post('selcustomer_mo');
		$dataMO['created_date']     = $this->input->post('icreate_date');
		$dataMO['production_start'] = $this->input->post('istartprod');
		$dataMO['prod_deadline']    = $this->input->post('ideadline');
		$dataMO['production_cost']  = $this->input->post('iservice_rate');
		$dataMO['total_cost']       = $this->input->post('igrand_total');
		$dataMO['additional_info']  = $this->input->post('iadditional_info');
		$dataMO['status']           = "Belum dilaksanakan";

		$this->db->insert('manufacturing_order', $dataMO);  
		$moID = $this->db->insert_id();


		$itemProduct = $this->input->post('selitem_mo');
		$qty    = $this->input->post('iqty_mo');
		if (! empty($itemProduct)) 
		{
			foreach ($itemProduct as $key => $value) 
			{

				$dataDetMO['mo_id']   = $moID;
				$dataDetMO['product_sku'] = $value;
				$dataDetMO['quantity']   = $qty[$key];
				$this->db->insert('detail_manufacturing_order', $dataDetMO);
			}

		}
	}

	public function getById($mo_id) 
	{

		$this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, c.sku_id, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
		$this->db->from('product_category a');
		$this->db->join('product b', 'a.category_id=b.category_id');
		$this->db->join('product_sku c', 'b.product_code=c.product_code');
		$this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
		$subQuery1 = $this->db->get_compiled_select();

		$this->db->select('a.*, b.*, c.*,d.customer_name,d.customer_telp,d.customer_email,d.customer_address');
		$this->db->from("($subQuery1) a");
		$this->db->join('detail_manufacturing_order b', 'a.product_sku=b.product_sku');
		$this->db->join('manufacturing_order c', 'c.mo_id=b.mo_id');
		$this->db->join('customer d', 'd.customer_id=c.customer_id');
		$this->db->where('c.mo_id', $mo_id);
		$query = $this->db->get();
		return $query;

	}

	//update function begin
	public function updateMO()
	{
		$moID                         = $this->input->post('imo_id');
		$dataMO['customer_id']        = $this->input->post('selcustomer_mo');
		$dataMO['production_start']   = $this->input->post('istartprod');
		$dataMO['prod_deadline']      = $this->input->post('ideadline');
		$dataMO['production_cost']    = $this->input->post('iservice_rate');
		$dataMO['additional_info']    = $this->input->post('iadditional_info');
		return $this->db->update('manufacturing_order', $dataMO, array('mo_id' => $moID));  

	}

	public function deleteforupdate()
	{
		$detMO  = $this->input->post('idet_mo');
		foreach ($detMO as $key => $value) 
		{
			$id_detMO = $value;
			$this->db->where('id_det_mo', $id_detMO);
			$this->db->delete('detail_manufacturing_order');
		}
	}

	public function insertforupdate()
	{
		$moID        = $this->input->post('imo_id');
		$itemProduct = $this->input->post('selitem_mo');
		$qty         = $this->input->post('iqty_mo');
		if (! empty($itemProduct)) 
		{
			foreach ($itemProduct as $key => $value) 
			{

				$dataDetMO['mo_id']   = $moID;
				$dataDetMO['product_sku'] = $value;
				$dataDetMO['quantity']   = $qty[$key];
				$this->db->insert('detail_manufacturing_order', $dataDetMO);
			}

		}
	}
//update function end

	public function StatusStart($mo_id)
	{
		//$dataStatus['production_start'] = date("Y-m-d");
		$dataStatus['status']           = "Sedang Berjalan";
		return $this->db->update('manufacturing_order', $dataStatus, array('mo_id' => $mo_id));  

	}
	public function StatusDone($mo_id)
	{
		$dataStatus['status']           = "Selesai";
		return $this->db->update('manufacturing_order', $dataStatus, array('mo_id' => $mo_id));  

	}
	public function StatusNotStart($mo_id)
	{
		//$dataStatus['production_start'] = "Belum ditetapkan";
		$dataStatus['status']           = "Belum dilaksanakan";
		return $this->db->update('manufacturing_order', $dataStatus, array('mo_id' => $mo_id));  

	}
	public function StatusReject($mo_id)
	{
		$dataStatus['status']           = "Dibatalkan";
		return $this->db->update('manufacturing_order', $dataStatus, array('mo_id' => $mo_id));  

	}

	public function deleteMO($mo_id)
	{
		return $this->db->delete('manufacturing_order', array("mo_id" => $mo_id));
	}


}