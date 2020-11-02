<section class="section">
  <div class="section-header">
    <h1>Pesanan Produksi</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Pesanan Produksi</div>
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
              <h4>Daftar Pesanan Produksi</h4>
            </div>
            <div class="col-8 text-right">
              <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>production/manufacturing/newmanufacturing"><i class="fa fa-calendar-plus"></i> Pesanan Produksi Baru</a>
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
                <input type="text" class="form-control" id="keywords" placeholder="Cari no pesanan" onkeyup="searchFilter()">
              </div>
              <div class="form-group col-md-3">
                <select class="form-control" id="filterBy" onchange="searchFilter()">
                  <option value="" selected>Tampilkan berdasarkan</option>
                  <option value="Sedang Berjalan">Produksi Berjalan</option>
                  <option value="Selesai">Purna produksi</option>
                  <option value="Dibatalkan">Produksi dibatalkan</option>
                  <option value="Belum dilaksanakan">Produksi belum dilaksanakan</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <select class="form-control" id="sortBy" onchange="searchFilter()">
                  <option value="" selected>Urutkan</option>
                  <option value="asc">Terbaru</option>
                  <option value="desc">Terdahulu</option>
                </select>
              </div>
            </div>
            <div class="card-body p-0" id="manufacturingList">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th></th>
                    <th>No. Pesanan</th>
                    <th>Konsumen</th>
                    <th>Item Produk</th>
                    <th>Total Biaya</th>
                    <th>Tanggal Pesan Dibuat</th>
                    <th>Tanggal Dimulai</th>
                    <th>Deadline Produksi</th>
                    <th>Info Tambahan</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                  </tr>
                  <?php if(!empty($manufacturing)): foreach($manufacturing as $data): ?>
                    <tr>
                      <td><i class="fa fa-calendar"></i></td>
                      <td><div style="width: 150px;">
                        <a href="<?php echo base_url() ?>production/manufacturing/editmanufacturing/<?php echo $data['mo_id']; ?>"><?= $data['mo_code'];?></a>
                      </div></td>
                      <td><div style="width: 100px"><?= $data['customer_name'];?></div></td>
                      <td>
                        <div style="width: 100px;">
                          <a href="#" data-toggle="modal" data-target="#modal_item_produk" onclick="javascript:load_itemProduct(<?= $data['mo_id']; ?>)"><?= $data['jumlah_produk'];?> Item Produk</a>
                        </div>
                      </td>
                      <td><div style="width: 100px;">Rp. <?= rupiah($data['total_cost']);?></div></td>
                      <td><div style="width: 100px;"><?= formatDMY($data['created_date']);?></div></td>
                      <td>
                        <?php if ($data['production_start']== "Belum ditetapkan") { ?>
                          <div class="badge badge-light"><?= $data['production_start'];?> <i class="fa fa-info-circle"></i></div>
                        <?php } else { ?>
                          <div class="badge badge-warning"><?= formatDMY($data['production_start']); ?></div>
                        <?php } ?>
                      </td>
                      <td><div style="width: 100px;"><?= formatDMY($data['prod_deadline']);?></div></td>
                      <td><?= $data['additional_info'];?></td>
                      <td>
                        <?php switch ($data['status']) { 
                          case 'Belum dilaksanakan':
                          echo '<div class="badge badge-light">'.$data['status'].' <i class="fa fa-info-circle"></i></div>';
                          break;

                          case 'Sedang Berjalan':
                          echo '<div class="badge badge-info">'.$data['status'].' <i class="fa fa-hourglass"></i></div>';
                          break;

                          case 'Selesai':
                          echo '<div class="badge badge-success">'.$data['status'].' <i class="fa fa-check-circle"></i></div>';
                          break;

                          case 'Dibatalkan':
                          echo '<div class="badge badge-danger">'.$data['status'].' <i class="fa fa-times"></i></div>';
                          break; } ?>
                        </td>
                        <td>
                          <div class="dropdown d-inline">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Status Produksi
                            </button>
                            <div class="dropdown-menu">
                              <a onclick="UpdateStatus('<?php echo base_url() ?>production/manufacturing/updatestatusstart/<?php echo $data['mo_id']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-hourglass-start"></i>Mulai</a>
                              <a onclick="UpdateStatus('<?php echo base_url() ?>production/manufacturing/updatestatusdone/<?php echo $data['mo_id']; ?>')" class="dropdown-item has-icon" href="#!"><i class="fas fa-check-circle"></i> Selesai</a>
                              <a onclick="UpdateStatus('<?php echo base_url() ?>production/manufacturing/updatestatusreject/<?php echo $data['mo_id']; ?>')"class="dropdown-item has-icon" href="#!"><i class="fas fa-times-circle"></i> Batalkan</a>
                              <a onclick="UpdateStatus('<?php echo base_url() ?>production/manufacturing/updatestatusnotstart/<?php echo $data['mo_id']; ?>')"class="dropdown-item has-icon" href="#!"><i class="fas fa-times-circle"></i> Belum dimulai</a>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="dropdown d-inline">
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Tindakan
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item has-icon" href="<?php echo base_url() ?>production/manufacturing/editmanufacturing/<?php echo $data['mo_id']; ?>"><i class="fas fa-cog"></i>Ubah</a>
                              <a onclick="deleteConfirm()" class="dropdown-item has-icon" href="#!"><i class="fas fa-trash"></i> Hapus</a>
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
            <div class="manufacturingloading" style="display: none;">
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
    var filterBy = $('#filterBy').val();
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>production/manufacturing/ajaxPaginationData/'+page_num,
      data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy+'&filterBy='+filterBy,
      beforeSend: function () {
        $('.manufacturingloading').show();
      },
      success: function (html) {
        $('#manufacturingList').html(html);
        $('.manufacturingloading').fadeOut("slow");
      }
    });
  }

// //JS delete product
function UpdateStatus(url)
{
 $('#btn-status').attr('href', url);
 $('#statusmodal').modal();
}

function load_itemProduct(mo_id)
{
  $.ajax({
    url: "<?php echo site_url('production/manufacturing/showitemproduct');?>",
    type: "POST",
    data: {mo_id: mo_id},
    success: function (response) {
      $(".displayitemproduct").html(response);
    }
  });

}
</script>


<!---------- Modal Place -------->
<!-- Modal view produk -->
<div class="modal fade displayitemproduct" id="modal_item_produk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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

 <!-- Modal Confirmation Status-->
  <div class="modal fade" id="statusmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><strong>Apakah anda yakin akan mengubah status produksi?</strong></strong></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a id="btn-status" class="btn btn-info" href="#">Ya</a>
        </div>
      </div>
    </div>
  </div>