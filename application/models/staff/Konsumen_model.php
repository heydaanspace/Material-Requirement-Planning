<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Konsumen_model extends CI_Model
{
    private $tbcustomer = "customer";


    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('customer');
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('customer_name',$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('customer_name',$params['search']['sortBy']);
        }else{
            $this->db->order_by('customer_id','desc');
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

    public function getById($customer_id)
    {
        return $this->db->get_where($this->tbcustomer, ["customer_id" => $customer_id])->row();
    }

    public function save()
    {
        $post                   = $this->input->post();
        $this->customer_id      = uniqid();
        $this->customer_name    = $post["customer_name"];
        $this->brand_name       = $post["brand_name"];
        $this->customer_telp    = $post["customer_telp"];
        $this->customer_email   = $post["customer_email"];
        $this->customer_address = $post["customer_address"];
        $this->keterangan       = $post["keterangan"];
        return $this->db->insert($this->tbcustomer, $this);
    }

    public function update()
    {
        $post                   = $this->input->post();
        $this->customer_id      = $post["customer_id"];
        $this->customer_name    = $post["customer_name"];
        $this->brand_name       = $post["brand_name"];
        $this->customer_telp    = $post["customer_telp"];
        $this->customer_email   = $post["customer_email"];
        $this->customer_address = $post["customer_address"];
        $this->keterangan       = $post["keterangan"];
        return $this->db->update($this->tbcustomer, $this, array('customer_id' => $post['customer_id']));

    }

    public function delete($customer_id)
    {
        return $this->db->delete($this->tbcustomer, array("customer_id" => $customer_id));
    }
}