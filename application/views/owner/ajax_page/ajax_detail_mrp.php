   <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th></th>
        <th><div style="width: 100px">Item Bahan Baku</div></th>
        <th><div style="width: 100px">Leadtime Pasokan</div></th>
        <th><div style="width: 110px">Stok Tersedia</div></th>
        <th><div style="width: 150px">Jadwal Penerimaan</div></th>
        <th><div style="width: 150px">Jumlah penerimaan Terjadwal</div></th>
        <th><div style="width: 120px">Kebutuhan per unit produk</div></th>
        <th><div style="width: 150px">Kebutuhan Kotor</div></th>
        <th><div style="width: 150px">Kebutuhan Bersih</div></th>
        <th><div style="width: 100px">Waktu Maksimal Pemesanan</div></th>
        <th><div style="width: 150px">Jumlah harus dipesan</div></th>
        <!--  <th><div style="width: 100px;"></div></th> -->
      </tr>
      <?php foreach ($item as $data): ?>
        <tr>
          <th><i class="fa fa-calculator"></i></th>
          <td>
            <?php if (empty($data->mv_option)) { ?>
              <a href="#" class="badge badge-primary"><?= $data->material_name; ?></a>
            <?php } else {?>
              <a href="#" class="badge badge-primary"><?= $data->material_name; ?> / <?= $data->mv_value; ?></a>
            <?php } ?>
          </td>
          <td><?= $data->leadtime; ?> Hari</td>
          <td><?= $data->stok; ?> <?= $data->material_unit; ?></td>
          <td>
            <?php if (!empty($data->schedule_receipt)) {?>
             <div class="badge badge-warning"><?= formatDMY($data->schedule_receipt); ?></div>
           <?php } else { ?>
             <div class="badge badge-danger">Tidak ada</div>
           <?php } ?>

         </td>
         <td>
          <?php if (!empty($data->schedule_receipt)) {?>
           <?= $data->quantity_po; ?> <?= $data->material_unit; ?>
         <?php } else { ?>
          <div class="badge badge-danger">0</div>
        <?php } ?>
      </td>
      <td><?= $data->qty; ?> <?= $data->material_unit; ?></td>
      <td>
       <div class="true">
        <a class="btn_td" href=""> <?= $data->gross_req; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></a>
      </div>
    </td>
    <td>
     <div class="true">
      <a class="btn_td" href=""><?= $data->net_req; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></a>
    </div>
  </td>
  <td>
   <div class="true">
    <a class="btn_td" href=""><?= formatDMY($data->PORel); ?> <i class="fa fa-info-circle"></i></a>
  </div>
</td>
<td>
 <div class="true">
  <a class="btn_td" href=""><?= $data->qty_PORel; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></a>
</div>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>