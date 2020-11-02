<section class="section">
  <!-- <div class="section-header">
    <h1>Pesanan Produksi Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>production/home">Dasbor</a></div>
      <div class="breadcrumb-item"><a href="<?php echo base_url(); ?>production/manufacturing">Penanan Produksi</a></div>
      <div class="breadcrumb-item">Pesanan Produksi Baru</div>
    </div>
  </div> -->
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
           <div class="col-4 text-left">
            <h4>Detail Pesanan Produksi</h4>
          </div>
          <div class="col-8 text-right">
            <a target="_blank" href="<?php echo base_url() ?>production/manufacturing/pdfinvoicemo/<?= $mo_list->mo_id; ?>"><i class="fas fa-print"></i> Cetak Invoice</a>
          </div>
        </div>
        <form action="<?php echo site_url('production/manufacturing/actupdateMO') ?>" method="post" enctype="multipart/form-data" >
          <div class="card-body">

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Kode Pesanan Produksi</label>
                <input type="text" class="form-control" name="imo_code" placeholder="" value="<?php echo $mo_list->mo_code; ?>" readonly>
                <input type="hidden" class="form-control" name="imo_id" placeholder="" value="<?php echo $mo_list->mo_id; ?>">
              </div>
              <div class="form-group col-md-4">
                <label>Mitra Konsumen</label>
                <select class="form-control" id="selcustomer_mo" name="selcustomer_mo">
                  <option value=""></option>
                  <?php foreach($customer as $customer):?>
                    <option value="<?php echo $customer->customer_id ?>" <?php if($customer->customer_id == $mo_list->customer_id){echo "selected='selected'";} ?>>
                      <?php echo $customer->customer_name; ?> -  <?php echo $customer->brand_name; ?>
                    </option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Tanggal mulai</label>
                <input type="date" name="istartprod" value="<?= $mo_list->production_start; ?>" class="form-control">
              </div>
              <div class="form-group col-md-4">
               <label>Deadline Produksi</label>
               <input type="date" name="ideadline" value="<?= $mo_list->prod_deadline; ?>" class="form-control">
             </div>
           </div>
           <div class="form-row">
            <div class="form-group col-md-4">
              <label>Tanggal dibuat</label>
              <input type="text" class="form-control" name="icreate_date" id="icreate_date" value="<?php echo $mo_list->created_date; ?>" readonly>
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
                </tr>
                <?php foreach($mo_array as $manufacturing):?>
                  <tr class="item_mo">
                   <td style="width: 300px;">
                    <select class="form-control selitem_mo" name="selitem_mo[]">
                      <option value=""></option>
                      <?php foreach($product_list as $product):?>
                        <?php if(!empty($product->variant_option)) {   ?>
                          <option value="<?php echo $product->product_sku ?>" <?php if($product->product_sku == $manufacturing->product_sku){echo "selected='selected'";} ?>>
                            <?php echo $product->product_name; ?> / <?php echo $product->option_value ?>
                          </option>
                        <?php } else {  ?>
                          <option value="<?php echo $product->product_sku ?>"  <?php if($product->product_sku == $manufacturing->product_sku){echo "selected='selected'";} ?>>
                            <?php echo $product->product_name; ?>
                          </option>
                        <?php }  ?>
                      <?php endforeach;?>
                    </select>
                  </td>
                  <td>
                    <input type="hidden" class="form-control" name="idet_mo[]" value="<?= $manufacturing->id_det_mo; ?>">
                    <input type="text" class="form-control iqty_mo amount" name="iqty_mo[]" id="iqty_mo" value="<?php echo $manufacturing->quantity ?>">
                  </td>
                  <td>
                    <input type="text" style="color: white;" class="form-control true isalesprice" name="isalesprice" id="isalesprice" value="<?php echo $manufacturing->sales_price ?>" readonly>
                  </td>
                  <td>
                    <input type="text" style="color: white;"  class="form-control true isubtotal_price" name="isubtotal_price" id="isubtotal_price" readonly>
                  </td>
                </tr>
              <?php endforeach; ?>
            </table>
            <button class="btn btn-outline-primary" type="button" name="add" id="add"><i class="fa fa-plus-square"></i> Tambah Item</button>
          </div>
        </div>
        <br>
        <hr>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Biaya Jasa Produksi</label>
            <!--  <input type="text" placeholder="" id="rate_service" name="rate_service" class="form-control autonumber" data-a-sep="." data-a-dec=","> -->
            <input type="text" class="form-control iservice_rate" name="iservice_rate" id="iservice_rate" value="<?php echo $mo_list->production_cost; ?>">
          </div>
          <div class="form-group col-md-6">
            <label>Total Biaya</label>
            <input type="text" class="form-control igrand_total" name="igrand_total" id="igrand_total" value="" readonly>
          </div>
        </div>
        <div class="form-row">
         <div class="form-group col-md-10">
          <label>Info Tambahan</label>
          <textarea name="iadditional_info" class="form-control" style="height: 80px;"><?= $mo_list->additional_info; ?></textarea>
        </div>
      </div>
      <div class="card-footer text-right">
        <a class="btn btn-light" href="<?php echo base_url(); ?>production/kontak">Batal</a> &nbsp;
        <button onclick="deleteConfirm('<?php echo base_url() ?>production/manufacturing/actdeleteMO/<?= $mo_list->mo_id; ?>')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Hapus Pesanan</button>
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
    //addrows();
    //deleterows(); 
    initailizeSelect2();
    ajaxData(); 
    sumtotal(); 

    var i=1;  
    $('#add').click(function(){  
      i++;  
      $('#tbvarian tbody').append('<tr id="row'+i+'" class="item_mo"><td style="width:300px"><select class="form-control selitem_mo" name="selitem_mo[]" id="selitem_mo'+i+'"><option value=""></option> <?php foreach($product_list as $product):?><?php if(!empty($product->variant_option)){?><option value="<?php echo $product->product_sku ?>"><?php echo $product->product_name; ?> / <?php echo $product->option_value ?></option><?php } else {  ?><option value="<?php echo $product->product_sku ?>"><?php echo $product->product_name;?></option><?php }?><?php endforeach;?></select></td><td><input type="number" class="form-control iqty_mo amount" name="iqty_mo[]"></td><td><input type="text" class="form-control isalesprice amount" name="isalesprice" readonly></td><td><input type="text" class="form-control isubtotal_price" name="isubtotal_price[]" readonly><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></button></td></tr>'); 
      initailizeSelect2(); 
      ajaxData();
    });
    $(document).on('click', '.btn_remove', function(){  
      var button_id = $(this).attr("id");   
      $('#row'+button_id+'').remove();
      sumtotal();
    });

    jQuery(function($) {
      $('.autonumber').autoNumeric('init');    
    });


    function initailizeSelect2(){
      $('.selitem_mo').select2({
        width: '100%',
        placeholder: 'Pilih item',
      }); 
    }


    //pass data from select item product
    function ajaxData() {
      $('.selitem_mo').change(function(){ 
        var dynamicfield = $(this).closest('tr');
        var product_sku=dynamicfield.find(".selitem_mo").val();
        //alert(product_sku);
        $.ajax({
          url : "<?php echo site_url('production/manufacturing/showproduct');?>",
          method : "POST",
          data : {product_sku: product_sku},
          async : true,
          dataType : 'json',
          success: function(data){
            sales_price = data[0].sales_price;
            dynamicfield.find(".isalesprice").val(sales_price);
            sumtotal();
          }
        });
        return false;
      }); 
    }

    $(document).on("keyup", ".amount", sumtotal);

    function sumtotal() {
      $(".item_mo").each(function () {
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

  }); 
</script>
<script>
  function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteMO').modal();
  }
</script>


<!-- Modal Delete Confirmation-->
<div class="modal fade" id="deleteMO" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Draft Pesanan yang terhapus, tidak akan bisa dikembalikan dan harus membuatkan ulang.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>



