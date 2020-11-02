<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th></th>
      <th><div style="width: 100px;">No. PO</div></th>
      <th><div style="width: 70px;">Dibuat Pada</div></th>
      <th><div style="width: 90px;">Total Biaya</div></th>
      <th><div style="width: 150px;">Jumlah Item</div></th>
      <th>Status PO</th>
    </tr>
    <?php foreach ($po_list as $data): ?>
     <tr>
      <td><i class="fas fa-shopping-basket"></i></td>
      <td><a href="<?php echo base_url() ?>production/purchase_order/showdetailPO/<?php echo $data['po_id']; ?>"><?= $data['po_code'] ?></a></td> 
      <td><div class="badge badge-info"><?= formatDMY($data['created_date']); ?></div></td> 
      <td>Rp. <?= rupiah($data['total_cost']); ?></td> 
      <td><a href="#" data-toggle="modal" data-target="#modal_item_po" onclick="javascript:load_itemPO(<?= $data['po_id']; ?>)"><?= $data['jml_item']; ?> Item Pembelian</a>
      </td> 
      <td>
       <?php if ($data['status_po'] === "Sudah diterima") { ?>
        <div class="badge badge-success">Selesai</div>
      <?php } else { ?>
        <div class="badge badge-danger">Belum Selesai</div>
      <?php } ?>
    </td> 
  </tr>
<?php endforeach; ?>
</table>
</div>
<?php echo $this->ajax_pagination->create_links(); ?>