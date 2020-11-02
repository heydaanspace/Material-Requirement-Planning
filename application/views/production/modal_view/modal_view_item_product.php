<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Daftar Item Produk Pesanan Produksi</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
     <table class="table table-striped">
      <tbody>
        <tr>
          <!-- <th></th> -->
          <th><div style="width: 100px;">Product SKU</div></th>
          <th>Item Produk</th>
          <th>Jumlah Produksi</th>
        </tr>
        <?php foreach ($item_product as $data): ?>
          <tr>
            <!-- <td>
              <a class="badge badge-primary" href=""><i class="fa fa-calendar-plus"></i> Tetapkan MRP</a>
            </td> -->
            <td><?php echo $data['product_sku']; ?></td>
            <td>
              <?php if(!empty($data['variant_option'])) {   ?>
                <strong><?php echo $data['product_name']; ?></strong> 
                / <?php echo $data['option_value']; ?>
              <?php } else {  ?>
                <strong><?php echo $data['product_name']; ?></strong>
              <?php }  ?>
            </td>
            <td><?php echo $data['quantity']; ?> <?php echo $data['unit']; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>

