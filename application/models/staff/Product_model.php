<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model
{

    function getRows($params = array()){

        $this->db->select('a.category_name, b.product_code, b.product_name, c.product_sku, c.sku_id, b.product_brand, b.unit, c.sales_price, d.variant_option, d.option_value, count(e.material_sku) as jumlah');
        $this->db->from('product_category a');
        $this->db->join('product b', 'a.category_id=b.category_id');
        $this->db->join('product_sku c', 'b.product_code=c.product_code');
        $this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
        $this->db->join('bill_of_material e', 'e.product_sku=c.product_sku','left');
        $this->db->Group_by('c.product_sku');
        
        //filter data by searched keywords
        if(!empty($params['search']['keywords'])){
            $this->db->like('b.product_name',$params['search']['keywords']);
        }
        //sort data by ascending or desceding order
        if(!empty($params['search']['sortBy'])){
            $this->db->order_by('b.product_name',$params['search']['sortBy']);
        }else{
            $this->db->order_by('c.product_sku','DESC');
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


    public function getBOM($product_sku) 
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

        $this->db->select('b.*, a.*, c.*');
        $this->db->from("($subQuery1) a");
        $this->db->join('bill_of_material b', 'a.product_sku=b.product_sku');
        $this->db->join("($subQuery2) c", 'b.material_sku=c.material_sku');
        $this->db->where('a.sku_id', $product_sku);
        $query = $this->db->get();
        return $query;
        //return $query->result_array();

    }

    public function getDetailBOM($product_sku) 
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

        $this->db->select('b.*, a.*, c.*');
        $this->db->from("($subQuery1) a");
        $this->db->join('bill_of_material b', 'a.product_sku=b.product_sku');
        $this->db->join("($subQuery2) c", 'b.material_sku=c.material_sku');
        $this->db->where('a.sku_id', $product_sku);
        $query = $this->db->get();
        return $query;

    }

    public function getMaterial()
    {
        $this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
        $this->db->from('material_category a');
        $this->db->join('material_item b', 'a.category_id=b.category_id');
        $this->db->join('material_sku c', 'b.material_code=c.material_code');
        $this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');

        $query = $this->db->get();
        return $query;
    }


    public function getMaterialAjax($material_sku)
    {

        $this->db->select('a.category_name, b.material_code, b.material_name, c.material_sku, b.material_brand, b.material_unit, c.material_price, c.leadtime, d.mv_option, d.mv_value');
        $this->db->from('material_category a');
        $this->db->join('material_item b', 'a.category_id=b.category_id');
        $this->db->join('material_sku c', 'b.material_code=c.material_code');
        $this->db->join('material_variant d', 'c.mv_code=d.mv_code','left');
        $this->db->where('c.material_sku', $material_sku);

        $query = $this->db->get();
        return $query;
    }

    public function getCategory()
    {
        $query = $this->db->get('product_category');
        return $query;
    }

    public function getUnit()
    {
        $query = $this->db->get('unit_of_measure');
        return $query;
    }

    public function getMasterVariant()
    {
        $query = $this->db->get('master_variant_product');
        return $query;
    }

    function getproductSKU(){
        $q      = $this->db->query("SELECT MAX(RIGHT(product_sku,2)) AS sku_max FROM product_sku");
        $prefix = "PS";
        $kd     = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->sku_max)+1;
                $kd  = sprintf("%02s", $tmp);
            }
        }else{
            $kd = "01";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $prefix.('-').date('dmy').$kd;
    }

    public function savecategory() 
    {
        $post                     = $this->input->post();
        $this->category_name      = $post["icategory"];
        return $this->db->insert('product_category', $this);
    }

    public function saveunit() 
    {
        $post              = $this->input->post();
        $this->unit_name   = $post["iuom"];
        return $this->db->insert('unit_of_measure', $this);
    }

    public function savemastervariant() 
    {
        $post               = $this->input->post();
        $this->variant_name = $post["imastervariant"];
        return $this->db->insert('master_variant_product', $this);
    }

    public function getById($product_code)
    {

        $this->db->select('a.category_id, a.category_name, b.product_code, b.product_name, c.sku_id, c.product_sku, b.product_brand, b.unit, c.sales_price,d.variant_code, d.variant_option, d.option_value');
        $this->db->from('product_category a');
        $this->db->join('product b', 'a.category_id=b.category_id');
        $this->db->join('product_sku c', 'b.product_code=c.product_code');
        $this->db->join('product_variant d', 'c.variant_code=d.variant_code','left');
        $this->db->where('b.product_code', $product_code);

        return $this->db->get();    

    }

    public function saveproductcard()
    {
        $this->db->trans_start();
        //product
        $dataprod['product_code']  = $this->input->post('id_product');
        $dataprod['category_id']   = $this->input->post('selcategory');
        $dataprod['product_name']  = $this->input->post('iproductname');
        $dataprod['product_brand'] = $this->input->post('iproductbrand');
        $dataprod['unit']          = $this->input->post('iunit');
        $this->db->insert('product', $dataprod);  
        $product_code = $this->db->insert_id();

        //variant
        $selectvarian = $this->input->post('selectvarian');
        $varianopt    = $this->input->post('varianopt');
        $optvalue     = $this->input->post('ivarianval');
        if (! empty($varianopt) && ! empty($optvalue) ) 
        {
            foreach ($optvalue as $key => $value) 
            {

                $datavar['product_code']   = $product_code;
                $datavar['variant_option'] = $varianopt;
                $datavar['option_value']   = $value;
                $this->db->insert('product_variant', $datavar);
                $variant_code[] = $this->db->insert_id();
            }

        }

        //sku
        $sku        = $this->input->post('iproductsku');
        $salesprice = $this->input->post('isalesprice');
        $skunovar   = $this->input->post('iproductsku_nonvar');
        $salespricenovar = $this->input->post('isalesprice_nonvar');
        if (!empty($sku)) 
        {
            foreach ($sku as $key => $value) 
            {

                if (!empty($selectvarian)) {
                    $datasku['product_sku']  = $value;
                    $datasku['sales_price']  = $salesprice[$key];
                    $datasku['product_code'] = $product_code;
                    $datasku['variant_code'] = $variant_code[$key];
                    $this->db->insert('product_sku', $datasku);

                } else {
                    $datasku['product_sku']  = $skunovar;
                    $datasku['sales_price']  = $salespricenovar;
                    $datasku['product_code'] = $product_code;
                    $this->db->insert('product_sku', $datasku);

                }
            }

        }
        $this->db->trans_complete(); 
    }

    public function savebillofmaterial()
    {
     $product_sku  = $this->input->post('selprod_bom');
     $material_sku = $this->input->post('selitem_material');
     $quantity     = $this->input->post('iqty_bom');
     if (!empty($product_sku) && ! empty($material_sku) ) 
     {
        foreach ($material_sku as $key => $value) 
        {

            $databom['product_sku']   = $product_sku;
            $databom['material_sku']  = $value;
            $databom['qty']           = $quantity[$key];
            $this->db->insert('bill_of_material', $databom);
        }

    }
}

//update function begin

public function updateproduct()
{
    $productcode               = $this->input->post('iproductcode');
    $dataprod['category_id']   = $this->input->post('selcategory');
    $dataprod['product_name']  = $this->input->post('iproductname');
    $dataprod['product_brand'] = $this->input->post('iproductbrand');
    $dataprod['unit']          = $this->input->post('iunit');
    return $this->db->update('product', $dataprod, array('product_code' => $productcode));  

}

public function deleteforupdate()
{
    $variantcode  = $this->input->post('idvariant');
    foreach ($variantcode as $key => $value) 
    {
        $variant_code = $value;
        $this->db->where('variant_code', $variant_code);
        $this->db->delete('product_variant');
    }
}

public function insertforupdate()
{

    $productcode  = $this->input->post('iproductcode');
    $varianopt    = $this->input->post('editvarianopt');
    $optvalue     = $this->input->post('ivarianval');
    if (! empty($varianopt) && ! empty($optvalue) ) 
    {
        foreach ($optvalue as $key => $value) 
        {
            $datavar['product_code']   = $productcode;
            $datavar['variant_option'] = $varianopt;
            $datavar['option_value']   = $value;
            $this->db->insert('product_variant', $datavar);
            $variant_code[] = $this->db->insert_id();
        }

    }

        //sku
    $sku        = $this->input->post('iproductsku');
    $salesprice = $this->input->post('isalesprice');
    if (!empty($sku)) 
    {
        foreach ($sku as $key => $value) 
        {

            if (!empty($varianopt)) {
                $datasku['product_sku']  = $value;
                $datasku['sales_price']  = $salesprice[$key];
                $datasku['product_code'] = $productcode;
                $datasku['variant_code'] = $variant_code[$key];
                $this->db->insert('product_sku', $datasku);

            } else {
                $datasku['product_sku'] = $this->input->post('iproductsku_nonvar');
                $datasku['sales_price'] = $this->input->post('isalesprice_nonvar');
                return $this->db->update('product_sku', $datasku, array('product_code' => $productcode));

            }
        }

    }


}

//update function end

public function deleteproduct($product_code)
{
    return $this->db->delete('product', array("product_code" => $product_code));
}




}