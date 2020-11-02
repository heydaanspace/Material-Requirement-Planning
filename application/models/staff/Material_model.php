<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Material_model extends CI_Model
{	
	public function getRows($params = array())
	{
		
		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand,b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		//$this->db->order_by('c.product_sku','ASC');
		//filter data by searched keywords
		if(!empty($params['search']['keywords'])){
			$this->db->like('b.material_name',$params['search']['keywords']);
		}
		//sort data by ascending or desceding order
		if(!empty($params['search']['sortBy'])){
			$this->db->order_by('b.material_name',$params['search']['sortBy']);
		}else{
			$this->db->order_by('c.material_sku','DESC');
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

	public function getCategory()
	{
		$query = $this->db->get('material_category');
		return $query;
	}

	public function getUnit()
	{
		$query = $this->db->get('unit_of_measure');
		return $query;
	}

	public function getMasterVariant()
	{
		$query = $this->db->get('master_variant_material');
		return $query;
	}

	public function getproductSKU()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(product_sku,2)) AS sku_max FROM product_sku");
		$prefix = "PS";
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->sku_max)+1;
				$kd = sprintf("%02s", $tmp);
			}
		}else{
			$kd = "01";
		}
		date_default_timezone_set('Asia/Jakarta');
		return $prefix.('-').date('dmy').$kd;
	}

	public function savecategory() 
	{
		$post                 = $this->input->post();
		$this->category_name  = $post["icategory"];
		return $this->db->insert('material_category', $this);
	}

	public function saveunit() 
	{
		$post              = $this->input->post();
		$this->unit_name   = $post["iuom"];
		return $this->db->insert('unit_of_measure', $this);
	}

	public function savemastervariant() 
	{
		$post                   = $this->input->post();
		$this->variant_material  = $post["imastervariant"];
		return $this->db->insert('master_variant_material', $this);
	}

	public function getById($material_code)
	{
		$this->db->select('a.category_id, a.category_name, b.material_code, b.material_name, c.sku_id, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_code, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$this->db->where('b.material_code', $material_code);

		return $this->db->get();   
	}

	public function savematerial()
	{
		$this->db->trans_start();
        //product
		//$datamaterial['material_code']  = $this->input->post('id_product');
		$datamaterial['category_id']             = $this->input->post('selcategory');
		$datamaterial['material_name']           = $this->input->post('imaterialname');
		$datamaterial['material_brand']          = $this->input->post('imaterialbrand');
		$datamaterial['material_unit']  = $this->input->post('iunit');
		$this->db->insert('material_item', $datamaterial);  
		$material_code = $this->db->insert_id();

        //variant
		$selectvarian = $this->input->post('selectvarian_material');
		$varianopt    = $this->input->post('material_varianopt');
		$optvalue     = $this->input->post('ivarianval_material');
		if (! empty($varianopt) && ! empty($optvalue) ) 
		{
			foreach ($optvalue as $key => $value) 
			{

				$datavar['material_code'] = $material_code;
				$datavar['mv_option']     = $varianopt;
				$datavar['mv_value']      = $value;
				$this->db->insert('material_variant', $datavar);
				$variant_code[] = $this->db->insert_id();
			}

		}

        //sku
		$sku             = $this->input->post('imaterialsku');
		$salesprice      = $this->input->post('iprice');
		$leadtime        = $this->input->post('ileadtime');
		$skunovar        = $this->input->post('imaterialsku_nonvar');
		$salespricenovar = $this->input->post('iprice_nonvar');
		$stok             = $this->input->post('istok');
		$stok_nonvar      = $this->input->post('istok_nonvar');
		$leadtimenovar   = $this->input->post('ileadtime_nonvar');
		if (!empty($sku)) 
		{
			foreach ($sku as $key => $value) 
			{

				if (!empty($selectvarian)) {
					$datasku['material_sku']    = $value;
					$datasku['material_price']  = $salesprice[$key];
					$datasku['early_stock']     = $stok[$key];
					$datasku['leadtime']        = $leadtime[$key];
					$datasku['material_code']   = $material_code;
					$datasku['mv_code']         = $variant_code[$key];
					$this->db->insert('material_sku', $datasku);

				} else {
					$datasku['material_sku']    = $skunovar;
					$datasku['material_price']  = $salespricenovar;
					$datasku['early_stock']     = $stok_nonvar;
					$datasku['leadtime']        = $leadtimenovar;
					$datasku['material_code']   = $material_code;
					$this->db->insert('material_sku', $datasku);

				}
			}

		}

		
		$valuestok_nonvar = $stok_nonvar*$salespricenovar;
		if (!empty($sku)) 
		{
			foreach ($sku as $key => $value) 
			{

				if (!empty($selectvarian)) {
					$dataInv['material_sku']   = $value;
					$dataInv['quantity']       =  $stok[$key];
					$dataInv['value_in_stock'] = $stok[$key]*$salesprice[$key];
					$this->db->insert('inventory_stock', $dataInv);

				} else {
					$dataInv['material_sku']   = $skunovar;
					$dataInv['quantity']       = $stok_nonvar;
					$dataInv['value_in_stock'] = $valuestok_nonvar;
					$this->db->insert('inventory_stock', $dataInv);

				}
			}

		}
		$this->db->trans_complete(); 


	}

	//update function begin

	public function updatematerial()
	{
		$materialcode                   = $this->input->post('imaterialcode');
		$datamaterial['category_id']    = $this->input->post('selcategory');
		$datamaterial['material_name']  = $this->input->post('imaterialname');
		$datamaterial['material_brand'] = $this->input->post('imaterialbrand');
		$datamaterial['material_unit']  = $this->input->post('iunit');
		return $this->db->update('material_item', $datamaterial, array('material_code' => $materialcode));  

	}

	public function deleteforupdate()
	{
		$variantcode  = $this->input->post('idvariant_material');
		foreach ($variantcode as $key => $value) 
		{
			$variant_code = $value;
			$this->db->where('mv_code', $variant_code);
			$this->db->delete('material_variant');
		}
	}

	public function insertforupdate()
	{
		$materialcode = $this->input->post('imaterialcode');
		$varianopt    = $this->input->post('editvarianopt');
		$optvalue     = $this->input->post('ivarianval_material');
		if (!empty($varianopt) && ! empty($optvalue) ) 
		{
			foreach ($optvalue as $key => $value) 
			{
				$datavar['material_code'] = $materialcode;
				$datavar['mv_option']     = $varianopt;
				$datavar['mv_value']      = $value;
				$this->db->insert('material_variant', $datavar);
				$variant_code[] = $this->db->insert_id();
			}

		}

        //sku
		$sku      = $this->input->post('imaterialsku');
		$price    = $this->input->post('iprice');
		$leadtime = $this->input->post('ileadtime');
		if (!empty($sku)) 
		{
			foreach ($sku as $key => $value) 
			{

				if (!empty($varianopt)) {
					$datasku['material_sku']   = $value;
					$datasku['material_price'] = $price[$key];
					$datasku['leadtime']       = $leadtime[$key];
					$datasku['material_code']  = $materialcode;
					$datasku['mv_code']        = $variant_code[$key];
					$this->db->insert('material_sku', $datasku);

				} else {
					$datasku['material_sku']   = $this->input->post('imaterialsku_nonvar');
					$datasku['material_price'] = $this->input->post('iprice_nonvar');
					$datasku['leadtime']       = $this->input->post('ileadtime_nonvar');
					return $this->db->update('material_sku', $datasku, array('material_code' => $materialcode));

				}
			}

		}

	}

	public function deletematerial($material_code)
	{
		return $this->db->delete('material_item', array("material_code" => $material_code));
	}


}