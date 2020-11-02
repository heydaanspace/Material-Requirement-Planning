<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th></th>
      <th>SKU</th>
      <th>Kategori</th>
      <th>Item Bahan Baku/Varian</th>
      <th>Harga beli per Unit</th>
      <th>Stok</th>
      <th>Jadwal Penerimaan</th>
      <th>Jumlah Penerimaan</th>
      <th>Nilai Akumulasi Stok</th>
      <th></th>
    </tr>
    <?php if(!empty($inventory)): foreach($inventory as $data): ?>
      <tr>
        <td><i class="fa fa-cube"></i></td>
        <td><div style="width: 100px;">
          <a href=""><?= $data['material_sku'];?></a>
        </div>
      </td>
      <td>
        <?= $data['category_name']; ?>
      </td>
      <td>
        <div style="width: 150px;">
          <?php if (!empty($data['mv_option'])) { ?>
            <strong><?= $data['material_name']; ?></strong>/<?= $data['mv_value']; ?>
          <?php } else { ?>
           <strong><?= $data['material_name']; ?></strong>
         <?php } ?>
       </div>
     </td>
     <td>
      <div style="width: 100px;">
        Rp. <?= rupiah($data['material_price']) ?>
      </div>
    </td>
    <td><div style="width: 100px;"><?= $data['quantity'];?> <?php echo  $data['material_unit']; ?> <div style="width: 100px;"></div></td>
    <td>
      <?php if (!empty($data['schedule_receipt'])) { ?>
        <div style="width: 100px;">
          <?= formatDMY($data['schedule_receipt']); ?>
        </div>
      <?php } else {?>
        <div style="width: 150px;">
          <a class="badge badge-danger" href="">Belum ada PO <i class="fa fa-info-circle"></i></a>
        </div>
      <?php } ?>
    </td>
    <td>
      <?php if (!empty($data['quantity_po'])) { ?>
        <div style="width: 100px;">
          <?= $data['quantity_po'] ?> <?php echo  $data['material_unit']; ?>
        </div>
      <?php } else {?>
        <div style="width: 150px;">
          <a class="badge badge-danger" href="">Belum ada PO <i class="fa fa-info-circle"></i></a>
        </div>
      <?php } ?>
    </td>
    <td><div style="width: 100px;">Rp. <?= rupiah($data['value_in_stock']);?></div></td>
    <td>
      <div style="width: 150px;">
        <a class="" href=""><i class="fa fa-plus-square"></i> Buat PO</a>
      </div>
    </td>
  </tr>
<?php endforeach; else: ?>
<tr>
  <td>Not Found</td>
</tr>
<?php endif; ?>
</table>
</div>
<?php echo $this->ajax_pagination->create_links(); ?>