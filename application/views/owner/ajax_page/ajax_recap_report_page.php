
<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th></th>
      <th>Periode Produksi</th>
      <th>SKU</th>
      <th>Kategori</th>
      <th>Item Bahan Baku/Varian</th>
      <th>Harga beli per Unit</th>
      <th><div style="width: 100px;">Stok Awal</div></th>
      <th><div style="width: 100px;">Stok Masuk</div></th>
      <th><div style="width: 100px;">Stok dibutuhkan</div></th>
      <th><div style="width: 100px;">Sisa Stok</div></th>
    </tr>
    <?php if(!empty($inventory)): foreach($inventory as $data): ?>
      <tr>
        <td><i class="fa fa-cube"></i></td>
        <td><div style="width: 100px;">
          <?php if (!empty($data['created_date'])) { ?>
            <?= formatDMY($data['created_date']);  ?>
          <?php } else { ?>
            <p>Tidak ada</p>
          <?php } ?>
        </div>
      </td>
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
  <td>
    <div class="true">
      <p style="color: white;"><strong><?= $data['early_stock']; ?></strong>  <?= $data['material_unit']; ?></p>
    </div>
  </td>
  <td>
    <div class="true">
      <?php if ($data['status_po'] == "Sudah diterima") { ?>
        <p style="color: white;"><strong><?= $data['stok_masuk'];?></strong> <?= $data['material_unit']; ?></p>
      <?php } else { ?>
        <p style="color: white;">Belum ada</p>
      <?php } ?>
    </div>
  </td>
  <td>
    <div class="true">
      <p style="color: white;">
        <?php if (!empty($data['stok_keluar'])) { ?>
         <strong><?= $data['stok_keluar']; ?> <?= $data['material_unit']; ?>
       <?php } else { ?>
        0  <?= $data['material_unit']; ?>
      <?php } ?>
    </div>
  </td>
  <td>
    <div class="true">
     <p style="color: white;">
      <?php if (!empty($data['sisa_stok'])) { ?>
        <strong><?= $data['sisa_stok']; ?></strong>  <?= $data['material_unit']; ?>
      <?php } else { ?>
        0  <?= $data['material_unit']; ?>
      <?php } ?>
    </p>
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