<section class="section">
  <div class="section-header">
    <h1>MRP Baru</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>owner/home">Dasbor</a></div>
      <div class="breadcrumb-item"><a href="<?php echo base_url(); ?>owner/mrp">MRP</a></div>
      <div class="breadcrumb-item">MRP Baru</div>
    </div>
  </div>
  <!-- Notification Session -->
  <div class="msg" style="display:none;">
    <?= @$this->session->flashdata('msg'); ?>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="col-4 text-left">
              <h4>Draft MRP</h4>
            </div>
            <div class="col-8 text-right">
              <a href=""><i class="fas fa-print"></i> Cetak Draft</a> | 
              <a href=""><i class="fas fa-download"></i> Unduh</a>
            </div>
          </div>
          <form action="<?php echo site_url('owner/mrp/savemrp') ?>" method="post" enctype="multipart/form-data" >
            <div class="card-body">

              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Nomor MRP</label><br>
                  <input type="text" class="form-control" value="<?= $mrp_data->mrp_code; ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                </div>
                <div class="form-group col-md-2">
                  <label>Dibuat pada</label>
                  <h6 style="color: #e41857;"><?= formatDMY($mrp_data->created_date); ?></h6>
                </div>
                
              </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>No. Produksi</label>
                  <input type="text" class="form-control" value="<?= $mrp_data->mo_code; ?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label>Jumlah produksi</label>
                  <div class="input-group">
                    <input class="form-control iqtyprod" type="text" value="<?= $mrp_data->jml_prod; ?>" readonly="">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        Pcs
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Produk</label><br>
                  <?php if (!empty($mrp_data->variant_option)) { ?>
                    <a class="badge badge-primary" href="#"><?= $mrp_data->product_name; ?></a>
                    <a class="badge badge-success" href="#"><?= $mrp_data->option_value; ?></a>
                  <?php }else{  ?>
                    <a class="badge badge-primary" href="#"><?= $mrp_data->product_name; ?></a>
                  <?php } ?>
                </div>
                
              </div>
              <hr>
              <div class="card-body p-0" id="productMRP">
                <div class="form-row">
                  <div class="form-group col-md-4">
                   <label>Batas waktu pasokan</label> <br>
                   <div class="badge badge-warning"><?= formatDMY($mrp_data->production_start); ?></div>
                 </div>
               </div>
               <br>
               <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <th></th>
                    <th><div style="width: 100px">Item Bahan Baku</div></th>
                    <th><div style="width: 100px">Leadtime Pasokan</div></th>
                    <th><div style="width: 110px">Stok Tersedia</div></th>
                    <th><div style="width: 150px">Jadwal Penerimaan</div></th>
                    <th><div style="width: 150px">Jumlah penerimaan Terjadwal</div></th>
                    <th><div style="width: 120px">Kebutuhan per unit produk</div></th>
                    <th><div style="width: 150px">Kebutuhan Kotor</div></th>
                    <th><div style="width: 150px">Kebutuhan Bersih</div></th>
                    <th><div style="width: 100px">Waktu Maksimal Pemesanan</div></th>
                    <th><div style="width: 150px">Jumlah harus dipesan</div></th>
                    <!--  <th><div style="width: 100px;"></div></th> -->
                  </tr>
                  <?php foreach ($mrp_array as $data): ?>
                    <tr>
                      <th><i class="fa fa-calculator"></i></th>
                      <td>
                        <?php if (empty($data->mv_option)) { ?>
                          <a href="#" class="badge badge-primary"><?= $data->material_name; ?></a>
                        <?php } else {?>
                          <a href="#" class="badge badge-primary"><?= $data->material_name; ?> / <?= $data->mv_value; ?></a>
                        <?php } ?>
                      </td>
                      <td><?= $data->leadtime; ?> Hari</td>
                      <td><?= $data->stok; ?> <?= $data->material_unit; ?></td>
                      <td>
                        <?php if (!empty($data->schedule_receipt)) {?>
                         <div class="badge badge-warning"><?= formatDMY($data->schedule_receipt); ?></div>
                       <?php } else { ?>
                         <div class="badge badge-danger">Tidak ada</div>
                       <?php } ?>
                       
                     </td>
                     <td>
                      <?php if (!empty($data->schedule_receipt)) {?>
                       <?= $data->quantity_po; ?> <?= $data->material_unit; ?>
                     <?php } else { ?>
                      <div class="badge badge-danger">0</div>
                    <?php } ?>
                  </td>
                  <td><?= $data->qty; ?> <?= $data->material_unit; ?></td>
                  <td>
                   <div class="true">
                    <p class="btn_td"> <?= $data->gross_req; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></p>
                  </div>
                </td>
                <td>
                 <div class="true">
                  <p class="btn_td"><?= $data->net_req; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></p>
                </div>
              </td>
              <td>
               <div class="true">
                <p class="btn_td"><?= formatDMY($data->PORel); ?> <i class="fa fa-info-circle"></i></p>
              </div>
            </td>
            <td>
             <div class="true">
              <p class="btn_td"><?= $data->qty_PORel; ?> <?= $data->material_unit; ?>  <i class="fa fa-info-circle"></i></p>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>
<div class="manufacturingloading" style="display: none;">
  <div class="content"><img src="<?php echo base_url('assets/img/pulse.gif'); ?>"/></div>
</div>
<br>
<hr>
<div class="card-footer text-right">
  <a class="btn btn-light" href="<?php echo base_url(); ?>owner/kontak">Batal</a> &nbsp;
  <a class="btn btn-success" href="<?php echo base_url() ?>owner/purchase_order/newpo_mrp/<?= $mrp_data->mrp_id; ?>"><i class="fas fa-shopping-cart"></i> Buat Rujukan Pesanan Pembelian</a>
  <button onclick="deleteConfirm('<?php echo base_url() ?>owner/mrp/actdeleteMRP/<?= $mrp_data->mrp_id; ?>')" class="btn btn-danger" type="button"><i class="fa fa-trash"></i> Hapus Draft MRP</button>
</div>
</form>
</div>
</div>
</div>
</div>
</section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>

<!-- JS Delete Confirmation-->
<script>
  function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteMRP').modal();
  }
</script>




<!-- Modal Delete Confirmation-->
<div class="modal fade" id="deleteMRP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Draft MRP yang terhapus, tidak akan bisa dikembalikan dan harus membuatkan ulang.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>


