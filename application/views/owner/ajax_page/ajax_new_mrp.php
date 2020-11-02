    <div class="form-row">
      <div class="form-group col-md-8">
        <label>Item Produk</label> <br>
        <?php if (!empty($item_material_of_product->variant_option)) { ?>
          <a class="badge badge-primary" href="#"><?= $item_material_of_product->product_name; ?></a>
          <a class="badge badge-success" href="#"><?= $item_material_of_product->option_value; ?></a>
        <?php }else{  ?>
          <a class="badge badge-primary" href="#"><?= $item_material_of_product->product_name; ?></a>
        <?php } ?>
      </div>
      <div class="form-group col-md-4">
       <label>Batas waktu pasokan</label> <br>
       <input class="btn btn-info" value="<?= formatDMY($detail_mo1->production_start); ?>" style="text-align: center;" type="text" readonly>
       <input type="hidden" class="btn btn-info iduedate" id="iduedate" value="<?= $detail_mo1->production_start; ?>" style="text-align: center;" type="text" readonly>
       <input type="hidden" name="id_det_mo" value="<?= $detail_mo2->id_det_mo; ?>">
     </div>
   </div>
   <br>
   <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th><div style="width: 150px">Item Bahan Baku</div></th>
        <th><div style="width: 100px">Leadtime Pasokan</div></th>
        <th><div style="width: 130px">Stok Tersedia</div></th>
        <th><div style="width: 150px">Jadwal Penerimaan</div></th>
        <th><div style="width: 150px">Jumlah penerimaan Terjadwal</div></th>
        <th><div style="width: 150px">Kebutuhan per unit produk</div></th>
        <th><div style="width: 150px">Kebutuhan Kotor</div></th>
        <th><div style="width: 150px">Kebutuhan Bersih</div></th>
        <th><div style="width: 100px">Waktu Maksimal Pemesanan</div></th>
        <th><div style="width: 150px">Jumlah harus dipesan</div></th>
      </tr>
      <?php foreach ($item_material as $data): ?>
        <tr class="item_mrp">
          <td>
            <div style="width: 200px;" class="badge badge-warning">
              <?php if (!empty($data['mv_option'])) { ?>
                <strong><?= $data['material_name']; ?></strong> / <?= $data['mv_value']; ?>
              <?php } else { ?>
               <strong><?= $data['material_name']; ?></strong>
             <?php } ?>
           </div>
         </td>
         <td>
          <div class="input-group">
           <input type="hidden" value="<?= $data['bom_code'] ?>" name="ibom_code[]">
           <input class="form-control" type="text" value="<?= $data['leadtime']; ?>">
           <div class="input-group-prepend">
            <div class="input-group-text">
              Hari
            </div>
          </div>
        </div>
      </td>
      <td>
        <div class="input-group">
          <input class="form-control" type="hidden" name="invid[]" value="<?= $data['inv_id']; ?>">
          <input class="form-control istok" id="istok" name="istok[]" type="text" value="<?= $data['quantity']; ?>">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <?= $data['material_unit']; ?>
            </div>
          </div>
        </div>
      </td>
      <td style="text-align: center;">
        <?php if (!empty($data['schedule_receipt'])) { ?>
          <input style="text-align: center;" type="text" value="<?= formatDMY($data['schedule_receipt']); ?>" readonly>
          <input style="text-align: center;" class="idatesr" id="idatesr" type="hidden" value="<?= $data['schedule_receipt']; ?>" readonly>
        <?php } else { ?>
          <div class="badge badge-danger">Tidak ada</div>
          <input type="hidden" style="text-align: center;" class="idatesr" id="idatesr" type="text" readonly>
        <?php } ?>
      </td>
      <td>
        <?php if (!empty($data['quantity_po'])) { ?>
          <div class="input-group">
            <input type="number" class="form-control iqtysr" id="iqtysr" value="<?= $data['quantity_po']; ?>" >
            <div class="input-group-prepend">
              <div class="input-group-text">
                <?= $data['material_unit']; ?>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="input-group">
            <input type="number" class="form-control iqtysr" id="iqtysr" value="0">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <?= $data['material_unit']; ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </td>
      <td>
       <div class="input-group">
        <input class="form-control iqtyreq" type="number" step="0.01" id="iqtyreq" value="<?= $data['qty']; ?>">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <?= $data['material_unit']; ?>
          </div>
        </div>
      </div>
    </td>
    <td>
      <div class="true">
       <div class="input-group">
         <input class="form-control btn_td igrossreq" step="0.01" style="text-align: center;" type="number" id="igrossreq" name="igrossreq[]">
         <div class="btn_td">
          <?= $data['material_unit'];?> <i class="fa fa-info-circle"></i>
        </div>
      </div>
    </div>
  </td>
  <td>
    <div class="true">
     <div class="input-group">
       <input class="form-control btn_td inetreq" step="0.01" style="text-align: center;" type="number" id="inetreq" name="inetreq[]">
       <div class="btn_td">
        <?= $data['material_unit'];?> <i class="fa fa-info-circle"></i>
      </div>
    </div>
  </div>
</td>
<td>
  <?php
  $date = date_create($detail_mo1->production_start);
  $get = $data['leadtime'];
  $lt = "-$get days";
  date_add($date, date_interval_create_from_date_string($lt));
  ?>
  <div class="true">
    <input class="form-control btn_td" style="text-align: center;" type="hidden" value="<?= date_format($date, 'Y-m-d'); ?>" name="iporel[]">
    <input class="form-control btn_td" style="text-align: center;" type="text" value="<?= date_format($date, 'd-m-Y'); ?>">
  </div>
</td>
<td>
 <div class="true">
   <div class="input-group">
    <input class="form-control btn_td iqtyporel" step="0.01" type="text" id="iqtyporel" name="iqtyporel[]">
    <div class="btn_td">
      <?= $data['material_unit'];?> <i class="fa fa-info-circle"></i>
    </div>
  </div>
</div>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>
<br>
<!-- <button class="btn btn-icon icon-left btn-primary" type="button" id="btnmrp"><i class="fa fa-hourglass-start"></i> Gross Req.</button> -->
<button class="btn btn-icon icon-left btn-primary" type="button" id="btn_grossreq"><i class="fa fa-hourglass-start"></i> Tentukan Kebutuhan Kotor.</button>
<button class="btn btn-icon icon-left btn-primary" type="button" id="btn_netreq"><i class="fa fa-hourglass-start"></i> Proses MRP.</button>
<br>
<br>
<script>
  $(document).ready(function(){
    //grossreq();
    $(document).on("click", "#btn_grossreq", grossreq);

    function grossreq() {
      $(".item_mrp").each(function () {
        var qtyprod    = 0;
        var qtyreq     = 0;
        var grossreq   = 0;
        qtyprod = parseFloat($("#iqtyprod").val());
        if (!isNaN(parseFloat($(this).find(".iqtyreq").val()))) {
          qtyreq  = parseFloat($(this).find(".iqtyreq").val());
        }
        grossreq = qtyprod * qtyreq;
        //var result = grossreq.toString();
        $(this).find(".igrossreq").val(grossreq.toFixed(1));
      });
    }

    $(document).on("click", "#btn_netreq", netReq);

    function netReq() 
    {
      $(".item_mrp").each(function () {
        $('.manufacturingloading').show();

        var grossreq = $(this).find('.igrossreq').val()-0; 
        var stok     = $(this).find('.istok').val()-0;             
        var duedate  = $('#iduedate').val();               
        var qtysr    = 0;    
        var datesr   = $(this).find('.idatesr').val();   
        if (!isNaN(parseFloat($(this).find(".iqtysr").val()))) {
          qtysr  = parseFloat($(this).find(".iqtysr").val()); }

          if (datesr) 
          {
            if (datesr <= duedate) {

              if (stok+qtysr-grossreq > 0) {
                $(this).find('.inetreq').val(0);
                $(this).find('.iqtyporel').val(0); 
              } else {
                var netreq1 = Math.abs(stok+qtysr-grossreq)
                $(this).find('.inetreq').val(netreq1); 
                $(this).find('.iqtyporel').val(netreq1); 
              }

            } else {

              if (stok-grossreq > 0) {
                $(this).find('.inetreq').val(0);
                $(this).find('.iqtyporel').val(0); 
              } else {
                var netreq2 = Math.abs(stok-grossreq)
                $(this).find('.inetreq').val(netreq2);
                $(this).find('.iqtyporel').val(netreq2);
              }

            }
          } else {

            if (stok-grossreq > 0) {
              $(this).find('.inetreq').val(0);
              $(this).find('.iqtyporel').val(0); 
            } else {
              var netreq3 = Math.abs(stok-grossreq);
              $(this).find('.inetreq').val(netreq3);
              $(this).find('.iqtyporel').val(netreq3);
            }

          }
          $('.manufacturingloading').fadeOut("slow");
        });

    }
  });

</script>

