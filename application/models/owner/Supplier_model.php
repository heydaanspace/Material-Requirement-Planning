<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model
{
    private $tbsupplier = "supplier";

    
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('supplier');
        //filter data by searched keywords
        if(!empty($params['supsearch']['supkeywords'])){
            $this->db->like('supplier_name',$params['supsearch']['supkeywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['supsearch']['supsortBy'])){
            $this->db->order_by('supplier_name',$params['supsearch']['supsortBy']);
        }else{
            $this->db->order_by('supplier_id','desc');
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
    
    public function getById($supplier_id)
    {
        return $this->db->get_where($this->tbsupplier, ["supplier_id" => $supplier_id])->row();
    }
    public function save()
    {
        $post                   = $this->input->post();
        $this->supplier_id      = uniqid();
        $this->supplier_name    = $post["supplier_name"];
        $this->owner_name       = $post["owner_name"];
        $this->supplier_telp    = $post["supplier_telp"];
        $this->supplier_email   = $post["supplier_email"];
        $this->supplier_address = $post["supplier_address"];
        return $this->db->insert($this->tbsupplier, $this);
    }

    public function update()
    {
        $post                   = $this->input->post();
        $this->supplier_id      = $post["supplier_id"];
        $this->supplier_name    = $post["supplier_name"];
        $this->owner_name       = $post["owner_name"];
        $this->supplier_telp    = $post["supplier_telp"];
        $this->supplier_email   = $post["supplier_email"];
        $this->supplier_address = $post["supplier_address"];
        return $this->db->update($this->tbsupplier, $this, array('supplier_id' => $post['supplier_id']));
    }

    public function delete($supplier_id)
    {
        return $this->db->delete($this->tbsupplier, array("supplier_id" => $supplier_id));
    }

}