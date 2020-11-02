<section class="section">

  <div class="section-header">
    <h1>Pesanan Produksi Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>staff/home">Dasbor</a></div>
      <div class="breadcrumb-item"><a href="<?php echo base_url(); ?>staff/manufacturing">Pesanan Produksi</a></div>
      <div class="breadcrumb-item">Pesanan Produksi Baru</div>
    </div>
  </div>
  <!-- Notification Session -->
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Buat Pesanan Produksi</h4>
          </div>
          <form action="<?php echo site_url('staff/manufacturing/addmanufacturingorder') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Kode Pesanan Produksi</label>
                  <input type="text" class="form-control" name="imo_code" placeholder="" value="<?php echo $mo_code; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label>Tanggal dibuat</label>
                  <input type="text" class="form-control" name="icreate_date" id="icreate_date" value="<?php echo $getDate; ?>" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Mitra Konsumen</label>
                  <select class="form-control" id="selcustomer_mo" name="selcustomer_mo">
                    <option></option>
                    <?php foreach($customer as $customer):?>
                      <option value="<?php echo $customer->customer_id ?>">
                        <?php echo $customer->customer_name; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>Rencana Mulai Produksi</label>
                  <input type="date" name="istartprod" class="form-control">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Deadline Produksi</label>
                  <input type="date" name="ideadline" class="form-control">
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
                      <th></th>
                    </tr>
                    <tr class="itemprod">
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
                       <input type="number" class="form-control iqty_mo amount" name="iqty_mo[]" id="iqty_mo">
                     </td>
                     <td>
                       <input type="text" class="form-control isalesprice amount" name="isalesprice" id="isalesprice">
                     </td>
                     <td>
                      <input type="text" class="form-control isubtotal_price" name="isubtotal_price[]" id="isubtotal_price">
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
                <input type="number" class="form-control iservice_rate amount" name="iservice_rate" id="iservice_rate">
              </div>
              <div class="form-group col-md-6">
                <label>Total Biaya</label>
                <input type="number" class="form-control igrand_total" name="igrand_total" id="igrand_total" readonly>
              </div>
            </div>
            <div class="form-row">
             <div class="form-group col-md-10">
              <label>Info Tambahan</label>
              <textarea name="iadditional_info" class="form-control" style="height: 80px;"></textarea>
            </div>
          </div>
          <div class="card-footer text-right">
            <a class="btn btn-light" href="<?php echo base_url(); ?>staff/kontak">Batal</a> &nbsp;
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

<script type="text/javascript">
  $(document).ready(function(){  
    initailizeSelect2();
    ajaxData();  
    ajaxDataDynamic();

    var i=1;  
    $('#add').click(function(){  
      i++;  
      $('#tbvarian tbody').append('<tr id="row'+i+'" class="itemprod"><td style="width:300px"><select class="form-control selitem_mo" name="selitem_mo[]" id="selitem_mo'+i+'"><option value=""></option> <?php foreach($product_list as $product):?><?php if(!empty($product->variant_option)){?>
        <option value="<?php echo $product->product_sku ?>"><?php echo $product->product_name; ?> / <?php echo $product->option_value ?></option><?php } else {  ?><option value="<?php echo $product->product_sku ?>"><?php echo $product->product_name;?></option><?php }?><?php endforeach;?></select></td><td><input type="number" class="form-control iqty_mo amount" name="iqty_mo[]"></td><td><input type="text" class="form-control isalesprice amount" name="isalesprice"></td><td><input type="text" class="form-control isubtotal_price" name="isubtotal_price[]"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></button></td></tr>'); 
      initailizeSelect2(); 
      ajaxDataDynamic();

    });
    $(document).on('click', '.btn_remove', function(){  
      var button_id = $(this).attr("id");   
      $('#row'+button_id+'').remove();
      sumtotal();
    });

    $(document).on("keyup", ".amount", sumtotal);

    function sumtotal() {
      $(".itemprod").each(function () {
        var iqty            = 0;
        var isalesprice     = 0;
        var isubtotal_price = 0;
        if (!isNaN(parseFloat($(this).find(".iqty_mo").val()))) {
          iqty = parseFloat($(this).find(".iqty_mo").val());
        }
        if (!isNaN(parseFloat($(this).find(".isalesprice").val()))) {
          isalesprice   = parseFloat($(this).find(".isalesprice").val());
        }
        isubtotal_price = iqty * isalesprice;
        $(this).find(".isubtotal_price").val(isubtotal_price.toFixed());
      });

      var sum = 0;
      $(".isubtotal_price").each(function () {
        if (!isNaN(this.value) && this.value.length != 0) {
          sum += parseFloat(this.value);
        }
      });
      $("#igrand_total").val(parseFloat(sum.toFixed()) + parseFloat(($("#iservice_rate").val())));
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
          url : "<?php echo site_url('staff/manufacturing/showproduct');?>",
          method : "POST",
          data : {product_sku: product_sku},
          async : true,
          dataType : 'json',
          success: function(data){
            sales_price = data[0].sales_price;
            $('#isalesprice').val(sales_price);
            sumtotal();
          }
        });
        return false;
      }); 
    }

    //pas data from select item product dynamic
    function ajaxDataDynamic() {
      $('.selitem_mo').change(function(){ 
        var dynamicfield = $(this).closest('tr');
        //var product_sku  = $(this).val();
        var product_sku  = dynamicfield.find(".selitem_mo").val(); 
        $.ajax({
          url : "<?php echo site_url('staff/manufacturing/showproduct');?>",
          method : "POST",
          data : {product_sku: product_sku},
          async : true,
          dataType : 'json',
          success: function(data){
            sales_price = data[0].sales_price;
            dynamicfield.find(".isalesprice").val(sales_price);
            //$(".isalesprice").val(sales_price);
            sumtotal();
          }
        });
        return false;
      }); 
    }

  }); 
</script>


