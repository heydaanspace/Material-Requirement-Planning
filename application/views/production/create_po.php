<section class="section">

  <div class="section-header">
    <h1>Pesanan Produksi Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>production/home">Dasbor</a></div>
      <div class="breadcrumb-item"><a href="<?php echo base_url(); ?>production/manufacturing">Penanan Produksi</a></div>
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
            <h4>Buat Pesanan Pembelian Bahan Baku</h4>
          </div>
          <form action="<?php echo site_url('production/purchase_order/savepo') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Nomor PO</label>
                  <input type="text" class="form-control" name="ipo_code" placeholder="" value="<?= $po_code; ?>" readonly>
                  <input type="hidden" class="form-control" name="ipo_type" placeholder="" value="Non Rujukan">
                </div>
                <div class="form-group col-md-4">
                </div>
                <div class="form-group col-md-4">
                  <label>Tanggal dibuat</label>
                  <input type="hidden" class="form-control" name="icreate_date" id="icreate_date" value="<?= date('Y-m-d'); ?>" readonly> 
                  <p style="font-size: 12px; font-weight: 800; color: #e41857;"><?= date('d-m-Y'); ?></p>
                </div>
              </div>
              <hr>
              <div class="card-body p-0">
               <div class="table-responsive">
                <table id="tbvarian" class="table table-bordered">
                  <tr>
                    <th><div style="width: 220px;">Item</div></th>
                    <th><div style="width: 220px;">Mitra Supplier</div></th>
                    <th><div style="width: 150px;">Rencana Penerimaan</div></th>
                    <th><div style="width: 150px;">Leadtime</div></th>
                    <th><div style="width: 100px;">Jumlah</div></th>
                    <th><div style="width: 100px;">Satuan Unit</div></th>
                    <th><div style="width: 100px;">Harga Per Unit</div></th>
                    <th><div style="width: 100px;">Total Harga</div></th>
                    <th><div style="width: 100px;"></div></th>
                  </tr>
                  <tr class="item_po">
                    <td>
                      <select class="form-control selitem_po" name="selitem_po[]" id="selitem_po">
                        <option value=""></option>
                        <?php foreach($material_list as $material):?>
                          <?php if(!empty($material->mv_option)) {   ?>
                            <option value="<?= $material->inv_id ?>">
                              <?= $material->material_name; ?> / <?= $material->mv_value ?>
                            </option>
                          <?php } else {  ?>
                            <option value="<?= $material->inv_id ?>">
                              <?= $material->material_name; ?>
                            </option>
                          <?php }  ?>
                        <?php endforeach;?>
                      </select>
                    </td>
                    <td>
                      <select class="form-control selitem_sup" name="selsupplier_po[]">
                        <option></option>
                        <?php foreach($supplier as $data):?>
                          <option value="<?= $data->supplier_id ?>">
                            <?= $data->supplier_name ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td>
                     <input type="date" class="form-control" name="ischedule_receipt[]" id="ischedule_receipt">
                   </td>
                   <td>
                    <div class="input-group">
                     <input type="text" class="form-control" name="ileadtime" id="ileadtime">
                     <div class="input-group-prepend">
                      <div class="input-group-text">
                        Hari
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <input type="number" class="form-control iqty_po amount" name="iqty_po[]" id="iqty_po">
                </td>
                <td>
                  <input type="text" style="text-align: center;" class="form-control iuom btn-primary" name="iuom[]" id="iuom">
                </td>
                <td>
                  <input type="text" class="form-control iprice" name="iprice[]" id="iprice" readonly>
                </td>
                <td>
                  <input type="text" class="form-control isubtotal_price" name="isubtotal_price[]" id="isubtotal_price" readonly>
                </td>
                <td>
                  <input type="hidden" value="Belum diterima" name="istatus[]">
                  <div class="true">
                    <a class="btn_td" href="">Tidak Tersedia  <i class="fa fa-info-circle"></i></a>
                  </div>
                </td>
              </tr>
            </table>
            <button class="btn btn-outline-primary" type="button" name="add" id="add"><i class="fa fa-plus-square"></i> Tambah Item</button>
            <br>
            <br>
          </div>
        </div>
        <br>
        <hr>
        <div class="form-row">
          <div class="form-group col-md-6">
          </div>
          <div class="form-group col-md-6">
            <label>Total Biaya</label>
            <input type="number" class="form-control igrand_total" name="igrand_total" id="igrand_total" readonly>
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

<script type="text/javascript">
  $(document).ready(function(){ 
    addrows();
    deleterows(); 
    initailizeSelitemPO();
    initailizeSelitemSUP();
    ajaxData();  

    var i=1;
    function addrows()
    {  
      $('#add').click(function(){  
        i++;  
        $('#tbvarian tbody').append('<tr id="row'+i+'" class="item_po"><td><select class="form-control selitem_po" name="selitem_po[]" id="selitem_po'+i+'"><option value=""></option><?php foreach($material_list as $material):?><?php if(!empty($material->mv_option)){?><option value="<?= $material->inv_id ?>"><?= $material->material_name; ?> / <?= $material->mv_value ?> </option><?php } else {  ?><option value="<?= $material->inv_id?>"><?= $material->material_name; ?></option><?php } ?> <?php endforeach;?> </select></td> <td><select class="form-control selitem_sup" name="selsupplier_po[]"><option></option><?php foreach($supplier as $data):?><option value="<?= $data->supplier_id ?>"><?= $data->supplier_name ?></option><?php endforeach; ?></select></td><td><input type="date" class="form-control ischedule_receipt" name="ischedule_receipt[]" id="ischedule_receipt"></td><td><div class="input-group"><input type="text" class="form-control ileadtime" name="ileadtime"><div class="input-group-prepend"><div class="input-group-text">Hari</div></div></div></td><td><input type="text" class="form-control iqty_po amount" name="iqty_po[]"></td><td><input type="text" style="text-align: center;" class="form-control iuom btn-primary" name="iuom[]"></td><td><input type="text" class="form-control iprice" name="iprice[]" readonly></td> <td><input type="text" class="form-control isubtotal_price" name="isubtotal_price[]" readonly></td><td><input type="hidden" value="Belum diterima" name="istatus[]"><div class="true"><a class="btn_td" href="">Tidak Tersedia  <i class="fa fa-info-circle"></i></a></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-trash"></button></td></tr>'); 
        initailizeSelitemPO();
        initailizeSelitemSUP();
        ajaxDataDynamic();
        sumtotalamount();
      });
    }

    function deleterows()
    {
      $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();
        sumtotalamount();
      });
    }

    function initailizeSelitemPO(){
      $('.selitem_po').select2({
        width: '100%',
        placeholder: 'Pilih bahan baku',
        escapeMarkup: function (markup) { return markup; }
      });  
    }

    function initailizeSelitemSUP(){
      $('.selitem_sup').select2({
        width: '100%',
        placeholder: 'Pilih supplier',
        escapeMarkup: function (markup) { return markup; }
      });  
    }

    $(document).on("keyup", ".amount", sumtotalamount);

    function sumtotalamount() {
      $(".item_po").each(function () {
        var iqty            = 0;
        var iprice          = 0;
        var isubtotal_price = 0;
        if (!isNaN(parseFloat($(this).find(".iqty_po").val()))) {
          iqty = parseFloat($(this).find(".iqty_po").val());
        }
        if (!isNaN(parseFloat($(this).find(".iprice").val()))) {
          iprice  = parseFloat($(this).find(".iprice").val());
        }
        isubtotal_price = iqty * iprice;
        $(this).find(".isubtotal_price").val(isubtotal_price.toFixed());
      });

      var sum = 0;
      $(".isubtotal_price").each(function () {
        if (!isNaN(this.value) && this.value.length != 0) {
          sum += parseFloat(this.value);
        }
      });
      $("#igrand_total").val(parseFloat(sum.toFixed()));
    }


    function getPorel() {
      $('#ileadtime').ready(function() {
        var leadtime = $('#ileadtime').val()-0;
        //alert(leadtime)
        var today = new Date(); 
        today.setDate(today.getDate()+leadtime);
        var dd = today.getDate();
        var mm = today.getMonth()+1; 
        var yyyy = today.getFullYear(); 
        if (dd < 10) { dd = '0' + dd; } 
        if (mm < 10) { mm = '0' + mm; } 
        var today = yyyy+'-'+mm+'-'+dd; 
        $('#ischedule_receipt').val(today);
      });
    }


    function getPoreldynamic() {
      $('.ileadtime').each(function() {
        var dynamicporel = $(this).closest('tr');
        //var leadtime = $('#ileadtime').val()-0;
        var leadtime = dynamicporel.find(".ileadtime").val()-0;
        //alert(leadtime);
        var today = new Date(); 
        today.setDate(today.getDate()+leadtime);
        var dd = today.getDate();
        var mm = today.getMonth()+1; 
        var yyyy = today.getFullYear(); 
        if (dd < 10) { dd = '0' + dd; } 
        if (mm < 10) { mm = '0' + mm; } 
        var today = yyyy+'-'+mm+'-'+dd; 
        //$('#ischedule_receipt').val(today);
        dynamicporel.find(".ischedule_receipt").val(today);

      });
    }



      //pass data from select item product
      function ajaxData() {
        $('#selitem_po').change(function(){ 
          var inv_id=$(this).val();
          $.ajax({
            url : "<?php echo site_url('production/purchase_order/showmaterialAjax');?>",
            method : "POST",
            data : {inv_id: inv_id},
            async : true,
            dataType : 'json',
            success: function(data){
              leadtime       = data[0].leadtime;
              material_unit  = data[0].material_unit;
              material_price = data[0].material_price;
              $('#ileadtime').val(leadtime);
              $('#iuom').val(material_unit);
              $('#iprice').val(material_price);
              sumtotalamount();
              getPorel();
            }
          });
          return false;
        }); 
      }
    //pas data from select item product dynamic
    function ajaxDataDynamic() {
      $('.selitem_po').change(function(){ 
        var dynamicfield = $(this).closest('tr');
        var inv_id = dynamicfield.find(".selitem_po").val();
        $.ajax({
          url : "<?php echo site_url('production/purchase_order/showmaterialAjax');?>",
          method : "POST",
          data : {inv_id: inv_id},
          async : true,
          dataType : 'json',
          success: function(data){
            leadtime       = data[0].leadtime;
            material_unit  = data[0].material_unit;
            material_price = data[0].material_price;
            dynamicfield.find(".ileadtime").val(leadtime);
            dynamicfield.find(".iuom").val(material_unit);
            dynamicfield.find(".iprice").val(material_price);
            sumtotalamount();
            getPoreldynamic();
          }
        });
        return false;
      }); 
    }

  }); 
</script>


