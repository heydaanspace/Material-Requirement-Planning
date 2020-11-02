<section class="section">
  <!-- Breadcrumb -->
  <div class="section-header">
    <h1>Bahan Baku Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
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
            <h4>Buat Kartu Bahan Baku</h4>
          </div>
          <form action="<?php echo site_url('staff/item_material/addmaterial') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Item Bahan Baku</label>
                  <input type="text" class="form-control" name="imaterialname" placeholder="">
                </div>
                <div class="form-group col-md-4" id="divmaterialcode">
                  <label for="inputEmail4">SKU Bahan Baku</label>
                  <input type="text" class="form-control" name="imaterialsku_nonvar" id="imaterialsku_nonvar" placeholder="">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Kategori</label>
                  <select class="form-control" id="selcategory" name="selcategory">
                   <option value=""></option>
                 </select>
               </div>
               <div class="form-group col-md-4">
                <label>Satuan Ukur</label>
                <select class="form-control iunit" name="iunit" id="iunit">
                  <option value=""></option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Merk / Brand</label>
                <input type="text" class="form-control" name="imaterialbrand" placeholder="">
              </div>
              <div class="form-group col-md-4" id="divprice">
                <label for="inputEmail4">Harga Beli</label>
                <input type="number" class="form-control" name="iprice_nonvar" id="iprice_nonvar" placeholder="">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Tetapkan Stok Awal</label>
                <input type="number" class="form-control" name="istok_nonvar" id="istok_nonvar" placeholder="">
              </div>
              <div class="form-group col-md-4" id="divprice">
               <label for="inputEmail4">Leadtime / Waktu ancang (Hari)</label>
               <input type="text" class="form-control" name="ileadtime_nonvar" id="ileadtime_nonvar" placeholder="">
             </div>
           </div>
           <div class="form-row">
            <div class="form-group col-md-4">
              <label>Varian</label>
              <p>Aktifkan fitur ini apabila bahan baku memiliki atribut/varian, seperti ukuran, warna, kapasitas dan lain-lain. Fitur ini dapat menghandle hanya 1 (satu) atribut/varian.</p>
            </div>
            <div class="form-group col-md-6">
              <label></label><br>
              <label class="custom-switch mt-2">
                <input type="checkbox" name="material_variancheck" id="material_variancheck" value="good" class="custom-switch-input">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description">Bahan baku ini memiliki varian</span>
              </label>
            </div>

          </div>

          <div id="variant_frm" style="display: none;">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Pilih Varian</label>
                <select class="form-control" id="material_varianopt" name="material_varianopt">
                  <option></option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="inputAddress">Nilai Varian</label>
                <input type="text" id="selectvarian_material" name="selectvarian_material" class="form-control" data-role="tagsinput" placeholder="Masukan nilai varian"/>
              </div>
            </div>
            <br>
            <hr>
            <div class="table-responsive">
              <table id="tbvarian_material" class="table table-bordered">
                <tr>
                  <th>Varian</th>
                  <th>SKU Bahan Baku</th>
                  <th>Harga</th>
                  <th>Tetapkan Stok Awal</th>
                  <th>Leadtime</th>
                </tr>
              </table>
            </div>
          </div>

          <input type="hidden" name="ivarianval_material[]" class="form-control ivarianval_material_trigger">
          <input type="hidden" name="imaterialsku[]" class="form-control imaterialsku_trigger">
          <input type="hidden" name="iprice[]" class="form-control iprice_trigger">
          <input type="hidden" name="ileadtime[]" class="form-control ileadtime_trigger">

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


<!------------------------------------- Embeded File ----------------------------------------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<div class="modal fade" id="unitmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Satuan Ukur Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama satuan ukur</label>
            <input type="text" class="form-control" id="iuom" name="iuom" required="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="save_unit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

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
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama Varian</label>
            <input type="text" class="form-control" id="imastervariant" name="imastervariant" required="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="save_variant" id="save_variant" class="btn btn-primary">Simpan</button>
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
    <form class="form-horizontal">
      <div class="modal-body">
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Nama Kategori</label>
          <input type="text" class="form-control" id="icategory" name="icategory" required="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="save_category" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>



<!-- Embedded File -->
<script>
  $(document).ready(function(){
    tampil_selcategory();
    tampil_selunit();
    tampil_mastervariant();

   // bagian varian
   var i=0;
   $('#selectvarian_material').on('itemAdded', function(event) {
    i++;
    var markup = '<tr id="'+ event.item + '"><td><input type="text" name="ivarianval_material[]" value="'+ event.item + '" class="form-control" readonly></td><td><input type="text" name="imaterialsku[]" class="form-control"></td><td><input type="text" name="iprice[]" id="iprice" class="form-control"></td><td><input type="text" name="istok[]" class="form-control"></td><td><input type="text" name="ileadtime[]" class="form-control"></td></tr>';

    $('#tbvarian_material tbody').append(markup);

  });
   $('input').on('itemRemoved', function(event) {
    document.getElementById(event.item).remove(); 
    SumGrandTotalDynamic();
    //SumGrandTotalDynamicReady()
  });


  function tampil_selcategory(){
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url()?>staff/item_material/showcategory',
      async : true,
      dataType : 'json',
      success : function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].category_id+'" selected>'+data[i].category_name+'</option>';
        }
        $('#selcategory').html(html);
      }
    });
  }

  function tampil_selunit(){
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url()?>staff/item_material/showunit',
      async : true,
      dataType : 'json',
      success : function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].unit_name+'" selected>'+data[i].unit_name+'</option>';
        }
        $('#iunit').html(html);
      }
    });
  }

  function tampil_mastervariant(){
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url()?>staff/item_material/showmastervariant',
      async : true,
      dataType : 'json',
      success : function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
          html += '<option value="'+data[i].variant_material+'" selected>'+data[i].variant_material+'</option>';
        }
        $('#material_varianopt').html(html);
      }
    });
  }

//save category
$('#save_category').on('click',function(){

  var icategory=$('#icategory').val();
  $.ajax({
    type : "POST",
    url  : "<?php echo base_url('staff/item_material/addcategory')?>",
    dataType : "JSON",
    data : {icategory:icategory},
    success: function(data){
      $('[name="icategory"]').val("");
      $('#categorymodal').modal('hide');
      tampil_selcategory();
    }
  });
  return false;
});

//save unit of measure
$('#save_unit').on('click',function(){
  var iuom=$('#iuom').val();
  $.ajax({
    type : "POST",
    url  : "<?php echo base_url('staff/item_material/addunit')?>",
    dataType : "JSON",
    data : {iuom:iuom},
    success: function(data){
      $('[name="iuom"]').val("");
      $('#unitmodal').modal('hide');
      tampil_selunit();
    }
  });
  return false;
});

//save master variant
$('#save_variant').on('click',function(){

  var imastervariant=$('#imastervariant').val();
  $.ajax({
    type : "POST",
    url  : "<?php echo base_url('staff/item_material/addmastervariant')?>",
    dataType : "JSON",
    data : {imastervariant:imastervariant},
    success: function(data){
      $('[name="imastervariant"]').val("");
      $('#varianmodal').modal('hide');
      tampil_mastervariant();
    }
  });
  return false;
});
});
</script>

<!-- <script type="text/javascript">
  $(document).ready(function(){
    tampil_selcategory();
    tampil_selunit();
    tampil_mastervariant();
    SumGrandTotal();

    function SumGrandTotal() {
      $('#istok_nonvar,#iprice_nonvar').keyup(function() {
       var price   = $('#iprice_nonvar').val()-0;
       var stok    = $('#istok_nonvar').val()-0;

       $('#ivalue_stok_nonvar').val(price*stok);
     });
    }

    function tampil_selcategory(){
      $.ajax({
        type  : 'GET',
        url   : '<?php echo base_url()?>production/item_material/showcategory',
        async : true,
        dataType : 'json',
        success : function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].category_id+'" selected>'+data[i].category_name+'</option>';
          }
          $('#selcategory').html(html);
        }
      });
    }

    function tampil_selunit(){
      $.ajax({
        type  : 'GET',
        url   : '<?php echo base_url()?>production/item_material/showunit',
        async : true,
        dataType : 'json',
        success : function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].unit_name+'" selected>'+data[i].unit_name+'</option>';
          }
          $('#iunit').html(html);
        }
      });
    }

    function tampil_mastervariant(){
      $.ajax({
        type  : 'GET',
        url   : '<?php echo base_url()?>production/item_material/showmastervariant',
        async : true,
        dataType : 'json',
        success : function(data){
          var html = '';
          var i;
          for(i=0; i<data.length; i++){
            html += '<option value="'+data[i].variant_material+'" selected>'+data[i].variant_material+'</option>';
          }
          $('#material_varianopt').html(html);
        }
      });
    }

//save category
$('#save_category').on('click',function(){

  var icategory=$('#icategory').val();
  $.ajax({
    type : "POST",
    url  : "<?php echo base_url('production/item_material/addcategory')?>",
    dataType : "JSON",
    data : {icategory:icategory},
    success: function(data){
      $('[name="icategory"]').val("");
      $('#categorymodal').modal('hide');
      tampil_selcategory();
    }
  });
  return false;
});

//save unit of measure
$('#save_unit').on('click',function(){
  var iuom=$('#iuom').val();
  $.ajax({
    type : "POST",
    url  : "<?php echo base_url('production/item_material/addunit')?>",
    dataType : "JSON",
    data : {iuom:iuom},
    success: function(data){
      $('[name="iuom"]').val("");
      $('#unitmodal').modal('hide');
      tampil_selunit();
    }
  });
  return false;
});

//save master variant
$('#save_variant').on('click',function(){

  var imastervariant=$('#imastervariant').val();
  $.ajax({
    type : "POST",
    url  : "<?php echo base_url('production/item_material/addmastervariant')?>",
    dataType : "JSON",
    data : {imastervariant:imastervariant},
    success: function(data){
      $('[name="imastervariant"]').val("");
      $('#varianmodal').modal('hide');
      tampil_mastervariant();
    }
  });
  return false;
});

});

</script> -->
