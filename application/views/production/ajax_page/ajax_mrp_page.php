<div class="table-responsive">
  <table class="table table-striped">
    <tr>
     <th style="text-align: center;"></th>
     <th style="width: 100px;">No. MRP</th>
     <th>No. Produksi</th>
     <th>Produk</th>
     <th>Jumlah Produksi</th>
     <th><div style="width: 100px;"></div></th>
   </tr>
   <?php if(!empty($mrp_data)): foreach($mrp_data as $data): ?>
     <tr>
       <td><i class="fa fa-calculator"></i></td> 
       <td><a class="badge badge-primary" href="<?php echo base_url() ?>production/mrp/showdetailmrp/<?php echo $data['mrp_code']; ?>"><?= $data['mrp_code'] ?></a></td> 
       <td><a href="<?php echo base_url() ?>production/mrp/showRecapPorel/<?= $data['mo_id']; ?>"><?= $data['mo_code'] ?></a></td> 
       <td>
        <?php if (empty($data['variant_option'])) { ?>
          <p class="badge badge-success"><?= $data['product_name'] ?></p>
        <?php } else { ?>
          <p class="badge badge-success"><?= $data['product_name'] ?> | <?= $data['option_value'] ?></p>
        <?php } ?>
      </td> 
      <td><?= $data['jml_prod'] ?> <?= $data['unit'] ?></td> 
      <td>
       <div class="false" style="text-align: center;">
        <a class="btn_td" href="<?php echo base_url() ?>production/mrp/showRecapPorel/<?= $data['mo_id']; ?>">Lihat Rekap <i class="fa fa-eye"></i></a>
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