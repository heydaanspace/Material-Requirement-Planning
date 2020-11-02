<?php
class Purchase_order_model extends CI_Model
{

  public function getRows($params = array()){

    $this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
    $this->db->from('material_category a');
    $this->db->join('material_item b', 'a.category_id=b.category_id');
    $this->db->join('material_sku c', 'b.material_code=c.material_code');
    $this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
    $subQueryMaterial = $this->db->get_compiled_select();


    $this->db->select('a.*,b.*,c.*,d.*,count(d.po_id) as jml_item,e.*');
    $this->db->from("($subQueryMaterial) a");
    $this->db->join('inventory_stock b','a.material_sku=b.material_sku');
    $this->db->join('detail_po c','b.inv_id=c.inv_id');
    $this->db->join('purchase_order d','c.po_id=d.po_id');
    $this->db->join('supplier e','e.supplier_id=c.supplier_id');
    $this->db->Group_by('d.po_code');


        //sort data by ascending or desceding order
    if(!empty($params['search']['sortBy'])){
      $this->db->order_by('d.created_date',$params['search']['sortBy']);
    }else{
      $this->db->order_by('d.created_date','DESC');
    }
    //filter by date
    if(!empty($params['search']['filterBy'])){
      $this->db->where('c.status_po',$params['search']['filterBy']);
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

  public function getPO_ID()
  {
    $q = $this->db->query("SELECT MAX(RIGHT(po_code,2)) AS po_max FROM purchase_order");
    $prefix = "PO";
    $kd = "";
    if($q->num_rows()>0){
      foreach($q->result() as $k){
        $tmp = ((int)$k->po_max)+1;
        $kd = sprintf("%02s", $tmp);
      }
    }else{
      $kd = "01";
    }
    date_default_timezone_set('Asia/Jakarta');
    return $prefix.('-').date('dmy').('-').$kd;
  }

  public function getSupplier() 
  {
    $query = $this->db->get('supplier');
    return $query;
  }

  public function getitemMaterial()
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

 public function getitemMaterialAjax($inv_id)
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
   $this->db->where('b.inv_id', $inv_id);
   return $this->db->get();
 }

 public function getItemPO($po_id) 
 {

  $this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
  $this->db->from('material_category a');
  $this->db->join('material_item b', 'a.category_id=b.category_id');
  $this->db->join('material_sku c', 'b.material_code=c.material_code');
  $this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
  $subQueryMaterial = $this->db->get_compiled_select();


  $this->db->select('a.*,b.*,c.*,d.*,e.*');
  $this->db->from("($subQueryMaterial) a");
  $this->db->join('inventory_stock b','a.material_sku=b.material_sku');
  $this->db->join('detail_po c','b.inv_id=c.inv_id');
  $this->db->join('purchase_order d','c.po_id=d.po_id');
  $this->db->join('supplier e','e.supplier_id=c.supplier_id');
  $this->db->where('d.po_id', $po_id);
  $query = $this->db->get();
  return $query;

}

public function getpoMRP($mrp_id)
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

 $this->db->select('b.mrp_id,b.mrp_code, e.mo_code, d.quantity as jml_prod, f.*, b.created_date, g.*, a.gross_req, a.net_req, a.PORel, a.qty_PORel, h.quantity as stok,h.inv_id, i.schedule_receipt, i.quantity_po, e.*, c.*');
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
 $this->db->where('b.mrp_id', $mrp_id);
 return $this->db->get();  
}

public function getporecapMRP($mo_id)
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

 $this->db->select('b.mrp_id,b.mrp_code, e.mo_code, d.quantity as jml_prod, f.*, b.created_date, g.*, SUM(a.gross_req) as grossreq, SUM(a.net_req) as netreq, a.PORel, SUM(a.qty_PORel) as qtyporel,h.inv_id, h.quantity as stok, i.schedule_receipt, i.quantity_po, e.*, c.*,k.*');
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



public function insertpo()
{
  $dataPO['po_code']       = $this->input->post('ipo_code');
  $dataPO['created_date']  = $this->input->post('icreate_date');
  $dataPO['po_type']       = $this->input->post('ipo_type');
  $dataPO['total_cost']    = $this->input->post('igrand_total');

  $this->db->insert('purchase_order', $dataPO);  
  $poID = $this->db->insert_id();

  $invID     = $this->input->post('selitem_po');
  $supplier  = $this->input->post('selsupplier_po');
  $qty       = $this->input->post('iqty_po');
  $SR        = $this->input->post('ischedule_receipt');
  $status    = $this->input->post('istatus');
  if (!empty($invID)) 
  {
    foreach ($invID as $key => $value) 
    {

      $dataDetPO['inv_id']           = $value;
      $dataDetPO['po_id']            = $poID;
      $dataDetPO['supplier_id']    = $supplier[$key];
      $dataDetPO['quantity_po']      = $qty[$key];
      $dataDetPO['schedule_receipt'] = $SR[$key];
      $dataDetPO['status_po']        = $status[$key];
      $this->db->insert('detail_po', $dataDetPO);
    }

  }
}

public function insertporecapmrp()
{
 $dataPO['po_code']       = $this->input->post('ipo_code');
 $dataPO['created_date']  = $this->input->post('icreate_date');
 $dataPO['po_type']       = $this->input->post('ipo_type');
 $dataPO['total_cost']    = $this->input->post('igrand_total');

 $this->db->insert('purchase_order', $dataPO);  
 $poID = $this->db->insert_id();

 $invID     = $this->input->post('selitem_po');
 $supplier  = $this->input->post('selsupplier_po');
 $qty       = $this->input->post('iqty_po');
 $SR        = $this->input->post('ischedule_receipt');
 $status    = $this->input->post('istatus');
 if (!empty($invID)) 
 {
  foreach ($invID as $key => $value) 
  {

    $dataDetPO['inv_id']           = $value;
    $dataDetPO['po_id']            = $poID;
    $dataDetPO['supplier_id']      = $supplier[$key];
    $dataDetPO['quantity_po']      = $qty[$key];
    $dataDetPO['schedule_receipt'] = $SR[$key];
    $dataDetPO['status_po']        = $status[$key];
    $this->db->insert('detail_po', $dataDetPO);
  }

}
}

//update function begin
public function updatePO()
{
  $po_id                   = $this->input->post('ipo_id');
  $dataPO['total_cost']    = $this->input->post('igrand_total');
  return $this->db->update('purchase_order', $dataPO, array('po_id' => $po_id));  

}

public function deleteforupdate()
{
 $detpo  = $this->input->post('idet_po_id');
 foreach ($detpo as $key => $value) 
 {
  $id_det_po = $value;
  $this->db->where('id_det_po', $id_det_po);
  $this->db->delete('detail_po');
}
}

public function insertforupdate()
{
 $po_id     = $this->input->post('ipo_id');
 $invID     = $this->input->post('selitem_po');
 $supplier  = $this->input->post('selsupplier_po');
 $qty       = $this->input->post('iqty_po');
 $SR        = $this->input->post('ischedule_receipt');
 $status    = $this->input->post('istatus');;
 if (!empty($invID)) 
 {
  foreach ($invID as $key => $value) 
  {
    $dataDetPO['inv_id']           = $value;
    $dataDetPO['po_id']            = $po_id;
    $dataDetPO['supplier_id']      = $supplier[$key];
    $dataDetPO['quantity_po']      = $qty[$key];
    $dataDetPO['schedule_receipt'] = $SR[$key];
    $dataDetPO['status_po']        = $status[$key];
    $this->db->insert('detail_po', $dataDetPO);
  }
}
}

//update function end

public function deletePO($po_id)
{
  return $this->db->delete('purchase_order', array("po_id" => $po_id));
}

public function getDetailPOById($detpo_id) {
  $this->db->select('*');
  $this->db->from('detail_po');
  $this->db->where('id_det_po', $detpo_id);
  return $this->db->get();
}

public function updateInventoryStockQuantity($invID, $quantity_po) {
  $sql = "UPDATE inventory_stock SET quantity = quantity + ? WHERE inv_id = ?";
  $query = $this->db->query($sql, array($quantity_po, $invID));
  return $query;
}

public function StatusAccepted($detpo_id)
{

  $detail_po_item = $this->getDetailPOById($detpo_id)->result();
  $quantity_po    = $detail_po_item[0]->quantity_po;
  $status_po      = $detail_po_item[0]->status_po;
  $invID          = $detail_po_item[0]->inv_id;


  if ($status_po != "Sudah diterima") {
    $dataStatus['status_po']   = "Sudah diterima";
    // update-quantity
    $this->updateInventoryStockQuantity($invID, $quantity_po);
    // update status first
    return $this->db->update('detail_po', $dataStatus, array('id_det_po' => $detpo_id));

  } else {
    return false;
  }
}
public function StatusNotAccepted($detpo_id)
{
 // $invID                  = $this->input->post('inv_id');
 // $stok                   = $this->input->post('istokinv');
 // $qtypo                  = $this->input->post('iqtypo');
 // $updateQTY['quantity']  = $stok - $qtypo;
 // return $this->db->update('inventory_stock', $updateQTY, array('inv_id' => $invID));  

 $dataStatus['status_po']   = "Belum diterima";
 return $this->db->update('detail_po', $dataStatus, array('id_det_po' => $detpo_id));  

}

public function StatusReject($detpo_id)
{
  $dataStatus['status_po']           = "Dibatalkan";
  return $this->db->update('detail_po', $dataStatus, array('id_det_po' => $detpo_id));  

}

}