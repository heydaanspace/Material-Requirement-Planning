<section class="section">
  <div class="section-header">
    <h1>Item Bahan Baku</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Item bahan baku</div>
    </div>
  </div>
  <div class="row">

  </div>
  <br>
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="col-4 text-left">
              <h4>Daftar bahan baku</h4>
            </div>
            <div class="col-8 text-right">
              <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>staff/item_material/newmaterial">
                <i class="fa fa-plus-square"></i> Bahan Baku Baru</a>
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
            <div class="card-body">
             <div class="form-row">
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="keywords" placeholder="Cari bahan baku" onkeyup="searchFilter()">
              </div>
              <div class="form-group col-md-2">
                <select class="form-control" id="sortBy" onchange="searchFilter()">
                  <option value="">Urutkan</option>
                  <option value="asc">A-Z</option>
                  <option value="desc">Z-A</option>
                </select>
              </div>
            </div>
            <div class="card-body p-0" id="materialList">
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
                        <a href="<?php echo base_url() ?>staff/item_material/editmaterial/<?php echo $material['material_code']; ?>">
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
                            <a class="dropdown-item has-icon" href="<?php echo base_url() ?>staff/item_material/editmaterial/<?php echo $material['material_code']; ?>"><i class="fas fa-cog"></i>Ubah</a>
                            <a onclick="deleteConfirm('<?php echo base_url() ?>staff/item_material/delmaterial/<?php echo $material['material_code']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
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


<!------------------------------------------------------------- Embeded File -------------------------------------------------------------->



<!-- JS Live Search & Pagination --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
  function searchFilter(page_num) {
   page_num = page_num?page_num:0;
   var keywords = $('#keywords').val();
   var sortBy = $('#sortBy').val();
   $.ajax({
    type: 'POST',
    url: '<?php echo base_url(); ?>staff/item_material/ajaxPaginationData/'+page_num,
    data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
    beforeSend: function () {
     $('.prodloading').show();
   },
   success: function (html) {
     $('#materialList').html(html);
     $('.prodloading').fadeOut("slow");
   }
 });
 }
</script>


<!-- JS Delete Confirmation-->
<script>
  function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
  }
</script>




<!-- Modal Delete Confirmation-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Hapus data material juga akan akan menghapus semua data varian dan tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>