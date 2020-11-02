<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud_library
{


  public function loginvalidation()
  {

    return [
      ['field' => 'email',
      'label'  => 'Email',
      'rules'  => 'trim|required|min_length[5]|max_length[50]',
      'errors' => array('required' => '%s wajib diisi.')],

      ['field' => 'password',
      'label'  => 'Kata sandi',
      'rules'  => 'trim|required|min_length[5]|max_length[22]',
      'errors' => array('required' => '%s wajib diisi.')],


      ['field' => 'icaptcha',
      'label'  => 'Kode keamanan',
      'rules'  => 'required',
      'errors' => array('required' => '%s Tidak boleh kosong.')]
    ];
  }


  public function saveuser()
  {

    return [
      ['field' => 'iemail',
      'label'  => 'Email',
      'rules'  => 'trim|required|min_length[5]|max_length[50]|is_unique[user_system.email]',
      'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah digunakan')],

      ['field' => 'ipassword',
      'label'  => 'Kata sandi',
      'rules'  => 'trim|required|min_length[5]|max_length[10]',
      'errors' => array('required' => '%s wajib diisi.')],

      ['field' => 'ifullname',
      'label'  => 'Nama Pengguna',
      'rules'  => 'trim|required|min_length[5]|max_length[22]',
      'errors' => array('required' => '%s wajib diisi.')],

      ['field' => 'iusername',
      'label'  => 'Username',
      'rules'  => 'trim|required|min_length[5]|max_length[10]|is_unique[user_system.username]',
      'errors' => array('required' => '%s wajib diisi.','is_unique' => '%s Telah digunakan')],

      ['field' => 'selposition',
      'label'  => 'Posisi',
      'rules'  => 'required',
      'errors' => array('required' => '%s wajib diisi.')],

      ['field' => 'itelp',
      'label'  => 'No Telp',
      'rules'  => 'required|is_unique[user_system.no_telp]',
      'errors' => array('required' => '%s wajib diisi.','is_unique' => '%s Telah digunakan')]

    ];
  }

  public function saveuseredit()
  {
    return [
      ['field' => 'iemail',
      'label'  => 'Email',
      'rules'  => 'trim|required|min_length[5]|max_length[50]',
      'errors' => array('required' => '%s wajib diisi.')],

      ['field' => 'ifullname',
      'label'  => 'Nama Pengguna',
      'rules'  => 'trim|required|min_length[5]|max_length[22]',
      'errors' => array('required' => '%s wajib diisi.')],

      ['field' => 'iusername',
      'label'  => 'Username',
      'rules'  => 'trim|required|min_length[5]|max_length[10]',
      'errors' => array('required' => '%s wajib diisi.')],

      ['field' => 'selposition',
      'label'  => 'Posisi',
      'rules'  => 'required',
      'errors' => array('required' => '%s wajib diisi.')],

      ['field' => 'itelp',
      'label'  => 'No Telp',
      'rules'  => 'required',
      'errors' => array('required' => '%s wajib diisi.')]

    ];
  }

  public function customersave()
  {
    return [
     ['field' => 'customer_name',
     'label'  => 'Nama konsumen',
     'rules'  => 'required',
     'errors' => array('required' => '%s wajib diisi .')],

     ['field' => 'customer_email',
     'label'  => 'Email',
     'rules'  => 'required|is_unique[customer.customer_email]',
     'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah tersedia')],

     ['field' => 'customer_telp',
     'label'  => 'No telp',
     'rules'  => 'required|is_unique[customer.customer_telp]',
     'errors' => array('required' => '%s wajib diisi .','is_unique' =>'%s telah tersedia')] 
   ];
 }

 public function customeredit()
 {
  return [
   ['field' => 'customer_name',
   'label'  => 'Nama konsumen',
   'rules'  => 'required',
   'errors' => array('required' => '%s wajib diisi .')],

   ['field' => 'customer_email',
   'label'  => 'Email',
   'rules'  => 'required',
   'errors' => array('required' => '%s wajib diisi.')],

   ['field' => 'customer_telp',
   'label'  => 'No telp',
   'rules'  => 'required',
   'errors' => array('required' => '%s wajib diisi .')] 
 ];
}

public function suppliersave()
{
  return [
    ['field' => 'supplier_name',
    'label'  => 'Nama supplier',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi .')],

    ['field' => 'owner_name',
    'label'  => 'Nama pemilik',
    'errors' => array('required' => '%s wajib diisi .')],

    ['field' => 'supplier_telp',
    'label'  => 'supplier_telp',
    'rules'  => 'required|is_unique[supplier.supplier_telp]',
    'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah tersedia')],

    ['field' => 'supplier_email',
    'label'  => 'Email supplier',
    'rules'  => 'required|is_unique[supplier.supplier_email]',
    'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah tersedia')],

    ['field' => 'supplier_address',
    'label'  => 'Alamat supplier',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi .')]
  ];
}
public function supplieredit()
{
  return [
   ['field' => 'supplier_name',
   'label'  => 'Nama supplier',
   'rules'  => 'required',
   'errors' => array('required' => '%s wajib diisi .')],
   
   ['field' => 'owner_name',
   'label'  => 'Nama pemilik',
   'errors' => array('required' => '%s wajib diisi .')],

   ['field' => 'supplier_email',
   'label'  => 'Email',
   'rules'  => 'required',
   'errors' => array('required' => '%s wajib diisi.')],

   ['field' => 'supplier_telp',
   'label'  => 'No telp',
   'rules'  => 'required',
   'errors' => array('required' => '%s wajib diisi .')] 
 ];
}

public function productsave()
{
  return [
    ['field' => 'iproductname',
    'label'  => 'Nama produk',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'iproductsku[]',
    'label'  => 'SKU Produku',
    'rules'  => 'required|is_unique[product_sku.product_sku]',
    'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah digunakan')],


    ['field' => 'iproductbrand',
    'label'  => 'Merk Produk',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'isalesprice[]',
    'label'  => 'Harga Produk',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')]
  ];
}

public function productsavenonvar()
{
  return [
    ['field' => 'iproductname',
    'label'  => 'Nama produk',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'iproductsku_nonvar',
    'label'  => 'SKU Produk',
    'rules'  => 'required|is_unique[product_sku.product_sku]',
    'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah digunakan')],

    ['field' => 'iproductbrand',
    'label'  => 'Merk Produk',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi .')],

    ['field' => 'isalesprice_nonvar',
    'label'  => 'Harga Produk',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi .')]

  ];
}

public function materialsave()
{
  return [
    ['field' => 'imaterialname',
    'label'  => 'Item Material v',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'imaterialsku[]',
    'label'  => 'SKU Material v',
    'rules'  => 'required|is_unique[material_sku.material_sku]',
    'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah digunakan')],


    ['field' => 'imaterialbrand',
    'label'  => 'Merk Material v',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'iprice[]',
    'label'  => 'Harga Material v',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'ileadtime[]',
    'label'  => 'Leadtime Material v',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],
    
  ];
}

public function materialsavenonvar()
{
  return [
    ['field' => 'imaterialname',
    'label'  => 'Item Material',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'imaterialsku_nonvar',
    'label'  => 'SKU Material',
    'rules'  => 'required|is_unique[material_sku.material_sku]',
    'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah digunakan')],

    ['field' => 'imaterialbrand',
    'label'  => 'Merk Material',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi .')],

    ['field' => 'iprice_nonvar',
    'label'  => 'Harga Material',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi .')],

    ['field' => 'ileadtime_nonvar',
    'label'  => 'Leadtime Material',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')]

  ];
}

public function bomsave()
{
  return [
    ['field' => 'selprod_bom',
    'label'  => 'Item Produk',
    'rules'  => 'required|is_unique[bill_of_material.product_sku]',
    'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah direcord.')],

    ['field' => 'selitem_material[]',
    'label'  => 'Item Material',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'iqty_bom[]',
    'label'  => 'Jumlah Kebutuhan',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi .')]

  ];
}

public function manufacturing_order_save()
{
  return [
    ['field' => 'selcustomer_mo',
    'label'  => 'Nama Konsumen',
    'rules'  => 'required|is_unique[manufacturing_order.customer_id]',
    'errors' => array('required' => '%s wajib diisi.','is_unique' =>'%s telah tersedia')],

    ['field' => 'ideadline',
    'label'  => 'Deadline Produksi',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'iqty_mo[]',
    'label'  => 'Jumlah Produksi',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'iservice_rate',
    'label'  => 'Biaya produksi',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')]

  ];
}

public function manufacturing_order_update()
{
  return [
    ['field' => 'selcustomer_mo',
    'label'  => 'Nama Konsumen',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'ideadline',
    'label'  => 'Deadline Produksi',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'iqty_mo[]',
    'label'  => 'Jumlah Produksi',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')],

    ['field' => 'iservice_rate',
    'label'  => 'Biaya produksi',
    'rules'  => 'required',
    'errors' => array('required' => '%s wajib diisi.')]

  ];
}

public function mrp_save()
{
  return [
    ['field' => 'selmo_code',
    'label'  => 'No. Produksi',
    'rules'  => 'required',
    'errors' => array('required' => '%s belum ditentukan.')],

    ['field' => 'sel_prod',
    'label'  => 'Produk',
    'rules'  => 'required',
    'errors' => array('required' => '%s belum ditentukan.')],

    ['field' => 'igrossreq[]',
    'label'  => 'Kebutuhan Kotor',
    'rules'  => 'required',
    'errors' => array('required' => '%s belum dihitung.')],

    ['field' => 'inetreq[]',
    'label'  => 'Kebutuhan Bersih',
    'rules'  => 'required',
    'errors' => array('required' => '%s belum dihitung.')]

  ];
}

public function po_save()
{
  return [
    ['field' => 'selsupplier_po[]',
    'label'  => 'Mitra Supplier',
    'rules'  => 'required',
    'errors' => array('required' => '%s belum ditentukan.')],

    ['field' => 'selitem_po[]',
    'label'  => 'Item Material',
    'rules'  => 'required',
    'errors' => array('required' => '%s belum ditentukan.')],

    ['field' => 'iqty_po[]',
    'label'  => 'Jumlah PO',
    'rules'  => 'required',
    'errors' => array('required' => '%s belum ditentukan.')]

  ];
}

}
