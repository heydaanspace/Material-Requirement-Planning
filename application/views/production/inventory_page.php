<section class="section">
  <div class="section-header">
    <h1>Inventori</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Inventori</div>
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
              <h4>Daftar Stok Bahan Baku</h4>
            </div>
            <div class="col-8 text-right">
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
            <!-- Navigasi -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" style="font-weight: bold;" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inventory</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" style="font-weight: bold;" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Penyesesuaian Stok</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label style="font-weight: 10px;">Cari nama item</label>
                    <input type="text" class="form-control" id="keywords" placeholder="Kata kunci"  onkeyup="searchFilter()">
                  </div>
                  <div class="form-group col-md-2">
                   <label>Urutkan</label>
                   <select class="form-control" id="sortBy" onchange="searchFilter()">
                    <option value="asc">A-Z</option>
                    <option value="desc">Z-A</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                 <label>Tampilkan berdasarkan jadwal penerimaan</label>
                 <input type="date" class="form-control" id="sortDate" onchange="searchFilter()">
               </div>
             </div>
             <div class="card-body p-0" id="inventoryList">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th></th>
                    <th>Item Bahan Baku/Varian</th>
                    <th>SKU</th>
                    <th>Kategori</th>
                    <th>Harga beli per Unit</th>
                    <th>Stok</th>
                    <th>Jadwal Penerimaan</th>
                    <th>Jumlah Penerimaan</th>
                    <th>Nilai Akumulasi Stok</th>
                    <th></th>
                  </tr>
                  <?php if(!empty($inventory)): foreach($inventory as $data): ?>
                    <tr>
                      <td><i class="fa fa-cube"></i></td>
                      <td>
                        <div style="width: 150px;">
                          <?php if (!empty($data['mv_option'])) { ?>
                            <a href="<?php echo base_url() ?>production/item_material/editmaterial/<?php echo $data['material_code']; ?>"><strong><?= $data['material_name']; ?></strong>/<?= $data['mv_value']; ?> </a>
                          <?php } else { ?>
                           <a href="<?php echo base_url() ?>production/item_material/editmaterial/<?php echo $data['material_code']; ?>">
                            <strong><?= $data['material_name']; ?></strong></a>
                          <?php } ?>
                        </div>
                      </td>
                      <td>
                       <strong><?= $data['material_sku'];?></strong>
                     </td>
                     <td>
                      <?= $data['category_name']; ?>
                    </td>
                    <td>
                      <div style="width: 100px;">
                        Rp. <?= rupiah($data['material_price']) ?>
                      </div>
                    </td>
                    <td><div style="width: 100px;"><?= $data['quantity'];?> <?php echo  $data['material_unit']; ?> <div style="width: 100px;"></div></td>
                    <td>
                      <div style="width: 100px;">
                        <?php if (!empty($data['schedule_receipt']) && $data['status_po'] == "Belum diterima" ) { ?>
                         <?= formatDMY($data['schedule_receipt']); ?>
                       <?php } else { ?>
                        <a class="badge badge-danger" href="">Belum ada PO <i class="fa fa-info-circle"></i></a>
                      <?php } ?>
                    </div>
                  </td>
                  <td>
                    <?php if (!empty($data['quantity_po']) && $data['status_po'] == "Belum diterima" ) { ?>
                      <div style="width: 100px;">
                        <?= $data['quantity_po'] ?> <?php echo  $data['material_unit']; ?>
                      </div>
                    <?php } else {?>
                      <div style="width: 150px;">
                        <a class="badge badge-danger" href="">Belum ada PO <i class="fa fa-info-circle"></i></a>
                      </div>
                    <?php } ?>
                  </td>
                  <td>
                    <div style="width: 100px;">
                      <?php 
                      $ioh = $data['quantity'];
                      $price = $data['material_price'];
                      ?>
                      Rp. <?= rupiah($ioh*$price);?>
                    </div>
                  </td>
                  <td>
                    <div style="width: 150px;">
                      <a class="" href=""><i class="fa fa-plus-square"></i> Buat PO</a>
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
      <div class="manufacturingloading" style="display: none;">
        <div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
      </div>
    </div>
    <!-- start penyesesuain stok -->
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    </div>
    <!-- end penyesesuaian stok -->
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
    var sortDate = $('#sortDate').val();
    //alert(sortDate);
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>production/inventory/ajaxPaginationData/'+page_num,
      data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&sortDate='+sortDate,
      beforeSend: function () {
        $('.manufacturingloading').show();
      },
      success: function (html) {
        $('#inventoryList').html(html);
        $('.manufacturingloading').fadeOut("slow");
      }
    });
  }

// //JS delete product
// function deleteConfirm(url)
// {
//  $('#btn-delete').attr('href', url);
//  $('#deletemodal').modal();
// }

function load_itemProduct(mo_id)
{
  $.ajax({
    url: "<?php echo site_url('production/manufacturing/showitemproduct');?>",
    type: "POST",
    data: {mo_id: mo_id},
    success: function (response) {
      $(".displayitemproduct").html(response);
        //alert('YUp');
      }
    });

}
</script>

<!---------- Modal Place -------->
<!-- Modal view BOM -->
<div class="modal fade displayitemproduct" id="modal_item_produk">
  <?php include('modal_view/modal_view_item_product.php') ?>
</div>


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