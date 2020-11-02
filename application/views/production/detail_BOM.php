<section class="section">
  <!-- Notification Session -->
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Rincian Struktur Produk</h4>
          </div>
          <form action="<?php echo site_url('production/product_card/updatebom')?>" method="post" enctype="multipart/form-data" >
           <div class="card-body">
             <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Nama Produk</label>
                <?php if (!empty($product_data->variant_option)) { ?>
                  <p style="color: #56b696; font-weight: 600; font-size: 17px;"><?= $product_data->product_name; ?> | <?= $product_data->option_value; ?></p>
                <?php } else { ?>
                  <p style="color: #56b696; font-weight: 600; font-size: 17px;"><?= $product_data->product_name; ?></p>
                <?php } ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4">Merk / Brand</label><br>
                <p class="badge badge-primary"><?= $product_data->product_brand; ?></p>
                <input type="hidden" value="<?= $product_data->product_sku; ?>" name="iproductsku">
              </div>
            </div>
            <br>
            <div class="form-row">
              <div class="table-responsive">
                <table id="tbvarian" class="table table-bordered">
                  <tr>
                    <th style="width: 250px;">Komponen Bahan Baku</th>
                    <th style="width: 100px;">Jumlah Kebutuhan</th>

                  </tr>
                  <?php foreach($product_array as $product):?>
                    <tr>
                      <td>
                        <input type="hidden" name="ibom_code[]" value="<?= $product->bom_code; ?>">
                        <select class="form-control selbom" name="selbom[]">
                          <option value=""></option>
                          <?php foreach($komponen as $datakomponen):?>
                            <?php if(!empty($datakomponen->mv_option)) {   ?>
                              <option value="<?= $datakomponen->material_sku ?>" <?php if($datakomponen->material_sku == $product->material_sku){echo "selected='selected'";} ?>>
                                <?= $datakomponen->material_name; ?> / <?= $datakomponen->mv_value ?>
                              </option>
                            <?php } else {  ?>
                              <option value="<?= $datakomponen->material_sku ?>"  <?php if($datakomponen->material_sku == $product->material_sku){echo "selected='selected'";} ?>>
                                <?= $datakomponen->material_name; ?>
                              </option>
                            <?php }  ?>
                          <?php endforeach;?>
                        </select>
                      </td>
                      <td>
                        <div class="input-group">
                          <input type="number" step="0.01" class="form-control" value="<?= $product->qty ?>" name="iqtybom[]">
                          <div class="input-group-prepend">
                            <div class="input-group-text">
                              <?= $product->material_unit; ?>
                            </div>
                          </div>
                        </div>
                      </td>

                    </tr>
                  <?php endforeach; ?>
                </table>
                <button class="btn btn-success" type="button" name="add" id="add"><i class="fa fa-plus"></i> Tambah Komponen</button>
              </div>
            </div>
          </div>
          <div class="card-footer text-right">
            <a class="btn btn-light" href="<?php echo base_url(); ?>production/kontak">Batal</a> &nbsp;
            <button class="btn btn-success" type="submit" name="btn">Perbarui</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</section>


<!------------------------------------- Embeded File ----------------------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<script type="text/javascript">
  $(document).ready(function(){
   initailizeSelect2(); 

   var i=1;  
   $('#add').click(function(){  
    i++;  
    $('#tbvarian tbody').append('<tr id="row'+i+'"><td> <select class="form-control selbom" name="selbom[]"><option value=""></option><?php foreach($komponen as $datakomponen):?><?php if(!empty($datakomponen->mv_option)) { ?><option value="<?= $datakomponen->material_sku ?>"><?= $datakomponen->material_name; ?> / <?= $datakomponen->mv_value ?></option><?php } else {  ?><option value="<?= $datakomponen->material_sku ?>"><?= $datakomponen->material_name; ?></option><?php }  ?><?php endforeach;?></select></td><td><input type="number" step="0.01" class="form-control" name="iqtybom[]"></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></button></td></tr>'); 
    initailizeSelect2();  

  });
   $(document).on('click', '.btn_remove', function(){  
    var button_id = $(this).attr("id");   
    $('#row'+button_id+'').remove();  
  }); 


   function initailizeSelect2(){
    $('.selbom').select2({
      width: '100%',
      placeholder: 'Pilih komponen',
    }); 
  }

});  
</script>

