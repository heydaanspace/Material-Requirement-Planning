
<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th></th>
      <th>Tanggal Pembelian</th>
      <th>SKU</th>
      <th>Kategori</th>
      <th>Item Bahan Baku/Varian</th>
      <th>Harga beli per Unit</th>
      <th><div style="width: 100px;">Stok Masuk</div></th>
      <th><div style="width: 100px;">Nilai Akumulasi Stok</div></th>
    </tr>
    <?php if(!empty($inventory)): foreach($inventory as $data): ?>
      <tr>
        <td><i class="fa fa-cube"></i></td>
        <td><div style="width: 100px;" class="badge badge-success">
          <?= formatDMY($data['created_date']);  ?>
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
    <div class="false">
      <p style="color: white;">
       <?= $data['quantity_po'];?> <?php echo  $data['material_unit']; ?> <div style="width: 100px;">
       </p>
     </div>
   </td>
   <td>
    <div class="false">
      <p style="color: white;">
        Rp. <?php 
        $qty = $data['quantity_po'];
        $price = $data['material_price'];
        echo rupiah($qty*$price);
        ?>
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