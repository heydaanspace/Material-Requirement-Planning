<?php
class report_model extends CI_Model
{
	public function getCustomer() 
	{
		$query = $this->db->get('customer');
		return $query;
	}

	public function getMOlist()
	{
		$this->db->select('a.*,b.*');
		$this->db->from('manufacturing_order a');
		$this->db->join('customer b', 'a.customer_id=b.customer_id');
		return $this->db->get();
	}

	public function getMaterial() 
	{
		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$subQueryMaterial = $this->db->get_compiled_select();


		$this->db->select('a.*,b.*');
		$this->db->from("($subQueryMaterial) a");
		$this->db->join('inventory_stock b','a.material_sku=b.material_sku');
		return $this->db->get();
	}

	public function getMrpReport($params = array()){
		$this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, c.sku_id, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
		$this->db->from('product_category a');
		$this->db->join('product b', 'a.category_id=b.category_id');
		$this->db->join('product_sku c', 'b.product_code=c.product_code');
		$this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
		$subQuery1 = $this->db->get_compiled_select();

		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$subQuery2 = $this->db->get_compiled_select();

		$this->db->select('b.mrp_id,b.mrp_code,e.mo_id, e.mo_code, d.quantity as jml_prod, f.*, b.created_date, g.*, 
			COUNT(DISTINCT g.material_sku) as qty_material, a.gross_req, a.net_req, a.PORel, a.qty_PORel, h.quantity as stok, i.schedule_receipt, i.quantity_po, e.*, c.*,k.*');
		$this->db->from('detail_mrp a');
		$this->db->join('mrp b','a.mrp_id=b.mrp_id');
		$this->db->join('bill_of_material c','a.bom_code=c.bom_code');
		$this->db->join('detail_manufacturing_order d','a.id_det_mo=d.id_det_mo');
		$this->db->join('manufacturing_order e','d.mo_id=e.mo_id');
		$this->db->join("($subQuery1) f",'c.product_sku=f.product_sku');
		$this->db->join("($subQuery2) g",'c.material_sku=g.material_sku');
		$this->db->join('inventory_stock h','c.material_sku=h.material_sku');
		$this->db->join('detail_po i','h.inv_id=i.inv_id','left');
		$this->db->join('purchase_order j','i.po_id=j.po_id','left');
		$this->db->join('customer k','k.customer_id=e.customer_id');
		$this->db->Group_by('b.mrp_code');

        //filter data by searched keywords
		if(!empty($params['search']['selprod'])){
			$this->db->where('e.mo_id',$params['search']['selprod']);
		}
		if(!empty($params['search']['startDate']) && !empty($params['search']['endDate'])){
			$this->db->where('b.created_date >=',$params['search']['startDate']);
			$this->db->where('b.created_date <=',$params['search']['endDate']);
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

	public function getPrintMrpReport($params = array()){
		$this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, c.sku_id, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
		$this->db->from('product_category a');
		$this->db->join('product b', 'a.category_id=b.category_id');
		$this->db->join('product_sku c', 'b.product_code=c.product_code');
		$this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
		$subQuery1 = $this->db->get_compiled_select();

		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$subQuery2 = $this->db->get_compiled_select();

		$this->db->select('b.mrp_id,b.mrp_code,e.mo_id, e.mo_code, d.quantity as jml_prod, f.*, b.created_date, g.*, 
			COUNT(DISTINCT g.material_sku) as qty_material, a.gross_req, a.net_req, a.PORel, a.qty_PORel, h.quantity as stok, i.schedule_receipt, i.quantity_po, e.*, c.*,k.*');
		$this->db->from('detail_mrp a');
		$this->db->join('mrp b','a.mrp_id=b.mrp_id');
		$this->db->join('bill_of_material c','a.bom_code=c.bom_code');
		$this->db->join('detail_manufacturing_order d','a.id_det_mo=d.id_det_mo');
		$this->db->join('manufacturing_order e','d.mo_id=e.mo_id');
		$this->db->join("($subQuery1) f",'c.product_sku=f.product_sku');
		$this->db->join("($subQuery2) g",'c.material_sku=g.material_sku');
		$this->db->join('inventory_stock h','c.material_sku=h.material_sku');
		$this->db->join('detail_po i','h.inv_id=i.inv_id','left');
		$this->db->join('purchase_order j','i.po_id=j.po_id','left');
		$this->db->join('customer k','k.customer_id=e.customer_id');
		$this->db->Group_by('b.mrp_code');

        //filter data by searched keywords
		if(!empty($params['search']['selprod'])){
			$this->db->where('e.mo_id',$params['search']['selprod']);
		}
		if(!empty($params['search']['startDate']) && !empty($params['search']['endDate'])){
			$this->db->where('b.created_date >=',$params['search']['startDate']);
			$this->db->where('b.created_date <=',$params['search']['endDate']);
		}
		return $this->db->get();
	}


	public function getInstockReport($params = array()){
		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$subQueryMaterial = $this->db->get_compiled_select();


		$this->db->select('a.*,b.*,c.*,d.*');
		$this->db->from("($subQueryMaterial) a");
		$this->db->join('inventory_stock b','a.material_sku=b.material_sku');
		$this->db->join('detail_po c','b.inv_id=c.inv_id');
		$this->db->join('purchase_order d','c.po_id=d.po_id');
		$status = "Sudah diterima";
		$this->db->where('c.status_po', $status);

        //filter data by searched keywords
		if(!empty($params['search']['selmaterial'])){
			$this->db->where('a.material_sku',$params['search']['selmaterial']);
		}
		if(!empty($params['search']['startDate']) && !empty($params['search']['endDate'])){
			$this->db->where('d.created_date >=',$params['search']['startDate']);
			$this->db->where('d.created_date <=',$params['search']['endDate']);
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

	public function getPrintInstockReport($params = array()){
		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$subQueryMaterial = $this->db->get_compiled_select();


		$this->db->select('a.*,b.*,c.*,d.*');
		$this->db->from("($subQueryMaterial) a");
		$this->db->join('inventory_stock b','a.material_sku=b.material_sku');
		$this->db->join('detail_po c','b.inv_id=c.inv_id');
		$this->db->join('purchase_order d','c.po_id=d.po_id');
		$status = "Sudah diterima";
		$this->db->where('c.status_po', $status);

		if(!empty($params['search']['selmaterial'])){
			$this->db->where('a.material_sku',$params['search']['selmaterial']);
		}
		if(!empty($params['search']['startDate']) && !empty($params['search']['endDate'])){
			$this->db->where('d.created_date >=',$params['search']['startDate']);
			$this->db->where('d.created_date <=',$params['search']['endDate']);
		}
		return $this->db->get();
	}

	public function getOutstockReport($params = array()){
		$this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, c.sku_id, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
		$this->db->from('product_category a');
		$this->db->join('product b', 'a.category_id=b.category_id');
		$this->db->join('product_sku c', 'b.product_code=c.product_code');
		$this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
		$subQuery1 = $this->db->get_compiled_select();

		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$subQuery2 = $this->db->get_compiled_select();

		$this->db->select('b.created_date as tgl_keluar, g.*, SUM(a.gross_req) as stok_keluar, SUM(a.net_req) as netreq, a.PORel, SUM(a.qty_PORel) as qtyporel, h.quantity as stok, i.schedule_receipt, i.quantity_po, e.*, c.*');
		$this->db->from('detail_mrp a');
		$this->db->join('mrp b','a.mrp_id=b.mrp_id');
		$this->db->join('bill_of_material c','a.bom_code=c.bom_code');
		$this->db->join('detail_manufacturing_order d','a.id_det_mo=d.id_det_mo');
		$this->db->join('manufacturing_order e','d.mo_id=e.mo_id');
		$this->db->join("($subQuery1) f",'c.product_sku=f.product_sku');
		$this->db->join("($subQuery2) g",'c.material_sku=g.material_sku');
		$this->db->join('inventory_stock h','c.material_sku=h.material_sku');
		$this->db->join('detail_po i','h.inv_id=i.inv_id','left');
		$this->db->join('purchase_order j','i.po_id=j.po_id','left');
		$this->db->Group_by('a.id_det_mrp');

        //filter data by searched keywords
		if(!empty($params['search']['selmaterialoutstock'])){
			$this->db->where('g.material_sku',$params['search']['selmaterialoutstock']);
		}
		if(!empty($params['search']['startDateOutStock']) && !empty($params['search']['endDateOutStock'])){
			$this->db->where('b.created_date >=',$params['search']['startDateOutStock']);
			$this->db->where('b.created_date <=',$params['search']['endDateOutStock']);
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

	public function getPrintOutstockReport($params = array()){
		$this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, c.sku_id, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
		$this->db->from('product_category a');
		$this->db->join('product b', 'a.category_id=b.category_id');
		$this->db->join('product_sku c', 'b.product_code=c.product_code');
		$this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
		$subQuery1 = $this->db->get_compiled_select();

		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$subQuery2 = $this->db->get_compiled_select();

		$this->db->select('b.created_date as tgl_keluar, g.*, SUM(a.gross_req) as stok_keluar, SUM(a.net_req) as netreq, a.PORel, SUM(a.qty_PORel) as qtyporel, h.quantity as stok, i.schedule_receipt, i.quantity_po, e.*, c.*');
		$this->db->from('detail_mrp a');
		$this->db->join('mrp b','a.mrp_id=b.mrp_id');
		$this->db->join('bill_of_material c','a.bom_code=c.bom_code');
		$this->db->join('detail_manufacturing_order d','a.id_det_mo=d.id_det_mo');
		$this->db->join('manufacturing_order e','d.mo_id=e.mo_id');
		$this->db->join("($subQuery1) f",'c.product_sku=f.product_sku');
		$this->db->join("($subQuery2) g",'c.material_sku=g.material_sku');
		$this->db->join('inventory_stock h','c.material_sku=h.material_sku');
		$this->db->join('detail_po i','h.inv_id=i.inv_id','left');
		$this->db->join('purchase_order j','i.po_id=j.po_id','left');
		$this->db->Group_by('a.id_det_mrp');

        //filter data by searched keywords
		if(!empty($params['search']['selmaterialoutstock'])){
			$this->db->where('g.material_sku',$params['search']['selmaterialoutstock']);
		}
		if(!empty($params['search']['startDateOutStock']) && !empty($params['search']['endDateOutStock'])){
			$this->db->where('b.created_date >=',$params['search']['startDateOutStock']);
			$this->db->where('b.created_date <=',$params['search']['endDateOutStock']);
		}
		return $this->db->get();
	}

	public function getRecapstockReport($params = array()){
		
		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price,c.early_stock, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$subQuery2 = $this->db->get_compiled_select();

		$this->db->select('g.*, SUM(a.gross_req) as stok_keluar, h.quantity as sisa_stok, i.schedule_receipt, i.quantity_po as stok_masuk, e.*,i.status_po');
		$this->db->from('detail_mrp a');
		$this->db->join('mrp b','a.mrp_id=b.mrp_id');
		$this->db->join('bill_of_material c','a.bom_code=c.bom_code');
		$this->db->join('detail_manufacturing_order d','a.id_det_mo=d.id_det_mo');
		$this->db->join('manufacturing_order e','d.mo_id=e.mo_id');
		$this->db->join("($subQuery2) g","c.material_sku=g.material_sku");
		$this->db->join('inventory_stock h','c.material_sku=h.material_sku');
		$this->db->join('detail_po i','h.inv_id=i.inv_id','left');
		$this->db->join('purchase_order j','i.po_id=j.po_id','left');
		//$this->db->where("(i.status_po ='Belum diterima' OR i.status_po='Sudah diterima' OR 'i.status_po IS NULL' )");
		$this->db->Group_by('g.material_sku');

        //filter data by searched keywords
		if(!empty($params['search']['selmaterialrecap'])){
			$this->db->where('g.material_sku',$params['search']['selmaterialrecap']);
		}
		if(!empty($params['search']['startDateRecap']) && !empty($params['search']['endDateRecap'])){
			$this->db->where('e.production_start >=',$params['search']['startDateRecap']);
			$this->db->where('e.production_start <=',$params['search']['endDateRecap']);
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

	public function getPrintRecapstockReport($params = array()){
		
		$this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price,c.early_stock, c.leadtime, d.mv_option, d.mv_value');
		$this->db->from('material_category a');
		$this->db->join('material_item b', 'a.category_id=b.category_id');
		$this->db->join('material_sku c', 'b.material_code=c.material_code');
		$this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
		$subQuery2 = $this->db->get_compiled_select();

		$this->db->select('g.*, SUM(a.gross_req) as stok_keluar, h.quantity as sisa_stok, i.schedule_receipt, i.quantity_po as stok_masuk, e.*,i.status_po');
		$this->db->from('detail_mrp a');
		$this->db->join('mrp b','a.mrp_id=b.mrp_id');
		$this->db->join('bill_of_material c','a.bom_code=c.bom_code');
		$this->db->join('detail_manufacturing_order d','a.id_det_mo=d.id_det_mo');
		$this->db->join('manufacturing_order e','d.mo_id=e.mo_id');
		$this->db->join("($subQuery2) g","c.material_sku=g.material_sku");
		$this->db->join('inventory_stock h','c.material_sku=h.material_sku');
		$this->db->join('detail_po i','h.inv_id=i.inv_id','left');
		$this->db->join('purchase_order j','i.po_id=j.po_id','left');
		//$this->db->where("(i.status_po ='Belum diterima' OR i.status_po='Sudah diterima' OR 'i.status_po IS NULL' )");
		$this->db->Group_by('g.material_sku');

        //filter data by searched keywords
		if(!empty($params['search']['selmaterialrecap'])){
			$this->db->where('g.material_sku',$params['search']['selmaterialrecap']);
		}
		if(!empty($params['search']['startDateRecap']) && !empty($params['search']['endDateRecap'])){
			$this->db->where('e.production_start >=',$params['search']['startDateRecap']);
			$this->db->where('e.production_start <=',$params['search']['endDateRecap']);
		}

		return $this->db->get();
	}

		// public function getInvoiceProductionReport($params = array()){
	// 	$this->db->select('a.mo_code,a.mo_id, c.*, a.created_date, a.production_start, a.prod_deadline, a.production_cost, a.total_cost, a.additional_info, a.status, b.quantity');
	// 	$this->db->from('manufacturing_order a');
	// 	$this->db->join('detail_manufacturing_order b','a.mo_id=b.mo_id');
	// 	$this->db->join('customer c','c.customer_id=a.customer_id');
	// 	$this->db->Group_by('a.mo_id');

	// 	//filter data by customer
	// 	if(!empty($params['search']['selcustomer'])){
	// 		$this->db->where('c.customer_name',$params['search']['selcustomer']);
	// 	}

	// 	if(!empty($params['search']['startDate']) && !empty($params['search']['endDate'])){
	// 		$this->db->where('a.production_start >=',$params['search']['startDate']);
	// 		$this->db->where('a.production_start <=',$params['search']['endDate']);
	// 	}

	// 	//set start and limit
	// 	if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
	// 		$this->db->limit($params['limit'],$params['start']);
	// 	}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
	// 		$this->db->limit($params['limit']);
	// 	}
	// 			//get records
	// 	$query = $this->db->get();
	// 			//return fetched data
	// 	return ($query->num_rows() > 0)?$query->result_array():FALSE;
	// }




}