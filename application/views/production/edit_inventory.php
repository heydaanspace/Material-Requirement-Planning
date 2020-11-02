<section class="section">

  <div class="section-header">
    <h1>Pesanan Produksi Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>production/home">Dasbor</a></div>
      <div class="breadcrumb-item"><a href="<?php echo base_url(); ?>production/manufacturing">Penanan Produksi</a></div>
      <div class="breadcrumb-item">Pesanan Produksi Baru</div>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Buat Pesanan Produksi</h4>
          </div>
          <form action="<?php echo site_url('production/manufacturing/addmanufacturingorder') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Material SKU</label>
                  <input type="text" class="form-control" name="imo_code" placeholder="" value="">
                </div>
                <div class="form-group col-md-4">
                  <label>Kategori</label>
                  <select class="form-control" id="selcustomer_mo" name="selcustomer_mo">
                    <option value=""></option>
                      <option value="">
                      </option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Deadline Produksi</label>
                  <input type="date" name="ideadline" class="form-control">
                </div>
                <div class="form-group col-md-4">
                  <label>Tanggal dibuat</label>
                  <input type="text" class="form-control" name="icreate_date" id="icreate_date" value="<?php echo $getDate; ?>" readonly>
                </div>
              </div>
              <hr>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table id="tbvarian" class="table table-bordered">
                    <tr>
                      <th>Item</th>
                      <th>Jumlah</th>
                      <th>Harga Per Item</th>
                      <th>Total Harga</th>
                      <th>Ketersediaan Bahan Baku</th>
                      <th></th>
                    </tr>
                    <tr>
                      <td style="width: 300px;">
                        <select class="form-control selitem_mo" name="selitem_mo[]" id="selitem_mo">
                          <option value=""></option>
                          <?php foreach($product_list as $product):?>
                            <?php if(!empty($product->variant_option)) {   ?>
                              <option value="<?php echo $product->product_sku ?>">
                                <?php echo $product->product_name; ?> / <?php echo $product->option_value ?>
                              </option>
                            <?php } else {  ?>
                              <option value="<?php echo $product->product_sku ?>">
                                <?php echo $product->product_name; ?>
                              </option>
                            <?php }  ?>
                          <?php endforeach;?>
                        </select>
                      </td>
                      <td>
                       <input type="text" class="form-control iqty_mo" name="iqty_mo[]" id="iqty_mo">
                     </td>
                     <td>
                       <input type="text" class="form-control isalesprice" name="isalesprice" id="isalesprice" readonly>
                     </td>
                     <td>
                      <input type="text" class="form-control isubtotal_price" name="isubtotal_price[]" id="isubtotal_price" readonly>
                    </td>
                    <td>
                      <div class="true">
                        <a class="btn_td" href="">Tidak Tersedia  <i class="fa fa-info-circle"></i></a>
                      </div>
                    </td>
                    <td>
                    </td>
                  </tr>
                </table>
                <button class="btn btn-outline-primary" type="button" name="add" id="add"><i class="fa fa-plus-square"></i> Tambah Item</button>
              </div>
            </div>
            <br>
            <hr>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Biaya Jasa Produksi</label>
                <input type="hidden" placeholder="" id="rate_service" name="rate_service" class="form-control autonumber" data-a-sep="." data-a-dec=",">
                <input type="text" class="form-control iservice_rate" name="iservice_rate" id="iservice_rate">
              </div>
              <div class="form-group col-md-6">
                <label>Total Biaya</label>
                <input type="text" class="form-control igrand_total" name="igrand_total" id="igrand_total" readonly>
              </div>
            </div>
            <div class="form-row">
             <div class="form-group col-md-10">
              <label>Info Tambahan</label>
              <textarea name="iadditional_info" class="form-control" style="height: 80px;"></textarea>
            </div>
          </div>
          <div class="card-footer text-right">
            <a class="btn btn-light" href="<?php echo base_url(); ?>production/kontak">Batal</a> &nbsp;
            <button class="btn btn-primary" type="submit" name="btn">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<div class="true">
</div>
<script type="text/javascript">
  $(document).ready(function(){  
    initailizeSelect2();
    ajaxData();  
    ajaxDataDynamic();
    SumGrandTotal();
    changePrice();
    autoNumericFormat();


    var i=1;  
    $('#add').click(function(){  
      i++;  
      $('#tbvarian tbody').append('<tr id="row'+i+'"><td style="width:300px"><select class="form-control selitem_mo" name="selitem_mo[]" id="selitem_mo'+i+'"><option value=""></option> <?php foreach($product_list as $product):?><?php if(!empty($product->variant_option)){?>
        <option value="<?php echo $product->product_sku ?>"><?php echo $product->product_name; ?> / <?php echo $product->option_value ?></option><?php } else {  ?><option value="<?php echo $product->product_sku ?>"><?php echo $product->product_name;?></option><?php }?><?php endforeach;?></select></td><td><input type="text" class="form-control iqty_mo'+i+'" name="iqty_mo[]" id="iqty_mo'+i+'"></td><td><input type="text" class="form-control isalesprice'+i+'" name="isalesprice" id="isalesprice'+i+'" readonly></td><td><input type="text" class="form-control isubtotal_price'+i+'" name="isubtotal_price[]" id="isubtotal_price'+i+'" readonly></td><td><div class="true"><a class="btn_td" href="">Tidak Tersedia  <i class="fa fa-info-circle"></i></a></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></button></td></tr>'); 
      initailizeSelect2(); 
      ajaxDataDynamic();
      SumGrandTotal();
    });
    $(document).on('click', '.btn_remove', function(){  
      var button_id = $(this).attr("id");   
      $('#row'+button_id+'').remove();
      changePrice();  
    });

    jQuery(function($) {
      $('.autonumber').autoNumeric('init');    
    });

    function autoNumericFormat() 
    {
      $('#rate_service').keyup(function(){ 
        $('.iservice_rate').val($('#rate_service').autoNumeric('get'));

      });
    }

   

    function initailizeSelect2(){
      $('.selitem_mo').select2({
        width: '100%',
        placeholder: 'Pilih produk',
        escapeMarkup: function (markup) { return markup; }
      }).on('select2:open', function () {
        var a = $(this).data('select2');
        if (!$('.select2-link').length) {
          a.$results.parents('.select2-results')
          .append('<div class="select2-link"><button type="button" style="background-color: #fff; color: #6777ef; margin: 3px ;padding: 6px;height: 40px;display: inline-table;" class="btn" data-toggle="modal" data-target="#unitmodal"><i class="fas fa-edit"></i> Tambah Data</button></div>')
          .on('click', function (b) {
            a.trigger('close');
          });
        }
      });  
    }

    //pass data from select item product
    function ajaxData() {
      $('#selitem_mo').change(function(){ 
        var product_sku=$(this).val();
        $.ajax({
          url : "<?php echo site_url('production/manufacturing/showproduct');?>",
          method : "POST",
          data : {product_sku: product_sku},
          async : true,
          dataType : 'json',
          success: function(data){
            sales_price = data[0].sales_price;
            $('#isalesprice').val(sales_price);
            changePrice();


          }
        });
        return false;
      }); 
    }
    //pas data from select item product dynamic
    function ajaxDataDynamic() {
      $('#selitem_mo'+i+'').change(function(){ 
        var product_sku=$(this).val();
        $.ajax({
          url : "<?php echo site_url('production/manufacturing/showproduct');?>",
          method : "POST",
          data : {product_sku: product_sku},
          async : true,
          dataType : 'json',
          success: function(data){
            sales_price = data[0].sales_price;
            $('#isalesprice'+i+'').val(sales_price);
            changePrice();
          }
        });
        return false;
      }); 
    }

   //sum total
   function SumGrandTotal() {
    $('#iqty_mo,#iservice_rate,#iqty_mo'+i+'').keyup(function() {
     var qty   = $('#iqty_mo').val()-0;
     var price = $('#isalesprice').val()-0;

     var qtydynamic   = $('#iqty_mo'+i+'').val()-0;
     var pricedynamic = $('#isalesprice'+i+'').val()-0;

     var rate  = $('#iservice_rate').val()-0;

     $('.isubtotal_price'+i+'').val(qtydynamic*pricedynamic);
     $('#isubtotal_price').val(qty*price);
     if (qty >= 0 && price >= 0 && qtydynamic >= 0 && pricedynamic >= 0) {
       $('#igrand_total').val(rate+qty*price+qtydynamic*pricedynamic);
     } else {
      $('#igrand_total').val(rate+qty*price);
    }
  });

  }

  function changePrice() {
    $('#isalesprice,#isalesprice'+i+'').ready(function() {
      var price = $('#isalesprice').val();
      var qty  = $('#iqty_mo').val()-0;

      var pricedynamic = $('#isalesprice'+i+'').val()
      var qtydynamic   = $('#iqty_mo'+i+'').val();

      var rate = $('#iservice_rate').val()-0;
      $('#isubtotal_price').val(qty*price);
      $('#isubtotal_price'+i+'').val(qtydynamic*pricedynamic);
      if (qty >= 0 && price >= 0 && qtydynamic >= 0 && pricedynamic >= 0) {
       $('#igrand_total').val(rate+qty*price+qtydynamic*pricedynamic);
     } else {
      $('#igrand_total').val(rate+qty*price);
    }
  });
  }
}); 
</script>


