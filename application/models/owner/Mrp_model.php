<?php
class Mrp_model extends CI_Model
{

 public function getRows($params = array()){


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

  $this->db->select('b.mrp_code,e.mo_id, e.mo_code, d.quantity as jml_prod,f.unit, f.product_sku, f.product_name,f.variant_option, f.option_value, b.created_date, g.material_name, g.mv_value, a.gross_req, a.net_req, a.PORel, a.qty_PORel, h.quantity as stok, i.schedule_receipt, i.quantity_po,k.*');
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
  //$this->db->where('a.id_det_mo is NULL');
  $this->db->Group_by('b.mrp_code');


        //sort data by ascending or desceding order
  if(!empty($params['search']['sortBy'])){
    $this->db->order_by('b.created_date',$params['search']['sortBy']);
  }else{
    $this->db->order_by('b.created_date','DESC');
  }
  if(!empty($params['search']['filterDate'])){
    $this->db->where('e.mo_id',$params['search']['filterDate']);
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

public function getdetailMRP($mrp_code)
{
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

 $this->db->select('b.mrp_id,b.mrp_code, e.mo_code, d.quantity as jml_prod, f.*, b.created_date, g.*, a.gross_req, a.net_req, a.PORel, a.qty_PORel, h.quantity as stok, i.schedule_receipt, i.quantity_po, e.*, c.*,k.*');
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
 $this->db->Group_by('g.material_sku');
 $this->db->where('b.mrp_code', $mrp_code);
 return $this->db->get();  
}

public function getrecapMRP($mo_id)
{
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

 $this->db->select('b.mrp_id,b.mrp_code, e.mo_code, d.quantity as jml_prod, f.*, b.created_date, g.*, SUM(a.gross_req) as grossreq, SUM(a.net_req) as netreq, a.PORel, SUM(a.qty_PORel) as qtyporel, h.quantity as stok, i.schedule_receipt, i.quantity_po, e.*, c.*,k.*');
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
 $this->db->where('e.mo_id', $mo_id);
 $this->db->Group_by('g.material_sku');
 return $this->db->get();  
}

public function getproductrecapMRP($mo_id)
{
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

 $this->db->select('f.*,e.*,d.quantity as jml_prod,k.*');
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
 $this->db->where('e.mo_id', $mo_id);
 $this->db->Group_by('f.product_sku');
 return $this->db->get();  
}



public function getProductList($selmo_code)
{

  $this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, c.sku_id, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
  $this->db->from('product_category a');
  $this->db->join('product b', 'a.category_id=b.category_id');
  $this->db->join('product_sku c', 'b.product_code=c.product_code');
  $this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
  $subQuery1 = $this->db->get_compiled_select();


  $this->db->select('a.*,b.*,c.*,e.*');
  $this->db->from("($subQuery1) a");
  $this->db->join('detail_manufacturing_order b', 'a.product_sku=b.product_sku');
  $this->db->join('manufacturing_order c', 'b.mo_id=c.mo_id');
  $this->db->join('detail_mrp d', 'b.id_det_mo=d.id_det_mo','left');
  $this->db->join('customer e','e.customer_id=c.customer_id');

  if(!empty($selmo_code)){
    $this->db->where('c.mo_id',$selmo_code);
    $this->db->where('d.id_det_mo IS NULL');
  }

  $query = $this->db->get();
  return $query;
}

public function getmaterial($sel_prod)
{

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

  $this->db->select('a.product_sku, a.product_name,a.variant_option, a.option_value, c.material_name,c.mv_option, c.mv_value, c.material_unit,c.leadtime,b.*,d.*, e.id_det_po, e.supplier_id, e.quantity_po, e.schedule_receipt, e.status_po, f.*');
  $this->db->from("($subQuery1) a");
  $this->db->join('bill_of_material b', 'a.product_sku=b.product_sku');
  $this->db->join("($subQuery2) c", 'c.material_sku=b.material_sku');
  $this->db->join('inventory_stock d', 'd.material_sku=c.material_sku');
  $this->db->join('detail_po e', 'e.inv_id=d.inv_id','left');
  $this->db->join('purchase_order f', 'f.po_id=e.po_id','left');
  $this->db->Group_by('c.material_sku');


  if(!empty($sel_prod)){
    $this->db->where('a.product_sku', $sel_prod);
  }

  $query = $this->db->get();
  return $query;

}

public function getdetmanufacturing($selmo_code,$sel_prod)
{

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

  $this->db->select('a.product_sku, a.product_name,a.variant_option, a.option_value, c.material_name,c.mv_option, c.mv_value, d.*, e.*, i.*,f.inv_id');
  $this->db->from("($subQuery1) a");
  $this->db->join('bill_of_material b', 'a.product_sku=b.product_sku');
  $this->db->join("($subQuery2) c", 'c.material_sku=b.material_sku');
  $this->db->join('detail_manufacturing_order d', 'd.product_sku=a.product_sku');
  $this->db->join('manufacturing_order e', 'e.mo_id=d.mo_id');
  $this->db->join('inventory_stock f', 'f.material_sku=c.material_sku','left');
  $this->db->join('detail_po g', 'g.inv_id=f.inv_id','left');
  $this->db->join('purchase_order h', 'h.po_id=g.po_id','left');
  $this->db->join('customer i','i.customer_id=e.customer_id');

  $conditions = ['e.mo_id' => $selmo_code, 'a.product_sku' => $sel_prod];
  $this->db->where($conditions);


  $query = $this->db->get();
  return $query;

}

public function getproduct2($selmo_code)
{

  $this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, c.sku_id, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value');
  $this->db->from('product_category a');
  $this->db->join('product b', 'a.category_id=b.category_id');
  $this->db->join('product_sku c', 'b.product_code=c.product_code');
  $this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
  $subQuery1 = $this->db->get_compiled_select();

  $this->db->select('a.*,d.*,e.*');
  $this->db->from("($subQuery1) a");
  $this->db->join('detail_manufacturing_order d', 'a.product_sku=d.product_sku');
  $this->db->join('manufacturing_order e', 'e.mo_id=d.mo_id');

  
  if(!empty($selmo_code)){
    $this->db->where('e.mo_id',$selmo_code);
  }

  $query = $this->db->get();
  return ($query->num_rows() > 0)?$query->result_array():FALSE;

}


public function getMRP_ID()
{
  $q = $this->db->query("SELECT MAX(RIGHT(mrp_code,2)) AS mrp_max FROM mrp");
  $prefix = "MRP";
  $kd = "";
  if($q->num_rows()>0){
    foreach($q->result() as $k){
      $tmp = ((int)$k->mrp_max)+1;
      $kd = sprintf("%02s", $tmp);
    }
  }else{
    $kd = "01";
  }
  date_default_timezone_set('Asia/Jakarta');
  return $prefix.('-').date('dmy').('-').$kd;
}


public function getMOlist()
{


  $this->db->select('a.*,b.*');
  $this->db->from('manufacturing_order a');
  $this->db->join('customer b', 'a.customer_id=b.customer_id');
  return $this->db->get();

}

public function insertmrp()
{

  $dataMRP['mrp_code']        = $this->input->post('ino_mrp');
  $dataMRP['created_date']    = $this->input->post('icreate_date');
  $dataMRP['set_by']          = "Admin";

  $this->db->insert('mrp', $dataMRP);  
  $mrpID = $this->db->insert_id();

  $detMO     = $this->input->post('id_det_mo');
  $bomCode   = $this->input->post('ibom_code');
  $grossreq  = $this->input->post('igrossreq');
  $netReq    = $this->input->post('inetreq');
  $porel     = $this->input->post('iporel');
  $iQTYporel = $this->input->post('iqtyporel');
  if (!empty($bomCode)) 
  {
    foreach ($bomCode as $key => $value) 
    {

      $dataDetMRP['id_det_mo']   = $detMO;
      $dataDetMRP['bom_code']    = $value;
      $dataDetMRP['mrp_id']      = $mrpID;
      $dataDetMRP['gross_req']   = $grossreq[$key];
      $dataDetMRP['net_req']     = $netReq[$key];
      $dataDetMRP['PORel']       = $porel[$key];
      $dataDetMRP['qty_PORel']   = $iQTYporel[$key];
      $this->db->insert('detail_mrp', $dataDetMRP);
    }

  }

  $invID     = $this->input->post('invid');
  $stok      = $this->input->post('istok');
  if (!empty($invID)) 
  {
    foreach ($invID as $key => $value) 
    {

      $inv_id                 = $value;
      $dataINV['quantity']    = max($stok[$key] - $netReq[$key],0);
      $this->db->update('inventory_stock', $dataINV, array('inv_id' => $inv_id));  
    }

    //perhitungan stok
    // $stok = "2";
    // $sell = "6";
    // echo max($result = $stok - $sell,0);

  }
}

public function deleteMRP($mrp_id)
{
  return $this->db->delete('mrp', array("mrp_id" => $mrp_id));
}


}