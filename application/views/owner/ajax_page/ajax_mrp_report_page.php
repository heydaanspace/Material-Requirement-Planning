 <div class="table-responsive">
  <table class="table table-bordered">
    <tr>
     <th style="text-align: center;"></th>
     <th style="width: 100px;">No. MRP</th>
     <th>No. Produksi</th>
     <th>Produk</th>
     <th>Jumlah Produksi</th>
     <th><div style="width: 100px;">Total Bahan Baku</div></th>
   </tr>
   <?php if(!empty($mrp_list)): foreach($mrp_list as $data): ?>
     <tr>
       <td><i class="fa fa-calculator"></i></td> 
       <td>
        <p class="badge badge-primary"><?= $data['mrp_code'] ?></p>
      </td> 
      <td>
        <p><strong><?= $data['mo_code'] ?></strong></p>
      </td> 
      <td>
        <?php if (empty($data['variant_option'])) { ?>
          <p class="badge badge-success"><?= $data['product_name'] ?></p>
        <?php } else { ?>
          <p class="badge badge-success"><?= $data['product_name'] ?> | <?= $data['option_value'] ?></p>
        <?php } ?>
      </td> 
      <td><?= $data['jml_prod'] ?></td> 
      <td>
       <div class="false" style="text-align: center;">
        <p class="btn_td"><?= $data['qty_material']; ?> Komponen</p>
      </div>
    </td> 
  </tr>
<?php endforeach; else: ?>
<tr>
  <td><div class="badge badge-danger">Tidak ditemukan.</div></td>
</tr>
<?php endif; ?>
</table>
</div>
<?php echo $this->ajax_pagination->create_links(); ?>