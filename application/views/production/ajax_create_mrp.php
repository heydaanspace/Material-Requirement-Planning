  <?php foreach ($item_product as $data): ?>
    <div class="form-row">
     <div class="form-group col-md-2">
      <label>Item Produk</label> <br>
      
      <?php if (!empty($data['variant_option'])) { ?>
        <a class="badge badge-primary" href="#"><?= $data['product_name']; ?></a> |
        <a class="badge badge-success" href="#"><?= $data['option_value']; ?></a>
      <?php } else { ?>
        <a class="badge badge-primary" href="#"><?= $data['product_name']; ?></a>
      <?php } ?>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th><div style="width: 100px">Item Bahan Baku</div></th>
        <th><div style="width: 100px">Stok Tersedia</div></th>
        <th><div style="width: 100px">Jadwal Penerimaan</div></th>
        <th><div style="width: 200px">Jumlah penerimaan Terjadwal</div></th>
        <th><div style="width: 100px">Kebutuhan Kotor</div></th>
        <th><div style="width: 100px">Kebutuhan Bersih</div></th>
        <th><div style="width: 100px">Waktu Maksimal Pemesanan</div></th>
        <th><div style="width: 100px">Jumlah harus dipesan</div></th>
        <th></th>
      </tr>
      <?php foreach ($item_product as $subdata): ?>
        <tr>
          <td><div style="width: 100px"><?= $subdata['material_name']; ?></div></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <br>
  <br>
  <?php endforeach; ?>