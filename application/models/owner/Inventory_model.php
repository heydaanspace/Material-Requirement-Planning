<?php
class Inventory_model extends CI_Model
{

  public function getRows($params = array()){

    $this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
    $this->db->from('material_category a');
    $this->db->join('material_item b', 'a.category_id=b.category_id');
    $this->db->join('material_sku c', 'b.material_code=c.material_code');
    $this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
    $subQueryMaterial = $this->db->get_compiled_select();


    $this->db->select('a.*,c.schedule_receipt, c.status_po, c.quantity_po, b.quantity, b.value_in_stock');
    $this->db->from("($subQueryMaterial) a");
    $this->db->join('inventory_stock b','a.material_sku=b.material_sku');
    $this->db->join('detail_po c','b.inv_id=c.inv_id','left');
    $this->db->join('purchase_order d','c.po_id=d.po_id','left');

        //filter data by searched keywords
    if(!empty($params['search']['keywords'])){
      $this->db->like('a.material_name',$params['search']['keywords']);
    }
        //sort data by ascending or desceding order
    if(!empty($params['search']['sortBy'])){
      $this->db->order_by('a.material_name',$params['search']['sortBy']);
    }else{
      $this->db->order_by('a.material_name','DESC');
    }
    //filter by date
    if(!empty($params['search']['sortDate'])){
      $this->db->where('c.schedule_receipt',$params['search']['sortDate']);
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




}