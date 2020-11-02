<div class="table-responsive">
  <table class="table table-striped">
    <tr>
      <th></th>
      <th>Product</th>
      <th>SKU</th>
      <th>Kategori</th>
      <th>Brand</th>
      <th>Unit</th>
      <th>Harga Jual</th>
      <th>Jumlah<br>Struktur Produk</th>
      <th></th>
    </tr>
    <?php if(!empty($product_card)): foreach($product_card as $product_card): ?>
      <tr>
        <td><i class="fa fa-credit-card"></i></td>
        <td>
          <a href="<?php echo base_url() ?>staff/product_card/editproductcard/<?php echo $product_card['product_code']; ?>">
            <?php if(!empty($product_card['variant_option'])) {   ?>
              <strong><?php echo $product_card['product_name']; ?></strong> 
              / <?php echo $product_card['option_value']; ?>
            <?php } else {  ?>
              <?php echo $product_card['product_name']; ?>
            <?php }  ?>
          </a>
        </td>
        <td><a href="<?php echo base_url() ?>staff/product_card/showdetailbom/<?php echo $product_card['product_sku']; ?>"><?php echo $product_card['product_sku']; ?></a></td>
        <td><?php echo $product_card['category_name']; ?></td>
        <td><?php echo $product_card['product_brand']; ?></td>
        <td><?php echo $product_card['unit']; ?></td>
        <td>Rp. <?php echo rupiah($product_card['sales_price']); ?></td>
        <td style="text-align: center;">
          <?php if(empty($product_card['jumlah'])) { ?>
            <p class="badge badge-danger">Belum ditetapkan.</p>
          <?php } else {  ?>
           <a href="#" data-toggle="modal" data-target="#modal_bom" onclick="javascript:load_bom(<?php echo $product_card['sku_id']; ?>)">
            <?php echo $product_card['jumlah'];?> Komponen
          </a>
        <?php }  ?>
      </td>
      <td>
        <div class="dropdown d-inline">
          <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tindakan
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item has-icon" href="<?php echo base_url() ?>staff/product_card/editproductcard/<?php echo $product_card['product_code']; ?>"><i class="fas fa-edit"></i>Ubah</a>
            <a onclick="deleteConfirm('<?php echo base_url() ?>staff/product_card/delproduct/<?php echo $product_card['product_code']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
            <a class="dropdown-item has-icon" href=""><i class="fas fa-cubes"></i>Tetapkan Struktur Produk</a>
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