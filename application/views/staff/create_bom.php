<section class="section">
  <!-- <div class="section-header">
    <h5>Bill Of Material Struktur Produk</h5>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>production/home">Dasbor</a></div>
      <div class="breadcrumb-item"><a href="<?php echo base_url(); ?>production/manufacturing">Penanan Produksi</a></div>
      <div class="breadcrumb-item">Pesanan Produksi Baru</div>
    </div>
  </div> -->
  <!-- Notification Session -->
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Tetapkan Bill of Material / Struktur Produk</h4>
          </div>
          <form action="<?php echo site_url('staff/product_card/addbillofmaterial') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-8">
                  <h5>Struktur </h5> 
                  <p>per <strong>1 Pcs</strong> Produk</p>
                  <hr>
                </div>
              </div>
              <div class="form-row">
               <div class="form-group col-md-8">
                <label>Produk</label>
                <select class="form-control selprod_bom" name="selprod_bom" id="selprod_bom">
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
              </div>
            </div>
            <hr>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table id="tbvarian" class="table table-bordered">
                  <tr>
                    <th>Item</th>
                    <th>Jumlah Kebutuhan</th>
                    <th>Satuan Ukur</th>
                    <th></th>
                  </tr>
                  <tr>
                    <td style="width: 300px;" class="item_bom">
                      <select class="selitem_material" name="selitem_material[]" id="selitem_material" disabled="">
                       <option value=""></option>
                       <?php foreach($material_list as $material):?>
                        <?php if (!empty($material->mv_option)) { ?>
                          <option value="<?php echo $material->material_sku ?>">
                            <?php echo $material->material_name; ?> / <?php echo $material->mv_value ?>
                          </option>
                        <?php } else { ?>
                          <option value="<?php echo $material->material_sku ?>">
                            <?php echo $material->material_name; ?>
                          </option>
                        <?php } ?>
                      <?php endforeach;?>
                    </select>
                  </td>
                  <td>
                    <input type="number" step="0.01" class="form-control iqty_bom amount" name="iqty_bom[]" id="iqty_bom" placeholder="Masukan jumlah">
                  </td>
                  <td>
                    <input type="text" class="form-control iuom_bom" name="iuom_bom" id="iuom_bom">
                  </td>
                  <td>
                  </td>
                </tr>
              </table>
              <button class="btn btn-outline-primary" type="button" name="add" id="add"><i class="fa fa-plus-square"></i> Tambah Item</button>
            </div>
          </div>
          <br>
          <div class="card-footer text-right">
            <a class="btn btn-light" href="<?php echo base_url(); ?>staff/product_card">Batal</a> &nbsp;
            <button class="btn btn-primary" type="submit" name="btn" id="save_btn" disabled="">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>

<!-- Modal place -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $(document).ready(function(){ 
    addrows();
    deleterows(); 
    initailizeSelect2(); 
    ajaxdata();
    ajaxdatadynamic(); 
    var i=1; 

    function addrows()
    { 
     $('#add').click(function(){  
      i++;  
      $('#tbvarian tbody').append('<tr id="row'+i+'" class="item_bom"><td style="width: 300px;"><select class="selitem_material" name="selitem_material[]"><option value=""></option><?php foreach($material_list as $material):?> <?php if (!empty($material->mv_option)) { ?><option value="<?php echo $material->material_sku ?>"><?php echo $material->material_name; ?> / <?php echo $material->mv_value ?></option><?php } else { ?><option value="<?php echo $material->material_sku ?>"><?php echo $material->material_name; ?></option><?php } ?><?php endforeach;?></select></td><td><input type="number" step="0.001" class="form-control iqty_bom amount" name="iqty_bom[]" placeholder="masukan jumlah"></td><td><input type="text" class="form-control iuom_bom" name="iuom_bom"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></button></td></tr>',ajaxdatadynamic()); 
      initailizeSelect2();
      //ajaxdata();
      ajaxdatadynamic(); 

    });
   }

   function deleterows()
   {
     $(document).on('click', '.btn_remove', function(){  
      var button_id = $(this).attr("id");   
      $('#row'+button_id+'').remove();  
    });
   }

   function initailizeSelect2(){
    $('.selitem_material').select2({
      width: '100%',
      placeholder: 'Pilih Material Item',
      escapeMarkup: function (markup) { return markup; }
    });  
  }
  
  function ajaxdata() {
    $('#selitem_material').change(function(){ 
      var material_sku=$(this).val();
      $.ajax({
        url : "<?php echo site_url('production/product_card/showmaterial');?>",
        method : "POST",
        data : {material_sku: material_sku},
        async : true,
        dataType : 'json',
        success: function(data){
          material_unit = data[0].material_unit;
          $('#iuom_bom').val(material_unit);

        }
      });
      return false;
    }); 
  }

  function ajaxdatadynamic() {
    $('.selitem_material').change(function(){ 
      var dynamicfield = $(this).closest('tr');
      var material_sku=dynamicfield.find(".selitem_material").val();
      $.ajax({
        url : "<?php echo site_url('production/product_card/showmaterial');?>",
        method : "POST",
        data : {material_sku: material_sku},
        async : true,
        dataType : 'json',
        success: function(data){
          material_unit = data[0].material_unit;
          dynamicfield.find('.iuom_bom').val(material_unit);

        }
      });
      return false;
    }); 
  }


});  
</script>