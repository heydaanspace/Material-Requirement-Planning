<section class="section">
  <div class="section-header">
    <h1>Kartu Produk</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Kartu Produk</div>
    </div>
  </div>
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="col-4 text-left">
              <h4>Daftar Produk</h4>
            </div>
            <div class="col-8 text-right">
              <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>staff/product_card/newproduct"><i class="fas fa-credit-card"></i> Kartu Produk Baru</a>
              <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>staff/product_card/newbom"><i class="fas fa-cubes"></i> Tetapkan Struktur Produk</a>
              <div class="dropdown d-inline mr-2">
                <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-file-export"></i> Unduh
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">PDF</a>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="card-body">
           <div class="form-row">
            <div class="form-group col-md-4">
              <input type="text" class="form-control" id="keywords" placeholder="Cari produk" onkeyup="searchFilter()">
            </div>
            <div class="form-group col-md-2">
              <select class="form-control" id="sortBy" onchange="searchFilter()">
                <option value="">Urutkan</option>
                <option value="asc">A-Z</option>
                <option value="desc">Z-A</option>
              </select>
            </div>
          </div>
          <div class="card-body p-0" id="productList">
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
                    <td><a href="<?php echo base_url() ?>staff/product_card/showdetailbom/<?php echo $product_card['sku_id']; ?>"><?php echo $product_card['product_sku']; ?></a></td>
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
     </div>
     <div class="prodloading" style="display: none;">
      <div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</section>


<!------ Embeded JS ------->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  //JS Live search & pagination
  function searchFilter(page_num) 
  {
   page_num = page_num?page_num:0;
   var keywords = $('#keywords').val();
   var sortBy = $('#sortBy').val();
   $.ajax({
    type: 'POST',
    url: '<?php echo base_url(); ?>staff/product_card/ajaxPaginationData/'+page_num,
    data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
    beforeSend: function () {
     $('.prodloading').show();
   },
   success: function (html) {
     $('#productList').html(html);
     $('.prodloading').fadeOut("slow");
   }
 });
 }

//JS delete product
function deleteConfirm(url)
{
  $('#btn-delete').attr('href', url);
  $('#deletemodal').modal();
}

//JS load BOM
function load_bom(product_sku)
{
  $.ajax({
    url: "<?php echo site_url('staff/product_card/showbom');?>",
    type: "POST",
    data: {product_sku: product_sku},
    success: function (response) {
      $(".displaybom").html(response);
        //alert('YUp');
      }
    });

}
</script>


<!---------- Modal Place -------->
<!-- Modal Delete Confirmation-->
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"><strong>Hapus produk juga akan menghapus semua data varian dan tidak bisa dikembalikan.</strong></strong></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal view BOM -->
<div class="modal fade displaybom" id="modal_bom">
  <?php include('modal_view/modal_view_bom.php') ?>


