<?php
class Home_model extends CI_Model
{

	public function getProductionMemo(){

		$this->db->select('a.mo_code,a.mo_id, c.*, a.created_date, a.production_start, a.prod_deadline, a.production_cost, a.total_cost, a.additional_info, a.status, b.quantity, COUNT(b.product_sku) as jumlah_produk');
		$this->db->from('manufacturing_order a');
		$this->db->join('detail_manufacturing_order b','a.mo_id=b.mo_id');
		$this->db->join('customer c','c.customer_id=a.customer_id');
		$this->db->Group_by('a.mo_id');
		return $this->db->get();
	}
}

	