
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Daftar Struktur Produk</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
     <table class="table table-striped">
      <tbody>

        <tr>
          <th>Material SKU</th>
          <th>Komponen</th>
          <th>QTY</th>
        </tr>
        <?php foreach ($bom_list as $data): ?>
          <tr>
            <td><?php echo $data['material_sku']; ?></td>
            <td>
              <?php if (!empty($data['mv_option'])) { ?>
                <div class="badge badge-primary"><?php echo $data['material_name']; ?> / <?php echo $data['mv_value']; ?></div>
              <?php } else { ?>
                <div class="badge badge-primary"><?php echo $data['material_name']; ?></div>
              <?php } ?>
              
            </td>
            <td><?php echo $data['qty']; ?> <?php echo $data['material_unit']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>

