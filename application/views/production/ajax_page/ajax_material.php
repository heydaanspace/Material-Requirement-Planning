 <div class="table-responsive">
  <table class="table table-striped">
    <tr>
     <th></th>
     <th><div style="width: 120px;">Item Bahan Baku</div></th>
     <th>SKU</th>
     <th><div style="width: 100px;">Kategori</div></th>
     <th>Satuan Ukur</th>
     <th><div style="width: 100px;">Leadtime / Waktu ancang</div></th>
     <th><div style="width: 100px;">Harga Beli</div></th>
     <th></th>
   </tr>
   <?php if(!empty($item_material)): foreach($item_material as $material): ?>
    <tr>
      <td><i class="fa fa-cube"></i></td>
      <td>
        <a href="<?php echo base_url() ?>production/item_material/editmaterial/<?php echo $material['material_code']; ?>">
          <?php if(!empty($material['mv_option'])) {   ?>
            <strong><?php echo $material['material_name']; ?></strong> 
            / <?php echo $material['mv_value']; ?>
          <?php } else {  ?>
            <?php echo $material['material_name']; ?>
          <?php }  ?>
        </a>
      </td>
      <td><?php echo $material['material_sku']; ?></td>
      <td><?php echo $material['category_name']; ?></td>
      <td><?php echo $material['material_unit']; ?></td>
      <td style="text-align: center;"><?php echo $material['leadtime'];?> Hari</td>
      <td>Rp. <?php echo rupiah($material['material_price']); ?></td>
      <td>
        <div class="dropdown d-inline">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tindakan
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item has-icon" href="<?php echo base_url() ?>production/item_material/editmaterial/<?php echo $material['material_code']; ?>"><i class="fas fa-cog"></i>Ubah</a>
            <a onclick="deleteConfirm('<?php echo base_url() ?>production/item_material/delmaterial/<?php echo $material['material_code']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
          </div>
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