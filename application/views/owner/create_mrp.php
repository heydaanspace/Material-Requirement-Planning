<section class="section">
  <div class="section-header">
    <h1>MRP Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>owner/home">Dasbor</a></div>
      <div class="breadcrumb-item"><a href="<?php echo base_url(); ?>owner/mrp">MRP</a></div>
      <div class="breadcrumb-item">MRP Baru</div>
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
            <h4>Tetapkan MRP</h4>
          </div>
          <form action="<?php echo site_url('owner/mrp/savemrp') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Nomor MRP</label>
                  <input type="text" class="form-control" id="inomrp" name="ino_mrp" placeholder="" value="<?php echo $no_mrp; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label>Tanggal dibuat</label>
                  <input type="hidden" class="form-control" name="icreate_date" id="icreate_date" value="<?= date('Y-m-d') ?>" readonly>
                  <input type="text" class="form-control" value="<?= date('d-m-Y') ?>" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Tentukan No. Produksi</label>
                  <select class="form-control" id="selmo_code" name="selmo_code">
                    <option></option>
                    <?php foreach ($mo_list as $mo_data): ?>
                      <option value="<?= $mo_data->mo_id; ?>"><strong><?= $mo_data->mo_code ?></strong> | <?= $mo_data->customer_name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Pilih Produk</label>
                  <select class="form-control" id="sel_prod" name="sel_prod" disabled="">
                    <option></option>
                  </select>
                </div>
                <div class="form-group col-md-3">
                  <label>Jumlah produksi</label>
                  <div class="input-group">
                    <input class="form-control iqtyprod" type="text" id="iqtyprod" readonly="">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Pcs
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="card-body p-0" id="productMRP">

              </div>
              <div class="manufacturingloading" style="display: none;">
                <div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
              </div>
              <br>
              <hr>
              <div class="card-footer text-right">
                <a class="btn btn-light" href="<?php echo base_url(); ?>owner/kontak">Batal</a> &nbsp;
                <button class="btn btn-primary" type="submit" name="btn">Simpan Draft MRP</button>
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
   $(document).ready(function() {
    ShowProduct();
    Showmaterial();
    ShowdetMO();
    

    function ShowProduct() 
    {  
     $('#selmo_code').change(function(){ 
      $("#sel_prod").removeAttr('disabled');
      var selmo_code = $('#selmo_code').val();
      $.ajax({
       type: 'POST',
       url: '<?php echo base_url(); ?>owner/mrp/showitemproductmrp',
       data:{selmo_code: selmo_code},
       async : true,
       dataType : 'json',
       success: function (data) {
         var html = '';
         var i;

         for (i = 0; i<data.length; i++) {
           if (!data[i].variant_option) {
             html += '<option value=""></option><option value='+data[i].product_sku+'>'+data[i].product_name+'</option>';
           } else {
            html += '<option value=""></option><option value='+data[i].product_sku+'>'+data[i].product_name+' | '+data[i].option_value+'</option>';
          }
        }
        $('#sel_prod').html(html);
      }
    });
      return false;
    });
   }

   function ShowdetMO() 
   {  
     $('#sel_prod').change(function(){ 
      var selmo_code = $('#selmo_code').val();
      var sel_prod = $('#sel_prod').val();
      //alert(sel_mo);
      $.ajax({
       type: 'POST',
       url: '<?php echo base_url(); ?>owner/mrp/showdetmanufacturing',
       data:{selmo_code: selmo_code, sel_prod: sel_prod},
       async : true,
       dataType : 'json',
       success: function (data) {
        quantity = data[0].quantity;
        duedate  = data[0].production_start;
        $('#iqtyprod').val(quantity);
        
        //$('#iduedate').val(duedate);

      }
    });
      return false;
    });
   }


   function Showmaterial() 
   {  
    $('#sel_prod').change(function(){ 
      var sel_prod = $('#sel_prod').val();
      var selmo_code = $('#selmo_code').val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url();?>owner/mrp/showmaterial',
        data: {sel_prod: sel_prod, selmo_code: selmo_code},
        beforeSend: function () {
          $('.manufacturingloading').show();
        },
        success: function (html) {
         $('#productMRP').html(html);
         $('.manufacturingloading').fadeOut("slow");
       }
     });
    });
  }



  //  function Showproduct2() 
  //  {  
  //    $('#selmo_code').change(function(){ 
  //     var selmo_code = $('#selmo_code').val();
  //     $.ajax({
  //       type: 'POST',
  //       url: '<?php echo base_url(); ?>production/mrp/showproductmrp2',
  //       data:'&selmo_code='+selmo_code,
  //       beforeSend: function () {
  //         $('.manufacturingloading').show();
  //       },
  //       success: function (html) {
  //         $('#productMRP').html(html);
  //         $('.manufacturingloading').fadeOut("slow");
  //       }
  //     });
  //   });
  //  }




});
</script>


