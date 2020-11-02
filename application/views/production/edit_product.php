<section class="section">
  <!-- Breadcrumb -->
  <div class="section-header">
    <h1>Ubah Kartu Produk</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Kontak</a></div>
      <div class="breadcrumb-item">Kartu Produk</div>
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
            <h4>Perbarui Kartu Produk</h4>
          </div>

          <?php if (!empty($product_edit->variant_option)) { ?>

            <form action="<?php echo site_url('production/product_card/editprocess')?>" method="post" enctype="multipart/form-data" >
             <div class="card-body">
               <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Nama Produk /w varian</label>
                  <input type="hidden" class="form-control" name="iproductcode" value="<?php echo $product_edit->product_code ?>">
                  <input type="text" class="form-control" name="iproductname" value="<?php echo $product_edit->product_name ?>" placeholder="">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Merk / Brand</label>
                  <input type="text" class="form-control" name="iproductbrand" value="<?php echo $product_edit->product_brand ?>" placeholder="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Kategori</label>
                  <select class="form-control" id="selcategory" name="selcategory">
                    <?php foreach($product_category as $product_category):?>
                      <option value="<?php echo $product_category->category_id ?>" <?php if($product_category->category_id == $product_edit->category_id){echo "selected='selected'";} ?>>
                        <?php echo $product_category->category_name; ?>
                      </option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>Satuan Ukur</label>
                  <select class="form-control" name="iunit" id="iunit">
                    <?php foreach($unit_of_measure as $unit):?>
                      <option value="<?php echo $unit->unit_name ?>" <?php if($unit->unit_name == $product_edit->unit){echo "selected='selected'";} ?>>
                        <?php echo $unit->unit_name; ?>
                      </option>
                    <?php endforeach;?>
                  </select>
                </div>
              </div>
              <br>
              <hr>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Pilih Varian</label>
                  <select class="form-control" id="editvarianopt" name="editvarianopt">
                    <option></option>
                    <?php foreach($master_variant_product as $master_variant):?>
                      <option value="<?= $master_variant->variant_name  ?>" <?php if($master_variant->variant_name == $product_edit->variant_option){echo "selected='selected'";} ?>>
                        <?= $master_variant->variant_name  ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group col-md-6">


                </div>
              </div>
              <div class="form-row">
                <div class="table-responsive">
                  <table id="tbvarian" class="table table-bordered">
                    <tr>
                      <th>Nilai Varian</th>
                      <th>SKU Produk</th>
                      <th>Harga Jual</th>
                      <th></th>
                    </tr>
                    <?php foreach($product_array as $product):?>
                      <tr>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $product->option_value ?>" name="ivarianval[]">
                          <input type="hidden" class="form-control" value="<?php echo $product->variant_code ?>" name="idvariant[]">
                        </td>
                        <td>
                          <input type="hidden" class="form-control" value="<?php echo $product->sku_id ?>" name="skuid[]">
                          <input type="text" class="form-control" value="<?php echo $product->product_sku ?>" name="iproductsku[]">
                        </td>
                        <td>
                          <input type="text" class="form-control" value="<?php echo $product->sales_price ?>" name="isalesprice[]">
                        </td>
                        <td></td>
                      </tr>
                    <?php endforeach; ?>
                  </table>
                  <button class="btn btn-success" type="button" name="add" id="add"><i class="fa fa-plus"></i> Tambah Nilai Varian</button>
                </div>
              </div>
            </div>
            <div class="card-footer text-right">
              <a class="btn btn-light" href="<?php echo base_url(); ?>production/kontak">Batal</a> &nbsp;
              <button class="btn btn-success" type="submit" name="btn">Perbarui</button>
            </div>
          </form>

        <?php } else { ?>
          <form action="<?php echo site_url('production/product_card/editprocess')?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Nama Produkk</label>
                  <input type="hidden" class="form-control" name="iproductcode" value="<?php echo $product_edit->product_code ?>">
                  <input type="text" class="form-control" name="iproductname" value="<?php echo $product_edit->product_name ?>" placeholder="">
                </div>
                <div class="form-group col-md-4" id="divproductcode">
                  <label for="inputEmail4">SKU Produk</label>
                  <input type="hidden" class="form-control" name="skuid[]" value="<?php echo $product_edit->sku_id ?>" placeholder="">
                  <input type="hidden" class="form-control" name="editvarianopt" placeholder="">
                  <input type="hidden" class="form-control" value="<?php echo $product->product_sku ?>" name="iproductsku[]">
                  <input type="text" class="form-control" name="iproductsku_nonvar" value="<?php echo $product_edit->product_sku ?>" placeholder="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Kategori</label>
                  <select class="form-control" id="selcategory" name="selcategory">
                    <?php foreach($product_category as $product_category):?>
                      <option value="<?php echo $product_category->category_id ?>" <?php if($product_category->category_id == $product_edit->category_id){echo "selected='selected'";} ?>>
                        <?php echo $product_category->category_name; ?>
                      </option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>Satuan Ukur</label>
                  <select class="form-control" name="iunit">
                    <option value="Pcs">Pcs</option>
                    <option value="M">M</option>
                    <option value="Cm">Cm</option>
                    <option value="gr">gr</option>
                    <option value="Kg">Kg</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Merk / Brand</label>
                  <input type="text" class="form-control" name="iproductbrand" value="<?php echo $product_edit->product_brand ?>" placeholder="">
                </div>
                <div class="form-group col-md-4" id="divsalesprice">
                  <label for="inputEmail4">Harga jual</label>
                  <input type="number" class="form-control" name="isalesprice_nonvar" value="<?php echo $product_edit->sales_price ?>" placeholder="">
                </div>
              </div>
            </div>
            <div class="card-footer text-right">
              <a class="btn btn-light" href="<?php echo base_url(); ?>production/kontak">Batal</a> &nbsp;
              <button class="btn btn-success" type="submit" name="btn">Perbarui</button>
            </div>
          </form>
        <?php } ?>
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
    var i=1;  
    $('#add').click(function(){  
      i++;  
      $('#tbvarian tbody').append('<tr id="row'+i+'"><td><input type="text" class="form-control" name="ivarianval[]"></td><td><input type="text" class="form-control" name="iproductsku[]"></td><td><input type="text" class="form-control" name="isalesprice[]"></td></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></button></td></tr>');  
    });
    $(document).on('click', '.btn_remove', function(){  
      var button_id = $(this).attr("id");   
      $('#row'+button_id+'').remove();  
    });  
  });  
</script>

<div class="modal fade" id="varianmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Varian Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo site_url('production/product_card/addmastervariant') ?>">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Varian</label>
            <input type="text" class="form-control" id="imastervariant" name="imastervariant" required="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="categorymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kategori Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo site_url('production/product_card/addcategory') ?>">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="icategory" name="icategory" required="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


